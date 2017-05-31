<?php
define('HOME_URL', url());

define('F_APP_ID', '120692105176908');
define('F_APP_SECRET', '411734b127fbf0aa895ed765fb12d938');

if(!session_id()) {
	session_start();
}

/*
 * function for get home url, return string
 */
function url() {
	return sprintf(
		"%s://%s",
		isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
		$_SERVER['SERVER_NAME']
	);
}

/*
 * function for var dump - i like it
 */
function vardump($str) {
	var_dump('<pre>');
	var_dump($str);
	var_dump('</pre>');
}