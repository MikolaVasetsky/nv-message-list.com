<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Редактировать</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<textarea name="edit_text" class="form-control" rows="3" required="required" placeholder="Текст ..." id="edit_text"></textarea>
			</div>
			<div class="modal-footer">
				<input type="hidden" name="edit_id" id="edit_id">
				<input type="hidden" name="edit_model" id="edit_model">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
				<button type="button" class="btn btn-primary" id="save_edit" data-dismiss="modal">Сохранить</button>
			</div>
		</div>
	</div>
</div>