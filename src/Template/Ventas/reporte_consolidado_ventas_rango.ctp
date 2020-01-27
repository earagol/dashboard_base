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
            <strong>Reporte Consolidado de Ventas por Rango de Fechas</strong>
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
            <th>FECHA</th>
            <th>VTA. DÍA</th>
            <?php foreach ($headers as $key => $value) { ?>
                    <th><?php echo $value; ?></th>
            <?php } ?>
        </tr>
        
    </thead>
    <tbody>

            <?php 
                $totalVenta = 0;
                $totalesItems = [];
                if($valores){ 
                    foreach ($valores as $key => $valor) { 
                        $totalVenta+= $valor['monto_venta'];
                        ?>
                        <tr>
                            <td><?php echo $key." - (".$valor['fecha_nombre_dia'].")"; ?></td>
                            <td><?php echo number_format($valor['monto_venta'], 0, ",", "."); ?></td>
                            <?php foreach ($valor['unidos'] as $keyu => $valueu) { 
                                    if(isset($totalesItems[$keyu])){
                                        $totalesItems[$keyu]+= $valueu['cantidad'];
                                    }else{
                                        $totalesItems[$keyu] = $valueu['cantidad'];
                                    }
                                ?>
                                    <td><?php echo $valueu['cantidad']; ?></td>
                            <?php } ?>
                        </tr>
                    <?php } 
                }
            ?>
            <tr>
                <td>Totales:</td>
                <td><?php echo $totalVenta; ?></td>
                <?php
                    if($totalesItems){
                        foreach ($totalesItems as $key => $value) { ?>
                           <td><?php echo $value; ?></td>
                <?php   }
                    }
                ?>
                
            </tr>
    </tbody>
</table>


<?php } ?>

