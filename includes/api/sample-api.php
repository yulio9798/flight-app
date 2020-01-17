<?php
Flight::route( '/api/get', function(){
	$request = OAuth2\Request::createFromGlobals();
	// Protect resource from unauthorized access
	if (!Flight::oauthServer()->verifyResourceRequest($request)) {
	    Flight::oauthServer()->getResponse()->send();
	    exit();
	}

	Flight::json( array( 'success' => 'true', 'request' => $request ) );
});