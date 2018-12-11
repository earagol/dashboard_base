<label for="company" class=" form-control-label">Cliente</label>
<?php echo $this->Form->control('cliente_id', [
                                    // 'default' => $cliente? $cliente->id : '',
                                    'empty' => 'Seleccione un cliente',
                                    'class' => 'form-control',
                                    'label' => false,
                                    'multiple' => false,
                                    'tabindex' => 1,
                                    ]); ?>


<?php echo $this->Html->css('../vendors/select2-bootstrap/dist/select2') ?>
<?php echo $this->Html->css('../vendors/select2-bootstrap/dist/select2-bootstrap') ?>
<?php echo $this->Html->script('../vendors/select2-bootstrap/dist/select2') ?>


<script type="text/javascript">

	(function( $ ) {
		$("#cliente-id").select2({
	        language: {
	            noResults: function() {
	                return "<b>No se encontraron coincidencias.</b>";
	            }
	        },
	        escapeMarkup: function (markup) {
	            return markup;
	        }
	    });
	})(jQuery);
</script>