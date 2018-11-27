<div class="modal fade" id="ModalFlashSuccess">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title heading-primary">
					Información
				</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-success mb-none">
					<i class="fa fa-check-circle"></i>
					<?php
						$class = 'message';
						if (!empty($params['class'])) {
						    $class .= ' ' . $params['class'];
						}
						if (!isset($params['escape']) || $params['escape'] !== false) {
						    echo  h($message);
						}
					?>
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
        jQuery('#ModalFlashSuccess').modal();
    })(jQuery);
</script>