<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'deft__learn');

require 'vendor/autoload.php';
require 'functions.php';

require_all_files( 'includes' );

if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}

Flight::view()->set('asset_url', get_base_url() . 'assets' );
Flight::view()->set('menu', array(
	array(
		'url' => '/',
		'icon' => 'ni ni-tv-2',
		'text' => 'Dashboard'
	),
	array(
		'url' => '/users',
		'icon' => 'ni ni-circle-08',
		'text' => 'Users'
	),
) );

// set database connection and register object
Flight::register('db', 'MysqliDb', array( DB_HOST, DB_USER, DB_PASS, DB_NAME ) );

/**
 * Client to access public api
 */
Flight::register('client', 'GuzzleHttp\Client', array( array(
    // You can set any number of default request options.
    'timeout'  => 50,
) ) );

Flight::route('/', function(){
	if ( !isset( $_SESSION['user'] ) ) {
		Flight::redirect( '/login' );
		exit();
	}

	Flight::view()->set('title', 'Dashboard');
    Flight::render( 'dashboard', array( 'name' => $_SESSION['user'] ) );
});

Flight::start();