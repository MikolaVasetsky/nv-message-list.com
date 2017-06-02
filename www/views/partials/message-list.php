<div class="message_list">
	<div class="correct_height_message_list">
		<div id="messages">
			<?php foreach( $page_params['messages']->rows as $message): ?>
				<div id="message_<?php echo $message['id']; ?>">
					<div class="mb-2">
						Написано <a href="mailto:<?php echo $message['facebook_email']; ?>"><?php echo $message['facebook_email']; ?></a> в <?php echo $message['created_at']; ?>
						<?php if ($message['user_id'] == $page_params['user_id']) :?>
							<div class="float-right">
								<a href="javascript:void(0)" data-id="<?php echo $message['id']; ?>" class="mr-2"><img src="/assets/img/edit.png"></a>
								<a href="javascript:void(0)" data-id="<?php echo $message['id']; ?>" id="delete_message"><img src="/assets/img/delete.png"></a>
							</div>
						<?php endif; ?>
					</div>
					<p class="mark p-2 message_text_id_<?php echo $message['id']; ?>"><?php echo $message['message']; ?></p>
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