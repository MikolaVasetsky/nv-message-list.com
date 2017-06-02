<?php
require_once(HOME_PATH.'/app/models/Message.php');

/**
* init front page
*/
class MessageController
{
	protected $message;
	protected $user;

	public function __construct()
	{
		$this->message = new Message();

		if ( isset($_SESSION['fb_access_token']) ) { //if user has session, we check his ID.
			$this->user = $this->message->getCurrentUser();
		}
	}

	public function index()
	{
		$return_values = [
			'title' => 'Message Page',
			'page' => 'message-page.php',
			'user_id' => $this->user['id']
		];

		if ( !isset($_SESSION['fb_access_token']) ) {
			$return_values['login_link'] = self::getFacebookLoginUrl();
		}

		$return_values['messages'] = $this->message->getMessageList();

		return $return_values;
	}

	public function create()
	{
		$this->message->create($_POST['message'], $this->user['id']);

		header( 'Location: '.HOME_URL.'/message' );
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