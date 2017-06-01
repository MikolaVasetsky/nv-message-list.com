<?php
class Message extends Model
{
	public function getMessageList()
	{
		return $this->db()->query('SELECT id, user_id, message, created_at FROM messages');
	}

	public function create($message)
	{
		$user_id = 1;
		$message = $this->db()->escape($message);

		return $this->db()->query('INSERT INTO messages ( user_id, message ) VALUES ('.$user_id.', "'.$message.'")');
		// return back
	}

	public function update($message, $id)
	{
		$message = $this->db()->escape($message);
		$this->db()->query('UPDATE messages SET message = "'.$message.'", updated_at = "'.date('Y-m-d H:i:s').'" WHERE id = "'.$id.'"');
		// return back
	}

	public function delete($id)
	{
		$this->db()->query('DELETE FROM `messages` WHERE `id` = '.$id);
		// return back
	}
}