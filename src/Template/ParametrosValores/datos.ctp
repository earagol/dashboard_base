<?php echo $this->Form->control('tipo',['type'=>'hidden','value'=>$tipo,'label'=>false]); ?>
<?php 
if($tipo == 'Diario' ){
		foreach ($productos as $key => $value) { 
?>
		<div class="form-group">
		    <label for="company" class=" form-control-label"><?php echo $value; ?></label>
		    <?php echo $this->Form->control('producto_id_'.$key,['type'=> 'text','class'=>'form-control','label'=>false]); ?>
		</div>
<?php 	}
}else{ ?>

	<div class="form-group">
        <label for="company" class=" form-control-label">Monto/Cantidad</label>
        <?php echo $this->Form->control('monto_o_cantidad',['class'=>'form-control','placeholder'=>'Monto/cantidad','label'=>false]); ?>
    </div>


<?php 
}
?>

<script type="text/javascript">

    (function( $ ) {

    		<?php foreach ($productos as $key => $value): ?>

					 $("#producto-id-<?php echo $key; ?>").on({
			              "change": function(event) {
			                $(event.target).select();
			              },
			              "keyup": function(event) {
			                $(event.target).val(function(index, value) {
			                  return value.replace(/\D/g, "")
			                    // .replace(/([0-9])([0-9]{2})$/, '$1.$2') //Agrega decimal 
			                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
			                });
			              }
			            });

			<?php 	endforeach; ?>

			$("#monto-o-cantidad").on({
              "change": function(event) {
                $(event.target).select();
              },
              "keyup": function(event) {
                $(event.target).val(function(index, value) {
                  return value.replace(/\D/g, "")
                    // .replace(/([0-9])([0-9]{2})$/, '$1.$2') //Agrega decimal 
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
                });
              }
            });

    })(jQuery);
</script>
