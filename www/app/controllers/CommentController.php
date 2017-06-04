<?php
require_once(HOME_PATH.'/app/models/Comment.php');

/**
* init front page
*/
class CommentController
{
	protected $comment;
	protected $user;

	public function __construct()
	{
		$this->comment = new Comment();

		if ( isset($_SESSION['fb_access_token']) ) { //if user has session, we check his ID.
			$this->user = $this->comment->user();
		}
	}

	public function create()
	{
		$res = $this->comment->create($_POST['comment'], (int)$this->user['id'], (int)$_POST['message_id']);
		if ( true === $res ) {
			header( 'Location: '.HOME_URL.'/message' );
		} else {
			vardump("ERROR: save comment");
			die;
		}
	}

	public function update()
	{
		$id = (int)$_POST['id'];
		//check user id
		if ( $this->comment->getUserId($id) != $this->user['id'] ) {
			//reutnr message with error status
			exit(json_encode(['status' => 'error', 'message' => 'Вы не можете редактировать этот комментарий']));
		}

		if ( !$updated_at = $this->comment->update($id, $_POST['text']) ) {
			exit(json_encode(['status' => 'error', 'message' => 'Ошибка при редактировании']));
		}

		exit(json_encode(['status' => 'success', 'message' => 'Комментарий изменен', 'updated_at' => $updated_at]));
	}

	public function delete()
	{
		$id = (int)$_POST['id'];
		//check user id
		if ( $this->comment->getUserId($id) != $this->user['id'] ) {
			//reutnr message with error status
			exit(json_encode(['status' => 'error', 'message' => 'Вы не можете удалить этот комментарий']));
		}
		//delete message and three comment and reply
		if ( true != $this->comment->delete($id) ) {
			exit(json_encode(['status' => 'error', 'message' => 'Ошибка при удалении']));
		}

		exit(json_encode(['status' => 'success', 'message' => 'Комментарий удален']));
	}
}