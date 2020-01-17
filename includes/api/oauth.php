<?php
// setup and register oauth server object
$storage = new OAuth2\Storage\Pdo(array('dsn' => 'mysql:dbname='.DB_NAME.';host='.DB_HOST, 'username' => DB_USER, 'password' => DB_PASS));
Flight::register( 'oauthServer', 'OAuth2\Server', array( $storage ) );
Flight::oauthServer()->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));

// route for get token
Flight::route( '/oauth/token', function(){
	Flight::oauthServer()->handleTokenRequest(OAuth2\Request::createFromGlobals())->send();
});

/**
 * Helper to get resource that need oauth authentication
 *
 * @example Flight::oauth( 'GET', 'http://192.168.1.12/api/get', array( 'limit' => 1 ), array(
 *				'clientId'                => 'testclient',    // The client ID assigned to you by the provider
 *		        'clientSecret'            => 'testpassd',    // The client password assigned to you by the provider
 *		        'urlAccessToken'          => 'http://192.168.1.12/oauth/token', // endpoint to get token
 *			) ) [<description>]
 *
 * @var array
 */
Flight::map('oauth', function( $method, $endpoint, $options = array(), $oauth_params = array() ){

    $args = array_merge([
        'clientId'                => null,    // The client ID assigned to you by the provider
        'clientSecret'            => null,    // The client password assigned to you by the provider
        'urlAccessToken'          => null,
        'redirectUri'             => null,
        'urlAuthorize'            => null,
        'urlResourceOwnerDetails' => null
    ], $oauth_params );

    $provider = new \League\OAuth2\Client\Provider\GenericProvider( $args );

    try {
    	$token_id = md5( json_encode($oauth_params) );
        $accessToken = isset( $_SESSION[$token_id] ) && isset( $_SESSION[$token_id]['token'] ) ? $_SESSION[$token_id]['token'] : null;
        if ( empty($accessToken) || $accessToken->hasExpired() ) {
            // Try to get an access token using the client credentials grant.
            $accessToken = $provider->getAccessToken('client_credentials');
            $_SESSION[$token_id]['token'] = $accessToken;
        }

        if ( empty( $options ) || !is_array( $options ) ) {
            $options = array();
        }

        $request = $provider->getAuthenticatedRequest($method, $endpoint, $accessToken );
        $response = Flight::client()->send($request, $options);
        // $response = $provider->getHttpClient()->send($request, $options);
        return json_decode( $response->getBody() );

    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
        throw $e;
    }
});