<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ruta $ruta
 */
if(!isset($excel)){ 
?>
<?php echo $this->Form->create() ?>
 <div class="col-lg-12 ">
    <div class="card">
        <div class="card-header">
            <strong>Reporte Consolidado por rutas</strong>
            <div class="pull-right">
                <?php echo $this->Html->link(__('Volver',['class'=>'btn btn-default']), ['action' => 'index']) ?></li>
            </div>
        </div>
        <div class="card-body card-block">

            <div class="form-group">
                <label for="company" class=" form-control-label">Fecha Desde</label>
                 <?php echo $this->Form->control('desde',['value'=>date('Y-m-d'),'type'=>'text','class'=>'form-control','placeholder'=>'Fecha','label'=>false,'data-toggle'=>'datetimepicker', 'data-target'=>'#desde']); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Fecha Hasta</label>
                 <?php echo $this->Form->control('hasta',['value'=>date('Y-m-d'),'type'=>'text','class'=>'form-control','placeholder'=>'Fecha','label'=>false,'data-toggle'=>'datetimepicker', 'data-target'=>'#hasta']); ?>
            </div>

            <div class="form-group">
                <?php echo $this->Form->button(__('Ver',['class'=>'btn btn-primary'])) ?>
            </div>

        </div>
    </div>
</div>

<?= $this->Form->end() ?>
<script>
    (function( $ ) {
        $('#desde,#hasta').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    })(jQuery);
</script>

<?php 
}else{ ?>


<head>
<meta charset="UTF-8">
</head>
<style>
    td, th{
        border: 1px solid;
        padding: 3px;
    }
    tr:nth-child(even) {background-color: #f2f2f2}
</style>


<table>
    <thead>
         <tr>
            <th>Ruta</th>
            <th>Monto Venta</th>
            <th>Monto CXC</th>
            <th>Monto Cartera Recogida</th>
        </tr>
        
    </thead>
    <tbody>

            <?php 
                if($consolidados){ 
                    foreach ($consolidados as $key => $consolidado) { ?>
                        <tr>
                            <td><?php echo utf8_encode($consolidado->Rutas['nombre']); ?></td>
                            <td><?php echo number_format($consolidado->monto_total, 0, ",", "."); ?></td>
                            <td><?php echo number_format($consolidado->cuenta_porcobrar, 0, ",", "."); ?></td>
                            <td><?php echo number_format($consolidado->monto_cartera, 0, ",", "."); ?></td>
                        </tr>
                    <?php }
                }
            ?>
    </tbody>
</table>


<?php } ?>

