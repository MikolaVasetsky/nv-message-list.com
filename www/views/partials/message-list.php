<div class="message_list">
	<div class="correct_height_message_list">
		<div id="messages">
			<?php foreach( $page_params['messages']->rows as $message): ?>
				<div id="message_<?php echo $message['id']; ?>">
					<div class="mb-2">
						<span>Написано </span>
						<a href="mailto:<?php echo $message['facebook_email']; ?>"><?php echo $message['facebook_email']; ?></a> 
						<span>в <?php echo $message['created_at']; ?></span>

						<span class="text-muted <?php if ( $message['created_at'] == $message['updated_at'] ) : ?> d-none <?php endif; ?>" id="message_updated_at_<?php echo $message['id']; ?>""> изменено <span><?php echo $message['updated_at']; ?></span></span>

						<?php if ($message['user_id'] == $page_params['user_id']) :?>
							<div class="float-right">
								<a href="javascript:void(0)" data-id="<?php echo $message['id']; ?>" id="edit_message" class="mr-2" data-toggle="modal" data-target="#modal_edit_message"><img src="/assets/img/edit.png"></a>
								<a href="javascript:void(0)" data-id="<?php echo $message['id']; ?>" id="delete_message"><img src="/assets/img/delete.png"></a>
							</div>
						<?php endif; ?>
					</div>
					<p class="mark p-2" id="message_text_id_<?php echo $message['id']; ?>"><?php echo $message['message']; ?></p>
					<hr>
				</div>
			<?php endforeach; ?>
		</div>

		<div id="loading" class="cs-loader d-none">
			<div class="cs-loader-inner">
				<label>	●</label>
				<label>	●</label>
				<label>	●</label>
				<label>	●</label>
				<label>	●</label>
				<label>	●</label>
			</div>
		</div>

	</div>
</div>

<input type="hidden" value="<?php echo $page_params['user_id']; ?>" id="current_user_id">




<!-- Modal -->
<div class="modal fade" id="modal_edit_message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Редактировать</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<textarea name="edit_message_text" class="form-control" rows="3" required="required" placeholder="Текст сообщения" id="edit_message_text"></textarea>
			</div>
			<div class="modal-footer">
				<input type="hidden" name="edit_message_id" id="edit_message_id">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
				<button type="button" class="btn btn-primary" id="save_edit_message" data-dismiss="modal">Сохранить</button>
			</div>
		</div>
	</div>
</div>