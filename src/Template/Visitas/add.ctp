<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ruta $ruta
 */
?>
<?php echo $this->Form->create($visita) ?>
 <div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Agregar Visita</strong>
            <div class="pull-right">
                <?php echo $this->Html->link(__('Volver',['class'=>'btn btn-default']), ['action' => 'index']) ?></li>
            </div>
        </div>
        <div class="card-body card-block">
            <div class="form-group">
                <label for="company" class=" form-control-label">Vendedor</label>
                <?php echo $this->Form->control('usuario_id',['class'=>'form-control','label'=>false,'empty' => '--Seleccione al vendedor--']); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Cliente</label>
                <?php echo $this->Form->control('cliente_id',['class'=>'form-control','empty' => '--Selecciones al cliente--','label'=>false]); ?>
            </div>

            <div class="form-group" >
                <label for="company" class=" form-control-label">Fecha Vencimiento</label>
                <?php echo $this->Form->control('fecha_vencimiento',['value'=>'','type'=>'text','class'=>'form-control','placeholder'=>'Fecha','label'=>false,'data-toggle'=>'datetimepicker', 'data-target'=>'#fecha-vencimiento']); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Observación</label>
                <?php echo $this->Form->control('observacion',['type'=>'textarea','class'=>'form-control','placeholder'=>'Observación...','label'=>false]); ?>
            </div>

            <div class="form-group">
                <?php echo $this->Form->button(__('Guardar',['class'=>'btn btn-primary'])) ?>
            </div>

        </div>
    </div>
</div>

<?= $this->Form->end() ?>

<script>
    (function( $ ) {
        $('#fecha-vencimiento').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    })(jQuery);
</script>

