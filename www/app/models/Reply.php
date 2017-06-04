<?php
class Reply extends Model
{
	public function create($reply, $user_id, $comment_id)
	{
		$reply = $this->db()->escape($reply);

		return $this->db()->query('INSERT INTO replys ( user_id, reply, comment_id ) VALUES ('.$user_id.', "'.$reply.'", '.$comment_id.')');
	}

	public function getReplys($id)
	{
		return $this->db()->query('
			SELECT r.id, r.user_id, r.reply, r.created_at, r.updated_at, u.facebook_email AS facebook_email
			FROM replys r
			INNER JOIN users u ON r.user_id = u.id
			WHERE r.comment_id = '.$id
		);
	}

	public function update($id, $reply)
	{
		$reply = $this->db()->escape($reply);
		$updated_at = date('Y-m-d H:i:s');

		if ( true === $this->db()->query('UPDATE replys SET reply = "'.$reply.'", updated_at = "'.$updated_at.'" WHERE id = "'.$id.'"') ) {
			return $updated_at;
		} else {
			return false;
		}
	}

	public function delete($id)
	{
		return $this->db()->query('DELETE FROM replys WHERE `id` = '.$id);
		//also delete reply
	}

	public function getUserId($id)
	{
		$result = $this->db()->query('SELECT user_id FROM replys WHERE id = '.$id.'');
		if ( $result->num_rows > 0 ) {
			return $result->rows[0]['user_id'];
		} else {
			return false;
		}
	}
}