<?php
class Message extends Model
{
	public function getMessageList($skip = 0)
	{

		return $this->db()->query('
			SELECT m.id, m.user_id, m.message, m.created_at, u.facebook_email AS facebook_email
			FROM messages m
			INNER JOIN users u ON m.user_id = u.id
			ORDER BY m.id
			DESC
			LIMIT 5
			OFFSET '.$skip.'
		');
	}

	public function getCurrentUser()
	{
		$result = $this->db()->query('SELECT id, facebook_email FROM users WHERE facebook_token = "'.$_SESSION['fb_access_token'].'"');
		if ( $result->num_rows > 0 ) {
			return $result->rows[0];
		} else {
			session_destroy();//destroy session and refresh page if session token != token
			header( 'Location: '.HOME_URL.'/message' );
		}
	}

	public function create($message, $user_id)
	{
		$message = $this->db()->escape($message);

		return $this->db()->query('INSERT INTO messages ( user_id, message ) VALUES ('.$user_id.', "'.$message.'")');
	}

	public function update($message, $id)
	{
		$message = $this->db()->escape($message);
		$this->db()->query('UPDATE messages SET message = "'.$message.'", updated_at = "'.date('Y-m-d H:i:s').'" WHERE id = "'.$id.'"');
		// return back
	}

	public function delete($id)
	{
		return $this->db()->query('DELETE FROM `messages` WHERE `id` = '.$id);
		//also delete comment and reply
	}

	public function getUserId($id)
	{
		$result = $this->db()->query('SELECT user_id FROM messages WHERE id = '.$id.'');
		if ( $result->num_rows > 0 ) {
			return $result->rows[0]['user_id'];
		} else {
			return false;
		}
	}
}