<?php
class Model
{
	public function db()
	{
		return new DB(DB_HOST, DB_USER, DB_PASS, DB_NAME);//connect to DB
	}

	public function user()
	{
		$result = $this->db()->query('SELECT id, facebook_email FROM users WHERE facebook_token = "'.$_SESSION['fb_access_token'].'"');
		if ( $result->num_rows > 0 ) {
			return $result->rows[0];
		} else {
			session_destroy();//destroy session and refresh page if session token != token
			header( 'Location: '.HOME_URL.'/message' );
		}
	}
}