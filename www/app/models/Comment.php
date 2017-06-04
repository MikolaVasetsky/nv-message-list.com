<?php
class Comment extends Model
{
	public function create($comment, $user_id, $message_id)
	{
		$comment = $this->db()->escape($comment);

		return $this->db()->query('INSERT INTO comments ( user_id, comment, message_id ) VALUES ('.$user_id.', "'.$comment.'", '.$message_id.')');
	}

	public function getComments($id)
	{
		return $this->db()->query('
			SELECT c.id, c.user_id, c.comment, c.created_at, c.updated_at, u.facebook_email AS facebook_email
			FROM comments c
			INNER JOIN users u ON c.user_id = u.id
			WHERE c.message_id = '.$id
		);
	}

	public function update($id, $comment)
	{
		$comment = $this->db()->escape($comment);
		$updated_at = date('Y-m-d H:i:s');

		if ( true === $this->db()->query('UPDATE comments SET comment = "'.$comment.'", updated_at = "'.$updated_at.'" WHERE id = "'.$id.'"') ) {
			return $updated_at;
		} else {
			return false;
		}
	}

	public function delete($id)
	{
		return $this->db()->query('
			DELETE c, r
			FROM comments c
			LEFT JOIN replys r ON c.id = r.comment_id
			WHERE c.id = '.$id
		);
	}

	public function getUserId($id)
	{
		$result = $this->db()->query('SELECT user_id FROM comments WHERE id = '.$id.'');
		if ( $result->num_rows > 0 ) {
			return $result->rows[0]['user_id'];
		} else {
			return false;
		}
	}
}