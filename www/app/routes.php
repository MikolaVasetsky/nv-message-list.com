<?php
$request_uri = explode('?', $_SERVER['REQUEST_URI']);//remove get params
$arr = explode("/", substr($request_uri[0], 1));

//get controller
$controller = $arr[0] ?: 'home';

//get method
$method = (isset($arr[1])) ? $arr[1] : 'index';

$class = ucfirst(strtolower($controller));
$class_controller = $class.'Controller';
$file = 'controllers/'.$class_controller.".php";

if ( file_exists(HOME_PATH.'/app/'.$file) ) { // try include file
	require_once($file);
	$action = new $class_controller;
	if ( method_exists($class_controller, $method) ) {
		$page_params = $action->$method();//if method exist -> call to it
	} else {
		$page_params = is_not_page();//default 404 page
	}
} else {
	$page_params = is_not_page();//default 404 page
}
