<?php
class Message extends Model
{
	public function getMessageList($skip = 0)
	{

		return $this->db()->query('
			SELECT m.id, m.user_id, m.message, m.created_at, m.updated_at, u.facebook_email AS facebook_email
			FROM messages m
			INNER JOIN users u ON m.user_id = u.id
			ORDER BY m.id
			DESC
			LIMIT 5
			OFFSET '.$skip.'
		');
	}

	public function create($message, $user_id)
	{
		$message = $this->db()->escape($message);

		return $this->db()->query('INSERT INTO messages ( user_id, message ) VALUES ('.$user_id.', "'.$message.'")');
	}

	public function update($id, $message)
	{
		$message = $this->db()->escape($message);
		$updated_at = date('Y-m-d H:i:s');

		if ( true === $this->db()->query('UPDATE messages SET message = "'.$message.'", updated_at = "'.$updated_at.'" WHERE id = "'.$id.'"') ) {
			return $updated_at;
		} else {
			return false;
		}
	}

	public function delete($id)
	{
		return $this->db()->query('DELETE FROM messages WHERE id = '.$id);
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