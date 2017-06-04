<?php
require_once(HOME_PATH.'/app/models/Message.php');
require_once(HOME_PATH.'/app/models/Comment.php');
require_once(HOME_PATH.'/app/models/Reply.php');

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
			$this->user = $this->message->user();
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

		$comment = new Comment;
		$reply = new Reply;
		for ( $i = 0; $i < $return_values['messages']->num_rows; ++$i ) {
			$return_values['messages']->rows[$i]['comments'] = $comment->getComments($return_values['messages']->rows[$i]['id']);//get comment for message

			for ( $j = 0; $j < $return_values['messages']->rows[$i]['comments']->num_rows; ++$j ) {
				$return_values['messages']->rows[$i]['comments']->rows[$j]['replys'] = $reply->getReplys($return_values['messages']->rows[$i]['comments']->rows[$j]['id']);//get reply for message
			}
		}

		return $return_values;
	}

	public function create()
	{
		$this->message->create($_POST['message'], $this->user['id']);

		header( 'Location: '.HOME_URL.'/message' );
	}

	public function update()
	{
		$id = (int)$_POST['id'];
		//check user id
		if ( $this->message->getUserId($id) != $this->user['id'] ) {
			//reutnr message with error status
			exit(json_encode(['status' => 'error', 'message' => 'Вы не можете редактировать это сообщение']));
		}

		if ( !$updated_at = $this->message->update($id, $_POST['text']) ) {
			exit(json_encode(['status' => 'error', 'message' => 'Ошибка при редактировании']));
		}

		exit(json_encode(['status' => 'success', 'message' => 'Сообщение изменено', 'updated_at' => $updated_at]));
	}

	public function delete()
	{
		$id = (int)$_POST['id'];
		//check user id
		if ( $this->message->getUserId($id) != $this->user['id'] ) {
			//reutnr message with error status
			exit(json_encode(['status' => 'error', 'message' => 'Вы не можете удалить это сообщение']));
		}
		//delete message and three comment and reply
		if ( true != $this->message->delete($id) ) {
			exit(json_encode(['status' => 'error', 'message' => 'Ошибка при удалении']));
		}

		exit(json_encode(['status' => 'success', 'message' => 'Сообщение удалено']));
	}

	public function getAjaxMessages()
	{
		$result = $this->message->getMessageList($_POST['skip']);
		if ( $result->num_rows > 0 ) {
			exit(json_encode(['status' => 'success', 'data' => json_encode($result->rows)]));
		} else {
			exit(json_encode(['status' => 'error', 'message' => 'Список закончен']));
		}
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