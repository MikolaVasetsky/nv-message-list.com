<?php

/**
* init front page
*/
class MessageController
{

	public function __construct()
	{
		require_once('./vendor/autoload.php');
	}

	public function index()
	{
		return ['page' => 'message-page.php'];
	}

}