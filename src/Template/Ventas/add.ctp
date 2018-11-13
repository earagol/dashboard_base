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
</style>


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

            <div class="form-group">
                <label for="company" class=" form-control-label">Credito Disponible</label>
                <?php echo $this->Form->control('credito',['readonly'=>'readonly','class'=>'form-control','value'=>number_format($cliente->credito_disponible, 0, ",", "."),'label'=>false]); ?>
            </div>

            <?php echo $this->Form->control('cuenta_porcobrar_cliente',['type'=>'hidden','class'=>'form-control','value'=>$cliente->cuenta_porcobrar,'label'=>false]); ?>

            <hr class="my-4">

            <!-- <div class="text-center col-lg-12">Productos</div> -->
            <div class = "page-header text-center col-lg-12">
               <h3>
                  Productos
               </h3>
            </div>

            <div class="row col-lg-12">
                <div class="col-lg-4 col-xs-12 col-sm-12">
                     <label for="company" class=" form-control-label">Producto</label>
                      <?php echo $this->Form->control('producto_id',['class'=>'form-control','empty'=>'--Seleccione el Producto','label'=>false]); ?>
                </div>

                <div class="col-lg-3 col-xs-12 col-sm-12">
                     <label for="company" class=" form-control-label">Precio</label>
                      <?php echo $this->Form->control('precio_id',['empty'=>'--Seleccione el Precio','class'=>'form-control','label'=>false]); ?>
                </div>

                <div class="col-lg-4 col-xs-12 col-sm-12">
                     <label for="company" class=" form-control-label">Cantidad</label>
                      <?php echo $this->Form->control('cantidad',['class'=>'form-control','label'=>false]); ?>
                </div>

                <div class="col-lg-1 col-xs-12 col-sm-12">
                    <div class="form-group">
                        <label for="company" class=" form-control-label">Acción</label><br>
                        <?php echo $this->Form->button('+',['type'=>'button','class'=>'btn btn-primary','id' => 'plus']) ?>
                    </div>
                    
                </div>
            </div>

            <hr class="my-4">

             <div class = "page-header text-center col-lg-12">
               <h3>
                  Detalle de Venta
               </h3>
            </div>
           

            <div id="grilla" style="margin-top: 5px;max-height: 300px;">

                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Precio Unitario</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Total</th>
                            <th >Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                    </tbody>
                </table>
                
            </div>


            
            <table class="table table-bordered col-lg-6 col-lg-offset-3 col-xs-12 col-sm-12">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Acciòn</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Monto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td>Total Venta:</td>
                        <td>
                            <!-- <label for="company" class=" form-control-label"><b><span id="cuentaCobrar">0</span></b></label> -->
                            <?php echo $this->Form->control('cuenta_porcobrar', ['type'=>'hidden','class'=>'form-control','value' => 0,'label'=>false,'readonly'=>'readonly']); ?>
                            <?php echo $this->Form->control('cuenta_porcobrar2', ['type'=>'text','class'=>'form-control','value' => 0,'label'=>false,'readonly'=>'readonly']); ?>
                        </td>
                    </tr>

                    <tr>
                        <td><div class="form-check"><?php echo $this->Form->control('efectivo', ['type'=>'checkbox','class'=>'form-check-input','label'=>false]); ?></div></td>
                        <td>Monto Efectivo:</td>
                        <td>
                            <?php echo $this->Form->control('monto_efectivo', ['type'=>'text','class'=>'form-control','value' => '','label'=>false,'readonly'=>'readonly']); ?>
                        </td>
                    </tr>

                    <tr>
                        <td><div class="form-check"><?php echo $this->Form->control('transferencia', ['type'=>'checkbox','class'=>'form-check-input','label'=>false]); ?></div></td>
                        <td>Monto Transferencia:</td>
                        <td>
                            <?php echo $this->Form->control('monto_transferencia', ['type'=>'text','class'=>'form-control','value' => '','label'=>false,'readonly'=>'readonly']); ?>
                        </td>
                    </tr>

                    <tr>
                        <td clospan="2"></td>
                        <td>Total:</td>
                        <td>
                            <label for="company" class=" form-control-label"><b><span id="totalAll">0</span></b></label>
                        </td>
                    </tr>

                    <tr>
                        <td clospan="2"></td>
                        <td>Cuenta por Cobrar:</td>
                        <td>
                            <label for="company" class=" form-control-label"><b><span id="resta">0</span></b></label>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4"></td>
                    </tr>

                    <?php if($carteraPendiente): ?>
                        <tr>
                            <td><div class="form-check"><?php echo $this->Form->control('pagar_cartera', ['type'=>'checkbox','class'=>'form-check-input','label'=>false,'checked'=>false]); ?></div></td>
                            <td>Cancela Cartera?</td>
                            <td><?php echo $this->Form->control('monto_deuda', ['class'=>'form-control','value' => number_format($carteraPendiente, 0, ",", "."),'label'=>false,'readonly'=>'readonly']); ?></td>

                        </tr>

                    <?php else: ?>
                         <?php echo $this->Form->control('pagar_cartera', ['type'=>'hidden','class'=>'form-check-input','label'=>false,'value'=>0]); ?> 
                    <?php endif; ?>

                </tbody>
            </table>


            <?php echo $this->Form->control('monto_deuda2', ['type'=>'hidden','class'=>'form-control','value' => number_format($carteraPendiente, 0, ",", "."),'label'=>false,'style'=>'width:20%','readonly'=>'readonly']); ?>



            <div class="form-group">
                <label for="company" class=" form-control-label">Observacion</label>
                <?php echo $this->Form->control('observacion', ['type'=>'textarea','class'=>'form-control','value' => '','label'=>false]); ?>
            </div>

            <div class="form-group">
                <?php echo $this->Form->button('Guardar',['type'=>'button','class'=>'btn btn-primary','id' => 'save']) ?>
            </div>

        </div>
    </div>
