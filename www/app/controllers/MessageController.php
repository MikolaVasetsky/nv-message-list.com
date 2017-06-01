<?php
// require_once(HOME_PATH.'/app/models/User.php');

/**
* init front page
*/
class MessageController
{
	public function index()
	{
		// vardump(class_exists('User'));
		// die;
		// $user = new User();
		// vardump($user->getUsers());
		// die;
		$return_values = [
			'title' => 'Message Page',
			'page' => 'message-page.php',
		];

		if ( !isset($_SESSION['fb_access_token']) ) {
			$return_values['login_link'] = self::getFacebookLoginUrl();
		}

		return $return_values;
	}

	private static function getFacebookLoginUrl()
	{
		require_once('./vendor/autoload.php');

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