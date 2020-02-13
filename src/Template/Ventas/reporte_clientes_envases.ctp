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
            <strong>Reporte Clientes Envases</strong>
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

            <?php if(isset($detallesEmbases)): ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                             <tr>
                            <?php foreach ($headerClientes as $key => $value) { ?>
                               
                                    <th><?php echo $value; ?></th>
                                
                            <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if($detallesEmbases){ 
                                   
                                    $prodcutTotal = $productos;
                                    foreach ($prodcutTotal  as $key => $value) {
                                        $prodcutTotal[$key]=0;
                                    }
                                    // pr($prodcutTotal);

                                    foreach ($detallesEmbases as $detalle => $detalles) { 
                                        // prx($detalles['productos']);
                                    ?>
                                        <tr>
                                            <td><?php echo utf8_encode($detalles['nombre']); ?></td>
                                            <td><?php echo utf8_encode($detalles['direccion']); ?></td>
                                            <?php foreach ($detalles['productos'] as $pro => $pros) { 
                                                    $prodcutTotal[$pro]+= $pros?$pros:0;
                                                ?>
                                                <td><?php echo $pros; ?></td>
                                            <?php } ?>
                                            <td><?php echo utf8_encode($detalles['observacion']); ?></td>
                                        </tr>
                             <?php }  ?>
                                    <tr>
                                        <td colspan="2">Totales:</td>
                                        <?php foreach ($prodcutTotal as $key => $value) { ?>
                                            <td><?php echo $value; ?></td>
                                        <?php } ?>
                                        <td></td>
                                    </tr>
                            <?php  } ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
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
                if($detallesEmbases){ 
                   
                    $prodcutTotal = $detalles['productos'];
                    foreach ($prodcutTotal  as $key => $value) {
                        $prodcutTotal[$key]=0;
                    }

                    foreach ($detallesEmbases as $detalle => $detalles) { 
                    ?>
                        <tr>
                            <td><?php echo utf8_encode($detalles['nombre']); ?></td>
                            <td><?php echo utf8_encode($detalles['direccion']); ?></td>
                            <?php foreach ($detalles['productos'] as $pro => $pros) { 
                                    $prodcutTotal[$pro]+=$pros;
                                ?>
                                <td><?php echo $pros; ?></td>
                            <?php } ?>
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
                <td></td>
            </tr>
    
    </tbody>
</table>


<?php } ?>