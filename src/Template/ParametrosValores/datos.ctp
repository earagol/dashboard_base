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

