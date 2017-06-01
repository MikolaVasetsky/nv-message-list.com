<?php

$page_info['page'] = '404-page.php';

//set default page
if ( !isset($_SERVER['REDIRECT_URL']) ) {
	$_SERVER['REDIRECT_URL'] = '/';
}

if ( $_SERVER['REDIRECT_URL'] == '/' ) {
	if ( $_SESSION['fb_access_token'] ) {
		header( 'Location: '.HOME_URL.'/message' );
	}

	require_once('controllers/HomeController.php');
	$controller = new HomeController(); // init home controller class for require facebook sdk
	$page_info = $controller->index(); // get page info from class
} else if ( $_SERVER['REDIRECT_URL'] == '/message' ) {
	require_once('controllers/MessageController.php');
	$controller = new MessageController();
	$page_info = $controller->index();
} else if ( $_SERVER['REDIRECT_URL'] == '/login' ) {
	if ( $_SESSION['fb_access_token'] ) {
		header( 'Location: '.HOME_URL.'/message' );
	}

	require_once('controllers/LoginController.php');
} else {
	$page_info['page'] = '404-page.php';
}