<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('HOME_URL', url());
define('HOME_PATH', dirname(__DIR__) );

//facebook api
define('F_APP_ID', '120692105176908');
define('F_APP_SECRET', '411734b127fbf0aa895ed765fb12d938');

//database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'nv-message-list');