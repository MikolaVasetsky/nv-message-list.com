	<div class="container_message">
		<!-- container for form create new message -->
		<?php if ( isset($page_params['user_id']) ) : ?>
			<div class="pt-5 for_small_height">
				<form action="<?php echo HOME_URL . '/message/create'; ?>" method="POST" role="form">
					<legend>Введите сообщение</legend>
					<div class="row">
						<div class="col-md-10">
							<div class="form-group m-md-0">
								<textarea name="message" class="form-control" rows="3" required="required" placeholder="Текст сообщения"></textarea>
							</div>
						</div>
						<div class="col-md-2 d-flex align-items-center">
							<button type="submit" class="btn btn-primary">Отправить</button>
						</div>
					</div>
				</form>
			</div>
		<?php else : ?>
			<div class="pt-5 text-center">
				<p><a href="<?php echo $page_params['login_link']; ?>" class="btn btn-primary">Login with FaceBook</a></p>
				<p>Для добавления и комментирования сообщения выполните вход</p>
			</div>
		<?php endif; ?>
		<!-- end container for form create new message -->

		<!-- message list -->
		<?php if ( !empty($page_params['messages']->rows) ) : ?>
			<?php require_once('partials/message-list.php'); ?>
			<?php require_once('partials/edit-modal.php'); ?>
		<?php endif; ?>
		<!-- end message list -->
	</div>
