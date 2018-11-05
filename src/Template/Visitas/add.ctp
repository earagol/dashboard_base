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

<!-- <div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
        </script>
    </div>
</div> -->

<?= $this->Form->end() ?>
<?php //echo $this->Html->css('../vendors/bootstrap/css/bootstrap.min') ?>

<script>
    (function( $ ) {

        $('#fecha-vencimiento').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        // $('#fecha-vencimiento').datetimepicker({
        //     format: 'mm/dd/yyyy'
        // });
        // $(document).ready(function() {
        //     // $('#fecha-vencimiento').datepicker();
        //     // $('#fecha-vencimiento').datepicker({
        //     //     format: 'mm/dd/yyyy'
        //     // });

        //     $('#fecha-vencimiento').datetimepicker({
        //         format: 'mm/dd/yyyy'
        //     });

        // });
    })(jQuery);
</script>

