<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ruta $ruta
 */
?>
<style>
    hr {
        height: 10px;
        border: 0;
        box-shadow: 0 10px 10px -10px #8c8b8b inset;
    }

    .form-control-borderless {
        border: none;
    }

    .form-control-borderless:hover, .form-control-borderless:active, .form-control-borderless:focus {
        border: none;
        outline: none;
        box-shadow: none;
    }

    .modal {
        position: absolute;
        /*left: 0px;
        top: 0px;*/
        z-index: 10000;
    }
</style>

<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" /> -->


<?php echo $this->Form->create('precios',['id'=>'formVentas']) ?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Precios Clientes (<?php echo $cliente->nombres; ?>)</strong>
            <div class="pull-right">
                <?php echo $this->Html->link(__('Volver',['class'=>'btn btn-default']), ['action' => 'index']) ?></li>
            </div>
        </div>
        <?php echo $this->Form->control('cliente_id',['class'=>'form-control','type'=>'hidden','value'=>$cliente->id,'label'=>false]); ?>
        <div class="card-body card-block">

            <div class="row col-lg-12">
                <div class="col-lg-4 col-xs-12 col-sm-12">
                     <label for="company" class=" form-control-label">Producto</label>
                      <?php echo $this->Form->control('producto_id',['class'=>'form-control','empty'=>'--Seleccione el Producto','label'=>false]); ?>
                </div>

                <div class="col-lg-3 col-xs-12 col-sm-12">
                     <label for="company" class=" form-control-label">Precio</label>
                      <?php echo $this->Form->control('precio_id',['empty'=>'--Seleccione el Precio','class'=>'form-control','label'=>false]); ?>
                </div>

                <div class="col-lg-1 col-xs-12 col-sm-12">
                    <div class="form-group">
                        <label for="company" class=" form-control-label">Acción</label><br>
                        <?php echo $this->Form->button(__('+',['class'=>'btn btn-primary'])) ?>
                    </div>
                    
                </div>
            </div>

            <hr class="my-4">

             <div class = "page-header text-center col-lg-12">
               <h3>
                  Detalle de Precios del Cliente
               </h3>
            </div>
            <br>

            <div class="row text-center col-lg-12 col-md-12 col-sm-12"  id="grilla" style="margin-top: 5px;min-height: 300px;">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Producto</th>
                                <th scope="col">Precio Asociado</th>
                                <th >Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php if($cliente->clientes_precios){ 
                        			foreach($cliente->clientes_precios as $key => $valor){ ?>
                        				<tr>
		                        			<td ><?php echo $valor->productos_precio->producto->nombre; ?></td>
		                        			<td ><?php echo $valor->productos_precio->precio; ?></td>
				                            <td >
				                            	<?php echo $this->Html->link(__('<i class="fa fa-trash-o"></i>'), ['controller'=>'Clientes','action' => 'deleteprecio', $valor->id, $cliente->id],['title'=>'Editar','escape' => false]) ?>
				                            </td>
				                        </tr>
		                        <?php } ?>
                        	<?php }else{ ?>
                        		<tr>
                        			<td ></td>
		                            <td ></td>
		                            <td ></td>
		                          </tr>
                        	<?php } ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->Form->end() ?>



<?php $productos = json_encode($productos); ?>
<?php $precios = json_encode($productosPrecios); ?>

<script type="text/javascript">
	// $('#producto-id').val('');
    /*

    Para incorporar la cartera a las cuanta por cobrar se debe descomentar las lineas que digan descomentar

    */
    // var url1 = '<?php echo $url; ?>';
    // var csrfToken = <?php echo json_encode($this->request->getParam('_csrfToken')) ?>;

    var precios = '<?php echo $precios ?>';

    (function( $ ) {
        var jsonPrecios = $.parseJSON(precios);

        $('#producto-id').change(function() {
            cargarPrecio($(this).val());
        });

        function cargarPrecio(valor){
            $('#precio-id').empty();
            $('#precio-id').append('<option value="">--Seleccione el precio--</option>');
            // precioCliente = 0;
            $.each(jsonPrecios,function(i,valp){
                if(valp.producto_id == $('#producto-id').val()){
                    $('#precio-id').append('<option value="'+valp.id+'">'+valp.precio+'</option>');
                    // if(jsonPreciosClientes){
                    //     $.each(jsonPreciosClientes,function(y,pre){
                    //         if(pre.producto_precio_id == valp.id){
                    //             precioCliente = valp.id;
                    //         }
                    //     });
                    // }
                }
            });

            // if(precioCliente != 0){
            //     $('#precio-id').val(precioCliente);
            // }
        }
    })(jQuery);
</script>