<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ruta $ruta
 */

            // echo $this->Form->control('cliente_id', ['options' => $clientes]);
            // echo $this->Form->control('usuario_id', ['options' => $usuarios]);
            // echo $this->Form->control('monto_total');
            // echo $this->Form->control('efectivo');
            // echo $this->Form->control('monto_efectivo');
            // echo $this->Form->control('transferencia');
            // echo $this->Form->control('monto_transferencia');
            // echo $this->Form->control('cuenta_porcobrar');
            // echo $this->Form->control('pago_cartera');
            // echo $this->Form->control('ano');
            // echo $this->Form->control('mes');
            // echo $this->Form->control('dia');
            // echo $this->Form->control('observacion');
            // echo $this->Form->control('deleted', ['empty' => true]);
?>
<?php echo $this->Form->create($venta) ?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Venta</strong>
            <div class="pull-right">
                <?php echo $this->Html->link(__('Volver',['class'=>'btn btn-default']), ['action' => 'index']) ?></li>
            </div>
        </div>
        <div class="card-body card-block">
            <div class="form-group">
                <label for="company" class=" form-control-label">Cliente</label>
                <?php echo $this->Form->control('cliente_id', ['type'=>'hidden','value' => $cliente->id]); ?>
                <?php echo $this->Form->control('cliente',['class'=>'form-control','value'=>$cliente->nombres,'label'=>false]); ?>
            </div>

            <div class="row col-lg-12">
                <div class="col-lg-3">
                     <label for="company" class=" form-control-label">Producto</label>
                      <?php echo $this->Form->control('producto_id',['class'=>'form-control','empty'=>'--Seleccione el Producto','label'=>false]); ?>
                </div>

                <div class="col-lg-3">
                     <label for="company" class=" form-control-label">Precio</label>
                      <?php echo $this->Form->control('precio_id',['empty'=>'--Seleccione el Precio','class'=>'form-control','label'=>false]); ?>
                </div>

                <div class="col-lg-4">
                     <label for="company" class=" form-control-label">Cantidad</label>
                      <?php echo $this->Form->control('cantidad',['class'=>'form-control','label'=>false]); ?>
                </div>

                <div class="col-lg-1">
                    <label for="company" class=" form-control-label">Acción</label>
                     <?php echo $this->Form->button('+',['type'=>'button','class'=>'btn btn-primary','id' => 'plus']) ?>
                </div>
            </div>

            <div id="grilla" style="margin-top: 5px;max-height: 300px;">
                
            </div>

            <?php if($carteraPendiente): ?>

                <div class="form-check">
                    <?php echo $this->Form->control('pagar_cartera', ['type'=>'checkbox','class'=>'form-check-input','label'=>false,'checked'=>false]); ?>
                    <label for="company" class=" form-check-label">Cancela Cartera?</label>
                </div>

                <div class="form-group">
                    <label for="company" class=" form-control-label">Monto Deuda</label>
                    <?php echo $this->Form->control('monto_deuda', ['class'=>'form-control','value' => $carteraPendiente,'label'=>false,'style'=>'width:20%','readonly'=>'readonly']); ?>
                </div>

            <?php endif; ?>

            <div class="form-group">
                <label for="company" class=" form-control-label">Cuenta por cobrar</label>
                <?php echo $this->Form->control('cuenta_porcobrar', ['type'=>'text','class'=>'form-control','value' => 0,'label'=>false,'readonly'=>'readonly']); ?>
            </div>

            <div class="form-check">
                <?php echo $this->Form->control('efectivo', ['type'=>'checkbox','class'=>'form-check-input','label'=>false]); ?>
                <label for="company" class=" form-check-label">Efectivo</label>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Monto Efectivo</label>
                <?php echo $this->Form->control('monto_efectivo', ['class'=>'form-control','value' => '','label'=>false,'readonly'=>'readonly']); ?>
            </div>

            <div class="form-check">
                <?php echo $this->Form->control('transferencia', ['type'=>'checkbox','class'=>'form-check-input','label'=>false]); ?>
                <label for="company" class=" form-check-label">transferencia</label>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Monto Transferencia</label>
                <?php echo $this->Form->control('monto_transferencia', ['class'=>'form-control','value' => '','label'=>false,'readonly'=>'readonly']); ?>
            </div>

            <div class="form-group">
                <?php echo $this->Form->button(__('Guardar',['class'=>'btn btn-primary'])) ?>
            </div>

        </div>
    </div>
</div>

<?= $this->Form->end() ?>
<?php $productos = json_encode($productos); ?>
<?php $precios = json_encode($productosPrecios); ?>


<script type="text/javascript">
    var url1 = '<?php echo $url; ?>';
    var csrfToken = <?php echo json_encode($this->request->getParam('_csrfToken')) ?>;

    var precios = '<?php echo $precios ?>';
    var jsonPrecios = $.parseJSON(precios);

    (function( $ ) {

            $('#producto-id').change(function() {
                cargarPrecio($(this).val());
            });

            function cargarPrecio(valor){
                $('#precio-id').empty();
                $('#precio-id').append('<option value="">--Seleccione el precio--</option>');
                $.each(jsonPrecios,function(i,valp){
                    if(valp.producto_id == $('#producto-id').val()){
                        $('#precio-id').append('<option value="'+valp.id+'">'+valp.precio+'</option>');
                    }
                });
            }

            $('#plus').click(function() {
                if($('#producto-id').val() == ''){
                    alert('Seleccione el Producto');
                    return;
                }

                if($('#precio-id').val() == ''){
                    alert('Seleccione el Precio');
                    return;
                }

                if($('#cantidad').val() == ''){
                    alert('Ingrese la cantidad');
                    return;
                }

                $.ajax({
                    url:url1+'ventas/detalles',
                    dataType: 'html',
                    type: 'POST',
                    headers: {
                        'X-CSRF-Token': csrfToken
                    },
                    data:{
                        tipo: 1,
                        producto: $('#producto-id').val(),
                        precio: $('#precio-id').val(),
                        cantidad: $('#cantidad').val()
                    },
                    success: function(response){
                        $('#grilla').html(response);
                    }
                });

            });

            $('#pagar-cartera').change(function(){
                if($(this).is(':checked')){
                    var cuenta = eval($('#cuenta-porcobrar').val()) + eval($('#monto-deuda').val());
                }else{
                    var cuenta = eval($('#cuenta-porcobrar').val()) - eval($('#monto-deuda').val());
                }
                $('#cuenta-porcobrar').val(cuenta);
            })


            $('#efectivo').change(function(){
                if($(this).is(':checked')){
                    $('#monto-efectivo').removeAttr('readonly');
                }else{
                    $('#monto-efectivo').attr('readonly',true);
                }
            })


            $('#transferencia').change(function(){
                if($(this).is(':checked')){
                    $('#monto-transferencia').removeAttr('readonly');
                }else{
                    $('#monto-transferencia').attr('readonly',true);
                }
            })

            $("#monto-efectivo").on({
              "change": function(event) {
                $(event.target).select();
              },
              "keyup": function(event) {
                $(event.target).val(function(index, value) {
                  return value.replace(/\D/g, "")
                    // .replace(/([0-9])([0-9]{2})$/, '$1.$2') //Agrega decimal 
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
                });
              }
            });

            $("#moto-transferecia").on({
              "change": function(event) {
                $(event.target).select();
              },
              "keyup": function(event) {
                $(event.target).val(function(index, value) {
                  return value.replace(/\D/g, "")
                    // .replace(/([0-9])([0-9]{2})$/, '$1.$2') //Agrega decimal 
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
                });
              }
            });
    })(jQuery);
</script>