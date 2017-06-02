if (window.location.hash == '#_=_'){
	history.replaceState
		? history.replaceState(null, null, window.location.href.split('#')[0])
		: window.location.hash = '';
}

jQuery(document).ready(function($) {
	/*
	 * use ajax for delete message
	 */
	$(document).on('click', '#delete_message', function(e) {
		e.preventDefault();
		var message_id = $(this).data('id');
		$.ajax({
			url: '/message/delete',
			type: "POST",
			data: {
				id: message_id
			},
			success: function (response) {
				var response = $.parseJSON(response);
				if ( response.status == 'success' ) {
					$('#message_'+message_id).remove();
					successMessage(response.message);//show message success
				} else if ( response.status == 'error' ) {
					errorMessage(response.message);//show message error
				}
			},
			error: function (error) {
				errorMessage(error);
			}
		});
	});

	function successMessage(message) {
		var html = `
			<div class="alert alert-success alert-dismissible fade show action_message" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<strong>Успех!</strong> `+message+`
			</div>
		`;
		$('body').append(html);
	}

	function errorMessage(message) {
		var html = `
			<div class="alert alert-danger alert-dismissible fade show action_message" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<strong>Неудача!</strong> `+message+`
			</div>
		`;
		$('body').append(html);
	}

	/*
	 * Code for message page ajax load next messages
	 */
	if ( $('.message_list') ) {
		let skipRows = 5; // default skip rows from DB
		let isEnd = false;
		let currentUserId = $('#current_user_id').val();
		let win = $('.message_list');

		// Each time the user scrolls
		win.scroll(function() {
			// End of the document reached?
			if ( isEnd === false ) {
				if ($('.correct_height_message_list').height() - win.height() <= win.scrollTop()) {
					$('#loading').show();

					$.ajax({
						url: '/message/getAjaxMessages',
						type: "POST",
						data: {
							skip: skipRows
						},
						success: function(response) {
							skipRows += 5; // add to skip from db
							let html = '';
							response = $.parseJSON(response); // get object from json
							if ( response.status == 'success' ) {
								let messages = $.parseJSON(response.data);
								messages.forEach(function(message) { //each data from DB and generate html for append to list
									html += `
										<div id="message_`+message.id+`">
											<div class="mb-2">
												Написано <a href="mailto:`+message.facebook_email+`">`+message.facebook_email+`</a> в `+message.created_at+`
												`;
												if ( message.user_id == currentUserId) { // check if current user can edit this message
													html += `
														<div class="float-right">
															<a href="javascript:void(0)" data-id="`+message.id+`" class="mr-2"><img src="/assets/img/edit.png"></a>
															<a href="javascript:void(0)" data-id="`+message.id+`" id="delete_message"><img src="/assets/img/delete.png"></a>
														</div>
													`;
												}
												html += `
											</div>
											<p class="mark p-2">`+message.message+`</p>
											<hr>
										</div>
									`;
								});
							} else if ( response.status == 'error' ) {
								isEnd = true; //set false for not search in DB and don't use ajax
							}
							$('#messages').append(html);
							$('#loading').hide();
						}
					});
				}
			}
		});
	}
});