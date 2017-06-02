<div class="message_list">

<?php foreach( $page_params['messages']->rows as $message): ?>
	<div>
		<div class="mb-2">
			Написано <a href="mailto:<?php echo $message['facebook_email']; ?>"><?php echo $message['facebook_email']; ?></a> в <?php echo $message['created_at']; ?>
			<?php if ($message['user_id'] == $page_params['user_id']) :?>
				<div class="float-right">
					Edit
					Delete
				</div>
			<?php endif; ?>
		</div>
	</div>
	<p class="mark p-2"><?php echo $message['message']; ?></p>
	<hr>
<?php endforeach; ?>

</div>