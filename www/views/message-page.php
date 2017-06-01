<?php if ( isset($_SESSION['fb_access_token']) ) : ?>
	Message
<?php else : ?>
	<div class="message_need_login">
		<p><a href="<?php echo $page_params['login_link']; ?>" class="btn btn-primary">Login with FaceBook</a></p>
		<p>Для добавления и комментирования сообщения выполните вход</p>
	</div>
<?php endif; ?>