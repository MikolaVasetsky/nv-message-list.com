<?php
if(!session_id()) {
	session_start();
}

/*
 * function for get home url, return string
 */
function url() {
	return sprintf(
		"%s://%s",
		isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
		$_SERVER['SERVER_NAME']
	);
}

/*
 * function for var dump - i like it
 */
function vardump($str) {
	var_dump('<pre>');
	var_dump($str);
	var_dump('</pre>');
}

function is_not_page() {
	return [
		'title' => '404-page',
		'page' => '404-page.php',
	];
}

function getMessageHTML($messages, $currentUserId) {
	ob_start(); ?>
		<?php foreach( $messages->rows as $message): ?>
			<div id="message_<?php echo $message['id']; ?>">
				<div class="mb-2">
					<span>Написано </span>
					<a href="mailto:<?php echo $message['facebook_email']; ?>"><?php echo $message['facebook_email']; ?></a> 
					<span>в <?php echo $message['created_at']; ?></span>

					<span class="text-muted <?php if ( $message['created_at'] == $message['updated_at'] ) : ?> d-none <?php endif; ?>" id="message_updated_at_<?php echo $message['id']; ?>""> изменено <span><?php echo $message['updated_at']; ?></span></span>

					<?php if ($message['user_id'] == $currentUserId) :?>
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


				<?php if ( isset($currentUserId) ) : ?>
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
					?>
						<div class="collapse" id="comment_collapse<?php echo $message['id']; ?>">
							<div class="comments ml-5">
								<?php foreach( $message['comments']->rows as $comment): ?>
									<div id="comment_<?php echo $comment['id']; ?>">
										<div class="mb-2">
											<span>Написано </span>
											<a href="mailto:<?php echo $comment['facebook_email']; ?>"><?php echo $comment['facebook_email']; ?></a> 
											<span>в <?php echo $comment['created_at']; ?></span>

											<span class="text-muted <?php if ( $comment['created_at'] == $comment['updated_at'] ) : ?> d-none <?php endif; ?>" id="comment_updated_at_<?php echo $comment['id']; ?>""> изменено <span><?php echo $comment['updated_at']; ?></span></span>

											<?php if ($comment['user_id'] == $currentUserId) :?>
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

										<?php if ( isset($currentUserId ) ) : ?>
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
												?>
													<div class="collapse" id="reply_collapse<?php echo $comment['id']; ?>">
														<div class="comments ml-5">
															<?php foreach( $comment['replys']->rows as $reply): ?>
																<div id="reply_<?php echo $reply['id']; ?>">
																	<div class="mb-2">
																		<span>Написано </span>
																		<a href="mailto:<?php echo $reply['facebook_email']; ?>"><?php echo $reply['facebook_email']; ?></a> 
																		<span>в <?php echo $reply['created_at']; ?></span>

																		<span class="text-muted <?php if ( $reply['created_at'] == $reply['updated_at'] ) : ?> d-none <?php endif; ?>" id="reply_updated_at_<?php echo $reply['id']; ?>""> изменено <span><?php echo $reply['updated_at']; ?></span></span>

																		<?php if ($reply['user_id'] == $currentUserId) :?>
																			<div class="float-right">
																				<a href="javascript:void(0)" data-id="<?php echo $reply['id']; ?>" data-model="reply" class="mr-2 edit" data-toggle="modal" data-target="#modal_edit"><img src="/assets/img/edit.png"></a>
																				<a href="javascript:void(0)" data-id="<?php echo $reply['id']; ?>" data-model="reply" class="delete" ><img src="/assets/img/delete.png"></a>
																			</div>
																		<?php endif; ?>
																	</div>
																	<p class="mark p-2" id="reply_text_id_<?php echo $reply['id']; ?>"><?php echo $reply['reply']; ?></p>

																	<hr>
																</div>
															<?php endforeach; ?>
														</div>
													</div>
												<?php
											}
										?>
										<hr>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					<?php
					}
				?>
				<hr>
			</div>
		<?php endforeach; ?>
	<?php return ob_get_clean();
}