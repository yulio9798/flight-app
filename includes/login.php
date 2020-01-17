<?php
Flight::route('GET /login', function(){
    Flight::render( 'login' );
});

Flight::route('POST /login', function(){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // cek di database dan login / redirect kalo ga terdaftar
    $exist = $username == 'user';
    if ( $exist ) {
    	// logged in
    	$_SESSION['user'] = 'user';
    	Flight::redirect( '/' );
    } else {
    	// kembalikan ke hlaman login
    	Flight::redirect( '/login' );
    }
});

Flight::route( '/logout', function(){
	if ( isset( $_SESSION['user'] ) ){
		unset( $_SESSION['user'] );
	}

	Flight::redirect( '/login' );
});