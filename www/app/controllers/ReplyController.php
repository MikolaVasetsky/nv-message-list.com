<?php
require_once(HOME_PATH.'/app/models/Reply.php');

/**
* init front page
*/
class ReplyController
{
	protected $reply;
	protected $user;

	public function __construct()
	{
		$this->reply = new Reply();

		if ( isset($_SESSION['fb_access_token']) ) { //if user has session, we check his ID.
			$this->user = $this->reply->user();
		}
	}

	public function create()
	{
		$res = $this->reply->create($_POST['reply'], (int)$this->user['id'], (int)$_POST['comment_id']);
		if ( true === $res ) {
			header( 'Location: '.HOME_URL.'/message' );
		} else {
			vardump("ERROR: save reply");
			die;
		}
	}

	public function update()
	{
		$id = (int)$_POST['id'];
		//check user id
		if ( $this->reply->getUserId($id) != $this->user['id'] ) {
			//reutnr message with error status
			exit(json_encode(['status' => 'error', 'message' => 'Вы не можете редактировать этот ответ']));
		}

		if ( !$updated_at = $this->reply->update($id, $_POST['text']) ) {
			exit(json_encode(['status' => 'error', 'message' => 'Ошибка при редактировании']));
		}

		exit(json_encode(['status' => 'success', 'message' => 'Ответ изменен', 'updated_at' => $updated_at]));
	}

	public function delete()
	{
		$id = (int)$_POST['id'];
		//check user id
		if ( $this->reply->getUserId($id) != $this->user['id'] ) {
			//reutnr message with error status
			exit(json_encode(['status' => 'error', 'message' => 'Вы не можете удалить этот ответ']));
		}
		//delete message and three reply and reply
		if ( true != $this->reply->delete($id) ) {
			exit(json_encode(['status' => 'error', 'message' => 'Ошибка при удалении']));
		}

		exit(json_encode(['status' => 'success', 'message' => 'Ответ удален']));
	}
}