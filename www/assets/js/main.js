if (window.location.hash == '#_=_'){
	history.replaceState
		? history.replaceState(null, null, window.location.href.split('#')[0])
		: window.location.hash = '';
}

jQuery(document).ready(function($) {
	/*
	 * use ajax for delete message
	 */
	$(document).on('click', '.delete', function(e) {
		e.preventDefault();
		var id = $(this).data('id');
		var model = $(this).data('model');
		$.ajax({
			url: '/'+model+'/delete',
			type: "POST",
			data: {
				id: id
			},
			success: function (response) {
				var response = $.parseJSON(response);
				if ( response.status == 'success' ) {
					$('#'+model+'_'+id).remove();
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

	/*
	 * show modal with message text
	 */
	$(document).on('click', '.edit', function(e) {
		e.preventDefault();
		var id = $(this).data('id');
		var model = $(this).data('model');
		var text = $('#'+model+'_text_id_'+id).html();

		$('#edit_id').val(id);//set edit id
		$('#edit_model').val(model);//set edit model
		$('#edit_text').val(text);//set edit text
	});

	/*
	 * save edit message
	 */
	$(document).on('click', '#save_edit', function(e) {
		e.preventDefault();
		var id = $('#edit_id').val();
		var text = $('#edit_text').val();
		var model = $('#edit_model').val();

		$.ajax({
			url: '/'+model+'/update',
			type: "POST",
			data: {
				id: id,
				text: text
			},
			success: function (response) {
				var response = $.parseJSON(response);
				if ( response.status == 'success' ) {
					$('#'+model+'_updated_at_'+id + ' span').html(response.updated_at);//update edit last update
					$('#'+model+'_updated_at_'+id).removeClass('d-none');
					$('#'+model+'_text_id_'+id).html(text);//update edit text
					successMessage(response.message);//show edit success
				} else if ( response.status == 'error' ) {
					errorMessage(response.message);//show edit error
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
		// alert('need fix fast scroll user');

		var skipRows = 5; // default skip rows from DB
		var isEnd = false;
		var currentUserId = $('#current_user_id').val();
		var win = $('.message_list');

		var flag = 0; // don't start ajax before end ajax

		// Each time the user scrolls
		win.scroll(function() {
			// End of the document reached?
			if ( isEnd === false ) {
				if ($('.correct_height_message_list').height() - win.height() <= win.scrollTop()) {
					$('#loading').show();

					if ( flag == 0 ) {
						flag = 1;
						$.ajax({
							url: '/message/getAjaxMessages',
							type: "POST",
							data: {
								skip: skipRows
							},
							success: function(response) {
								flag = 0;
								response = $.parseJSON(response); // get object from json
								if ( response.status == 'success' ) { //also i try build html in js, but it's not readably
									skipRows += response.skip; // add to skip from db
									$('#messages').append(response.html); // if status success i add messages
								} else if ( response.status == 'error' ) {
									isEnd = true; //set false for not search in DB and don't use ajax
								}
								$('#loading').hide();
							}
						});
					}
				}
			}
		});
	}
});