</div>

<?= $this->Form->end() ?>
<?php $productos = json_encode($productos); ?>
<?php $precios = json_encode($productosPrecios); ?>



<script type="text/javascript">
    /*

    Para incorporar la cartera a las cuanta por cobrar se debe descomentar las lineas que digan descomentar

    */
    var url1 = '<?php echo $url; ?>';
    var csrfToken = <?php echo json_encode($this->request->getParam('_csrfToken')) ?>;

    var precios = '<?php echo $precios ?>';
    

    (function( $ ) {

        var jsonPrecios = $.parseJSON(precios);

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

            $('#save').click(function(e){
                e.preventDefault();
                console.log('save',eval($('#cuenta-porcobrar').val()));

                if(!$('#totales').val() && !$('#pagar-cartera').is(':checked')){
                    alert('No hay productos ingresados para la venta.');
                    return;
                }else if(!$('#totales').val() && ($('#pagar-cartera').is(':checked') && ($('#monto-deuda').val() == '' || eval($('#monto-deuda').val()) == 0))){
                    alert('El monto de pago de cartera es incorrecto');
                    return;
                }else if(eval($('#cuenta-porcobrar').val()) > 0){
                    var cuenta = $('#cuenta-porcobrar').val();
                    // cuenta = cuenta.replace('.', '');
                    var credito = $('#credito').val();
                    // credito = credito.replace('.', '');
                    console.log(credito,cuenta);
                    if(eval(cuenta) > eval(credito)){
                        alert('La cuenta por cobrar supera al credito disponible para este cliente, debes comunicarte con el administrador del sistema.');
                        return;
                    }else{
                        var conf = confirm('Existe una cuenta por cobrar, Deseas continuar la venta?' );
                        if(!conf){
                            return;
                        }
                        $('form').submit();
                        return;
                    }
                }

                var conf = confirm('¿Estas seguro de finalizar esta operación?');
                if(!conf){
                    return;
                }

                $('form').submit();
            });

            function number_format(amount, decimals) {

                amount += ''; // por si pasan un numero en vez de un string
                amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

                decimals = decimals || 0; // por si la variable no fue fue pasada

                // si no es un numero o es igual a cero retorno el mismo cero
                if (isNaN(amount) || amount === 0) 
                    return parseFloat(0).toFixed(decimals);

                // si es mayor o menor que cero retorno el valor formateado como numero
                amount = '' + amount.toFixed(decimals);

                var amount_parts = amount.split('.'),
                    regexp = /(\d+)(\d{3})/;

                while (regexp.test(amount_parts[0]))
                    amount_parts[0] = amount_parts[0].replace(regexp, '$1' + '.' + '$2');

                return amount_parts.join('.');
            }

            function limpiar(){
                $('#efectivo').prop('checked',false);
                $('#monto-efectivo').val('').attr('readonly',true);

                $('#transferencia').prop('checked',false);
                $('#monto-transferencia').val('').attr('readonly',true);
            }


            function calculo(){
                var cuenta = 0;
                var total = 0;
 
                ////////////////TOTALES GRILLA//////////////////////

                var totales = 0;
                if($('#totales').val()){
                    var totales = $('#totales').val();
                    var totales = totales.replace('.', '');
                    var cuenta = eval(cuenta)+eval(totales);
                    $('#cuenta-porcobrar2').val(number_format(cuenta,0));
                }

                

                if($('#pagar-cartera').is(':checked')){
                    if($('#monto-deuda').val() == ''){
                        $('#monto-deuda').val($('#monto-deuda2').val());
                    }else{
                        var deuda = $('#monto-deuda').val();
                        deuda = deuda.replace('.', '');
                        var deuda2 = $('#monto-deuda2').val();
                        deuda2 = deuda2.replace('.', '');
                        console.log(deuda,deuda2);
                        if(eval($('#monto-deuda').val()) <= 0){
                            $('#monto-deuda').val($('#monto-deuda2').val());
                            alert('Ingrese un monto valido');
                            return;
                        }else if(eval(deuda) > eval(deuda2)){
                            // cuenta = number_format(cuenta,0);
                            // $('#cuenta-porcobrar').val(cuenta);
                            // $('#cuentaCobrar').html(cuenta);
                            $('#monto-deuda').val(number_format(deuda2,0));
                            alert('el monto ingresado no debe ser mayor a la deuda.');
                            return;
                        }

                    }
                
                    var cuentaDeuda = $('#monto-deuda').val();
                    var cuentaDeuda = cuentaDeuda.replace('.', '');
                    // var cuenta = cuenta + eval(cuentaDeuda);//Descomentar
                    $('#monto-deuda').attr('readonly',false);
                }else{
                    $('#monto-deuda').attr('readonly',true);
                    $('#monto-deuda').val($('#monto-deuda2').val());
                }
                $('#totalAll').html(number_format(cuenta,0));
                // $('#cuenta-porcobrar2').val(cuenta);

                ////////////////EFECTIVO//////////////////////
                var cuentaAux = cuenta;
                var flag = false;

                var efectivo = 0;
                if($('#efectivo').is(':checked') && $('#monto-efectivo').val() != ''){
                    efectivo = $('#monto-efectivo').val();
                    var efectivo = efectivo.replace('.', '');
                    if(efectivo <= cuentaAux){
                        var cuentaAux = eval(cuentaAux)-eval(efectivo);
                    }else{
                        flag = 'efectivo';
                    }
                }

                ////////////////TRANSFERENCIA//////////////////////

                var transferencia = 0;
                if($('#transferencia').is(':checked') && $('#monto-transferencia').val() != ''){
                    console.log('aa');
                    transferencia = $('#monto-transferencia').val();
                    var transferencia = transferencia.replace('.', '');
                    if(transferencia <= cuentaAux){
                        console.log('cc');
                        var cuentaAux = eval(cuentaAux)-eval(transferencia);
                    }else{
                        flag = 'transferencia';
                    }
                }

                if(!flag){
                    cuenta = cuentaAux;
                }

                cuenta = number_format(cuenta,0);
                
                $('#cuenta-porcobrar').val(cuenta);
                $('#resta').html(cuenta);
                // $('#cuentaCobrar').html(cuenta);
                

                if(flag){
                    $('#monto-efectivo').val('');
                    $('#monto-transferencia').val('');
                    alert('La suma de los montos ingresados en efectivo y/o transferencia no debe ser mayor al total de la venta');
                }

            }//fin calculo

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
                // limpiar();//Descomentar
                calculo();
            });

            $("#monto-deuda").on({
              "change": function(event) {
                $(event.target).select();

                var montoDeuda2 = $('#monto-deuda').val();
                if(montoDeuda2 == ''){
                    alert('Debe ingresar el monto de la deuda a pagar');
                    $('#monto-deuda').val('');
                    calculo();
                    return;
                }
                calculo();
              },
              "keyup": function(event) {
                $(event.target).val(function(index, value) {
                  return value.replace(/\D/g, "")
                    // .replace(/([0-9])([0-9]{2})$/, '$1.$2') //Agrega decimal 
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
                });
              }
            });


            $('#efectivo').change(function(){
                if($('#efectivo').is(':checked')){
                    $('#monto-efectivo').removeAttr('readonly');
                }else{
                    $('#monto-efectivo').attr('readonly',true);
                }
                $('#monto-efectivo').val('');
                calculo();
            })


            $('#transferencia').change(function(){
                if($('#transferencia').is(':checked')){
                    $('#monto-transferencia').removeAttr('readonly');
                }else{
                    $('#monto-transferencia').attr('readonly',true);
                }
                $('#monto-transferencia').val('');
                calculo();
            })



            $("#monto-efectivo").on({
              "change": function(event) {
                $(event.target).select();

                var cuentaCobrar = $('#cuenta-porcobrar2').val();
                var efectivo = $('#monto-efectivo').val();
                if(efectivo == ''){
                     alert('Debe ingresar el monto en efectivo');
                    $('#monto-efectivo').val('');
                    calculo();
                    return;
                }
                calculo();
              },
              "keyup": function(event) {
                $(event.target).val(function(index, value) {
                  return value.replace(/\D/g, "")
                    // .replace(/([0-9])([0-9]{2})$/, '$1.$2') //Agrega decimal 
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
                });
              }
            });

            $("#monto-transferencia").on({
              "change": function(event) {
                $(event.target).select();

                var cuentaCobrar = $('#cuenta-porcobrar2').val();
                var transferencia = $('#monto-transferencia').val();
                if(transferencia == ''){
                    alert('Debe ingresar el monto de la transferencia');
                    $('#monto-transferencia').val('');
                    calculo();
                    return;
                }
                calculo();
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