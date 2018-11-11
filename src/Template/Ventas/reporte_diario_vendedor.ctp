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
            <strong>Reporte Diario</strong>
            <div class="pull-right">
                <?php echo $this->Html->link(__('Volver',['class'=>'btn btn-default']), ['action' => 'index']) ?></li>
            </div>
        </div>
        <div class="card-body card-block">
            <div class="form-group">
                <label for="company" class=" form-control-label">Vendedor</label>
                <?php echo $this->Form->control('usuario_id',['class'=>'form-control','empty'=>'--Seleccione--','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Fecha</label>
                 <?php echo $this->Form->control('fecha',['value'=>date('Y-m-d'),'type'=>'text','class'=>'form-control','placeholder'=>'Fecha','label'=>false,'data-toggle'=>'datetimepicker', 'data-target'=>'#fecha']); ?>
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
        $('#fecha').datetimepicker({
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

<h3><?php echo $usuario->full_name; ?></h3>

<table>
    <thead>
         <tr>
        <?php foreach ($header as $key => $value) { ?>
           
                <th><?php echo $value; ?></th>
            
        <?php } ?>
        </tr>
        
    </thead>
    <tbody>

            <?php 
                if($diario){ 
                    foreach ($diario as $dia => $valueDia) { ?>
                        <tr>
                            <td><?php echo utf8_encode($valueDia['nombre']); ?></td>
                            <?php foreach ($valueDia['valores'] as $diaKeyValor => $diaValor) { ?>
                                <td><?php echo $diaValor['cantidad']; ?></td>
                            <?php } ?>
                        </tr>
                    <?php }
                }
            ?>

            <tr><td></td></tr>

            <tr>
                <td>TOTAL EFECTIVO</td>
                <td><?php echo $ventas['monto_efectivo']?$ventas['monto_efectivo']:''; ?></td>
            </tr>

            <tr>
                <td>TOTAL TRANSFERENCIAS</td>
                <td><?php echo $ventas['monto_transferencia']?$ventas['monto_transferencia']:''; ?></td>
            </tr>

            <tr>
                <td>TOTAL CXC</td>
                <td>?</td>
            </tr>

            <tr>
                <td>TOTAL VENTAS</td>
                <td><?php echo $ventas['monto_total']?$ventas['monto_total']:''; ?></td>
            </tr>

            <tr><td></td></tr>

            <?php 
                $totalGasto = 0;
                if($gasto){ 

                    foreach ($gasto as $keyGasto => $valueGasto) { 
                        $totalGasto+=$valueGasto['cantidad'];
                        ?>
                        <tr>
                            <td><?php echo utf8_encode($valueGasto['nombre']); ?></td>
                            <td><?php echo $valueGasto['cantidad']; ?></td>
                        </tr>
             <?php }  ?>

                    <tr>
                        <td>TOTAL DESCUENTO</td>
                        <td><?php echo $totalGasto?$totalGasto:''; ?></td>
                    </tr>

            <?php  }
            ?>
        
    </tbody>
</table>


<?php } ?>

