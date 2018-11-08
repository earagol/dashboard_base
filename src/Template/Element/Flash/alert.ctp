<div class="modal fade" id="errorModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title heading-primary text-left">
					ATENCIÓN
				</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-warning mb-none">
					<i class="fa fa-warning"></i>
					<?php echo $message ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">
					Cerrar
				</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	 (function( $ ) {
		$('#errorModal').modal('show');
	})(jQuery);
</script>