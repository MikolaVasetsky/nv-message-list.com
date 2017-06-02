<?php
class User extends Model
{
	public function getUsers()
	{
		return $this->db()->query('SELECT * FROM users');
	}

	/**
	 * create new user or update
	 * @param  string 	$facebook_id
	 * @param  string 	$facebook_token
	 */
	public function createOrUpdateTokenUser($facebook_id, $facebook_token, $facebook_email)
	{
		//check if exist and update token
		$res = $this->db()->query('SELECT id, facebook_token FROM users WHERE facebook_id = "'.$facebook_id.'" LIMIT 1');

		if ( $res->num_rows > 0 ) {
			if ( $facebook_token != $res->rows[0]['facebook_token'] ) {
				//update token
				$this->db()->query('UPDATE users SET facebook_token = "'.$facebook_token.'", facebook_email = "'.$facebook_email.'" WHERE id = "'.$res->rows[0]['id'].'"');
			}
		} else {
			//create new user
			$this->db()->query('INSERT INTO users (facebook_id, facebook_token, facebook_email) VALUES ("'.$facebook_id.'", "'.$facebook_token.'", "'.$facebook_email.'")');
		}
	}
}