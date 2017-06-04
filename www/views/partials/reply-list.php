<div class="collapse" id="reply_collapse<?php echo $comment['id']; ?>">
	<div class="comments ml-5">
		<?php foreach( $comment['replys']->rows as $reply): ?>
			<div id="reply_<?php echo $reply['id']; ?>">
				<div class="mb-2">
					<span>Написано </span>
					<a href="mailto:<?php echo $reply['facebook_email']; ?>"><?php echo $reply['facebook_email']; ?></a> 
					<span>в <?php echo $reply['created_at']; ?></span>

					<span class="text-muted <?php if ( $reply['created_at'] == $reply['updated_at'] ) : ?> d-none <?php endif; ?>" id="reply_updated_at_<?php echo $reply['id']; ?>""> изменено <span><?php echo $reply['updated_at']; ?></span></span>

					<?php if ($reply['user_id'] == $page_params['user_id']) :?>
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