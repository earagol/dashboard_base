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
            <strong>Reporte Consolidado</strong>
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

<p><?php echo $usuario->full_name; ?></p>

<table>
    <thead>
         <tr>
        <?php foreach ($headerClientes as $key => $value) { ?>
           
                <th><?php echo $value; ?></th>
            
        <?php } ?>
        </tr>
        
    </thead>
    <tbody>
        
            <?php 
                $montoEfecTotal=0;
                $montoTransTotal=0;
                $cxcTotal=0;
                if($detallesVentas){ 
                    $prodcutTotal = $detalles['productos'];
                    foreach ($prodcutTotal  as $key => $value) {
                        $prodcutTotal[$key]=0;
                    }

                    foreach ($detallesVentas as $detalle => $detalles) { 
                        $montoEfecTotal+=$detalles['monto_efectivo'];
                        $montoTransTotal+=$detalles['monto_transferencia'];
                        $cxcTotal+=$detalles['cuenta_porcobrar'];
                    ?>
                        <tr>
                            <td><?php echo utf8_encode($detalles['nombre']); ?></td>
                            <td><?php echo utf8_encode($detalles['direccion']); ?></td>
                            <?php foreach ($detalles['productos'] as $pro => $pros) { 
                                    $prodcutTotal[$pro]+=$pros;
                                ?>
                                <td><?php echo $pros; ?></td>
                            <?php } ?>
                            <td><?php echo utf8_encode($detalles['monto_efectivo']); ?></td>
                            <td><?php echo utf8_encode($detalles['monto_transferencia']); ?></td>
                            <td><?php echo utf8_encode($detalles['cuenta_porcobrar']); ?></td>
                            <td><?php echo utf8_encode($detalles['observacion']); ?></td>
                        </tr>
                    <?php } 

                }
            ?>

            <tr>
                <td colspan="2">Totales:</td>
                <?php foreach ($prodcutTotal as $key => $value) { ?>
                    <td><?php echo $value; ?></td>
                <?php } ?>
                <td><?php echo $montoEfecTotal; ?></td>
                <td><?php echo $montoTransTotal; ?></td>
                <td><?php echo $cxcTotal; ?></td>
                <td></td>
            </tr>
    
    </tbody>
</table>

<hr>

<table style="margin-top: 10px;">
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
                    <?php } ?>
                    <tr>
                    <td>Totales:</td>
                    <?php foreach ($productoTotal as $key => $value) { ?>
                        <td><?php echo $value; ?></td>
                    <?php } ?>
                    </tr>
                    <tr>
                        <td>Embases</td>
                        <?php foreach ($retornos['valores'] as $diaKeyValor => $diaValor) { ?>
                            <td><?php echo $diaValor['cantidad']; ?></td>
                        <?php } ?>
                    </tr>
            <?php
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
                <td><?php echo $ventas['cuenta_porcobrar']?$ventas['cuenta_porcobrar']:''; ?></td>
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

            <tr><td></td></tr>
            <tr><td></td></tr>
            <tr><td></td></tr>
        
    </tbody>
</table>

<h3>CARTERA RECOGIDA</h3>

<table>
    <thead>
         <tr>
            <td>Cliente</td>
            <td>Valor</td>
        </tr>
        
    </thead>
    <tbody>

            <?php 
            $granTotal=0;
            $efectivoTotal=0;
            $transTotal = 0;
                if($carteraRecogida){ 
                    foreach ($carteraRecogida as $carKey => $valueCartera) { 
                        $efectivoTotal+=$valueCartera->monto_efectivo_cartera;
                        $transTotal+=$valueCartera->monto_transferencia_cartera;
                        $granTotal+=is_null($valueCartera->monto_transferencia_cartera)?$valueCartera->monto_cartera:0;
                        ?>
                        <tr>
                            <td><?php echo utf8_encode($valueCartera->cliente->nombres); ?></td>
                            <td><?php echo $valueCartera->monto_cartera; ?></td>
                        </tr>
                    <?php }
                }
            ?>

            <tr><td></td></tr>

            <tr>
                <td>TOTAL EFECTIVO/CHEQUE</td>
                <td><?php echo $efectivoTotal; ?></td>
            </tr>

            <tr>
                <td>TOTAL TRANSFERENCIAS</td>
                <td><?php echo $transTotal; ?></td>
            </tr>

            <tr>
                <td>GRAN TOTAL</td>
                <td><?php echo ($granTotal); ?></td>
            </tr>
        
    </tbody>
</table>

<h3>GRAN TOTAL : <?php echo (($ventas['monto_total'] + $granTotal)- $totalGasto)?></h3>


<?php } ?>