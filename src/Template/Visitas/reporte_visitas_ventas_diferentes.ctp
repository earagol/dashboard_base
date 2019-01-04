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
                <th>Vendedor</th>
                <th>Cliente</th>
                <th>Direccion</th>
                <th>Detalle</th>
        <?php foreach ($productos as $key => $value) { ?>
           
                <th><?php echo $value; ?></th>
            
        <?php } ?>
                <th>Monto</th>
        </tr>
        
    </thead>
    <tbody>

        <?php if($ventas): ?>
        
            <?php foreach ($ventas as $detalle => $detalles) { ?>
                <tr>
                    <td><?php echo utf8_encode($detalles['vendedor']); ?></td>
                    <td><?php echo utf8_encode($detalles['cliente']); ?></td>
                    <td><?php echo utf8_encode($detalles['direccion']); ?></td>
                    <td>Visita</td>
                    <?php if($detalles['productos_visita']): ?>
                        <?php foreach ($detalles['productos_visita'] as $pro => $pros) { ?>
                                <td><?php echo $pros; ?></td>
                        <?php } ?>
                    <?php else: ?>
                        <?php foreach ($productos as $key => $value) { ?>
                                <th></th>
                        <?php } ?>
                    <?php endif; ?>
                    <td><?php echo utf8_encode($detalles['monto_visita']); ?></td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Venta</td>
                    <?php if($detalles['productos_venta']): ?>
                        <?php foreach ($detalles['productos_venta'] as $pro => $pros) { ?>
                                <td><?php echo $pros; ?></td>
                        <?php } ?>
                    <?php else: ?>
                        <?php foreach ($productos as $key => $value) { ?>
                                <th></th>
                        <?php } ?>
                    <?php endif; ?>
                    <td><?php echo utf8_encode($detalles['monto_venta']); ?></td>
                </tr>
            <?php } ?>

        <?php endif; ?>
    
    </tbody>
</table>


<?php } ?>
