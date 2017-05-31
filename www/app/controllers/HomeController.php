<?php

/**
* init front page
*/
class HomeController
{

	public function __construct()
	{
		require_once('./vendor/autoload.php');
	}

	public function index()
	{
		$login_link = self::getFacebookLoginUrl();

		return ['page' => 'main-page.php', 'login_link' => $login_link];
	}

	private static function getFacebookLoginUrl()
	{
		$fb = new Facebook\Facebook([
			'app_id' => F_APP_ID,
			'app_secret' => F_APP_SECRET,
			'default_graph_version' => 'v2.2',
		]);

		$helper = $fb->getRedirectLoginHelper();

		$permissions = ['email']; // Optional permissions

		return $helper->getLoginUrl(HOME_URL.'/login', $permissions);
	}
}