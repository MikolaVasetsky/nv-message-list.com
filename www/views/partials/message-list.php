<?php foreach( $page_params['messages']->rows as $message): ?>
	<div id="message_<?php echo $message['id']; ?>">
		<div class="mb-2">
			<span>Написано </span>
			<a href="mailto:<?php echo $message['facebook_email']; ?>"><?php echo $message['facebook_email']; ?></a> 
			<span>в <?php echo $message['created_at']; ?></span>

			<span class="text-muted <?php if ( $message['created_at'] == $message['updated_at'] ) : ?> d-none <?php endif; ?>" id="message_updated_at_<?php echo $message['id']; ?>""> изменено <span><?php echo $message['updated_at']; ?></span></span>

			<?php if ($message['user_id'] == $page_params['user_id']) :?>
				<div class="float-right">
					<a href="javascript:void(0)" data-id="<?php echo $message['id']; ?>" data-model="message" class="mr-2 edit" data-toggle="modal" data-target="#modal_edit"><img src="/assets/img/edit.png"></a>
					<a href="javascript:void(0)" data-id="<?php echo $message['id']; ?>" data-model="message" class="delete" ><img src="/assets/img/delete.png"></a>
				</div>
			<?php endif; ?>
		</div>

		<div class="d-flex align-items-center">
			<?php if ( $message['comments']->num_rows > 0 ) : ?>
				<div class="mr-2 show_reply collapsed" data-toggle="collapse" href="#comment_collapse<?php echo $message['id']; ?>" aria-expanded="false" aria-controls="comment_collapse<?php echo $message['id']; ?>"></div>
			<?php endif; ?>
			<p class="mark p-2 m-0 w-100" id="message_text_id_<?php echo $message['id']; ?>"><?php echo $message['message']; ?></p>
		</div>


		<?php if ( isset($page_params['user_id']) ) : ?>
			<p class="text-right mt-3">
				<a class="btn btn-primary" data-toggle="collapse" href="#collapseExample_<?php echo $message['id']; ?>" aria-expanded="false" aria-controls="collapseExample_<?php echo $message['id']; ?>">
					Комментировать
				</a>
			</p>

			<div class="collapse mb-3" id="collapseExample_<?php echo $message['id']; ?>">
				<form action="<?php echo HOME_URL; ?>/comment/create" method="POST" role="form">
					<legend>Введите комментарий</legend>
					<div class="row">
						<div class="col-md-10">
							<div class="form-group m-md-0">
								<textarea name="comment" class="form-control" rows="3" required="required" placeholder="Текст комментария"></textarea>
							</div>
						</div>
						<div class="col-md-2 d-flex align-items-center">
							<input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
							<button type="submit" class="btn btn-primary">Отправить</button>
						</div>
					</div>
				</form>
			</div>
		<?php endif; ?>

		<?php
			if ( $message['comments']->num_rows > 0 ) {
				include('comment-list.php');
			}
		?>

		<hr>
	</div>
<?php endforeach; ?>