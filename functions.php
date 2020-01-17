<?php
/**
 * get base / home url of app
 *
 * @since  1.0.0
 *
 * @return [type] [description]
 */
function get_base_url(){
	$base_dir  = __DIR__; // Absolute path
	$doc_root  = preg_replace("!${_SERVER['SCRIPT_NAME']}$!", '', $_SERVER['SCRIPT_FILENAME']); # ex: /var/www
	$base_url  = preg_replace("!^${doc_root}!", '', $base_dir); # ex: '' or '/mywebsite'
	$protocol  = empty($_SERVER['HTTPS']) ? 'http' : 'https';
	$port      = $_SERVER['SERVER_PORT'];
	$disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";
	$domain    = $_SERVER['SERVER_NAME'];
	$home_url  = "${protocol}://${domain}${disp_port}${base_url}"; # Ex: 'http://example.com', 'https://example.com/mywebsite', etc.

	return trailingslashit( $home_url );
}

/**
 * Scan directory and load it
 *
 * @since  1.0.0
 *
 * @param  [type] $dir [description]
 *
 * @return [type]      [description]
 */
function require_all_files( $dir ) {
    // require all php files
    $scan = glob( "$dir/*" );
    foreach ($scan as $path) {
        if (preg_match('/\.php$/', $path)) {
            require_once( $path );
        } elseif (is_dir($path)) {
            require_all_files($path);
        }
    }
}

/**
 * Add slash to the end of string
 *
 * @since  1.0.0
 *
 * @param  [type] $string [description]
 *
 * @return [type]         [description]
 */
function trailingslashit( $string ) {
    return untrailingslashit( $string ) . '/';
}

/**
 * Remove slash from end of string
 *
 * @since  1.0.0
 *
 * @param  [type] $string [description]
 *
 * @return [type]         [description]
 */
function untrailingslashit( $string ) {
    return rtrim( $string, '/\\' );
}