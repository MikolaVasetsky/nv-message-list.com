<?php
$request_uri = explode('?', $_SERVER['REQUEST_URI']);//remove get params
$arr = explode("/", substr($request_uri[0], 1));

//get controller
$controller = $arr[0] ?: 'home';

//get method
if ( isset($arr[1]) ) {
	$method = $arr[1];
} else {
	$method = 'index';
}


$class = ucfirst(strtolower($controller)).'Controller';
$file = 'controllers/'.$class.".php";

if ( file_exists(HOME_PATH.'/app/'.$file) ) { // try include file
	require_once($file);
	$action = new $class;
	if ( method_exists($class, $method) ) {
		$page_params = $action->$method();//if method exist -> call to it
	} else {
		$page_params = is_not_page();//default 404 page
	}
} else {
	$page_params = is_not_page();//default 404 page
}
