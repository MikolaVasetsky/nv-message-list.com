<div class="collapse" id="comment_collapse<?php echo $message['id']; ?>">
	<div class="comments ml-5">
		<?php foreach( $message['comments']->rows as $comment): ?>
			<div id="comment_<?php echo $comment['id']; ?>">
				<div class="mb-2">
					<span>Написано </span>
					<a href="mailto:<?php echo $comment['facebook_email']; ?>"><?php echo $comment['facebook_email']; ?></a> 
					<span>в <?php echo $comment['created_at']; ?></span>

					<span class="text-muted <?php if ( $comment['created_at'] == $comment['updated_at'] ) : ?> d-none <?php endif; ?>" id="comment_updated_at_<?php echo $comment['id']; ?>""> изменено <span><?php echo $comment['updated_at']; ?></span></span>

					<?php if ($comment['user_id'] == $page_params['user_id']) :?>
						<div class="float-right">
							<a href="javascript:void(0)" data-id="<?php echo $comment['id']; ?>" data-model="comment" class="mr-2 edit" data-toggle="modal" data-target="#modal_edit"><img src="/assets/img/edit.png"></a>
							<a href="javascript:void(0)" data-id="<?php echo $comment['id']; ?>" data-model="comment" class="delete" ><img src="/assets/img/delete.png"></a>
						</div>
					<?php endif; ?>
				</div>

				<div class="d-flex align-items-center">
					<?php if ( $comment['replys']->num_rows > 0 ) : ?>
						<div class="mr-2 show_reply collapsed" data-toggle="collapse" href="#reply_collapse<?php echo $comment['id']; ?>" aria-expanded="false" aria-controls="reply_collapse<?php echo $comment['id']; ?>"></div>
					<?php endif; ?>
					<p class="mark p-2 m-0 w-100" id="comment_text_id_<?php echo $comment['id']; ?>"><?php echo $comment['comment']; ?></p>
				</div>

				<?php if ( isset($page_params['user_id']) ) : ?>
					<p class="text-right mt-3">
						<a class="btn btn-primary" data-toggle="collapse" href="#comment_collapse_reply<?php echo $comment['id']; ?>" aria-expanded="false" aria-controls="comment_collapse_reply<?php echo $comment['id']; ?>">
							Ответить
						</a>
					</p>

					<div class="collapse mb-3" id="comment_collapse_reply<?php echo $comment['id']; ?>">
						<form action="<?php echo HOME_URL; ?>/reply/create" method="POST" role="form">
							<legend>Введите ответ</legend>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group m-md-0">
										<textarea name="reply" class="form-control" rows="3" required="required" placeholder="Текст ответа"></textarea>
									</div>
								</div>
								<div class="col-md-2 d-flex align-items-center">
									<input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
									<button type="submit" class="btn btn-primary">Отправить</button>
								</div>
							</div>
						</form>
					</div>
				<?php endif; ?>

				<?php
					if ( $comment['replys']->num_rows > 0 ) {
						include('reply-list.php');
					}
				?>

				<hr>
			</div>
		<?php endforeach; ?>
	</div>
</div>