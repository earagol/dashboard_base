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

            <hr class="my-4">

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
                      <?php echo $this->Form->control('cantidad',['type'=>'number','class'=>'form-control','label'=>false]); ?>
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
                        <td></td>
                        <td>Monto Efectivo/Cheque:</td>
                        <td>
                            <?php echo $this->Form->control('monto_efectivo', ['type'=>'text','class'=>'form-control','value' => 0,'label'=>false]); ?>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>Monto Transferencia:</td>
                        <td>
                            <?php echo $this->Form->control('monto_transferencia', ['type'=>'text','class'=>'form-control','value' => 0,'label'=>false]); ?>
                        </td>
                    </tr>

                    <tr>
                        <td clospan="2"></td>
                        <td>Cuenta por Cobrar:</td>
                        <td>
                            <label for="company" class=" form-control-label"><b><span id="resta">0</span></b></label>
                        </td>
                    </tr>

                </tbody>
            </table>

            <div class="form-group">
                <?php echo $this->Form->button('Guardar',['type'=>'button','class'=>'btn btn-primary','id' => 'save']) ?>
            </div>

        </div>
    </div>
</div>

<?= $this->Form->end() ?>
<?php $productos = json_encode($productos); ?>
<?php $precios = json_encode($productosPrecios); ?>

<script>
    var url1 = '<?php echo $url; ?>';
    var csrfToken = <?php echo json_encode($this->request->getParam('_csrfToken')) ?>;

    var precios = '<?php echo $precios ?>';

    (function( $ ) {

        var jsonPrecios = $.parseJSON(precios);

        $('#fecha-vencimiento').datetimepicker({
            format: 'YYYY-MM-DD'
        });

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

        $('#save').click(function(e) {
            e.preventDefault();
            var fechaTermino = "<?php echo date('Y-m-d'); ?>";

            console.log($("#fecha-vencimiento").val(),fechaTermino);

            /*else if(($("#fecha-vencimiento").val()!='' && fechaTermino!='')){
                var fechaInicio = $("#fecha-vencimiento").val().split("-");
                var fechaTermino = fechaTermino.split("-");
                console.log(fechaInicio,fechaTermino);
                var fechaInicio = new Date(parseInt(fechaInicio[0]),parseInt(fechaInicio[1]-1),parseInt(fechaInicio[2]));
                var fechaTermino = new Date(parseInt(fechaTermino[0]),parseInt(fechaTermino[1]-1),parseInt(fechaTermino[2]));
                console.log(fechaInicio,fechaTermino);
                if(fechaTermino > fechaInicio){
                    e.preventDefault();
                    alert('La fecha de vencimiento no debe ser menor a la fecha actual.');
                    return;
                } */

            if($("#usuario-id").val() == ''){
                alert('Debe seleccionar al vendedor');
                return;
            }else if($("#cliente-id").val() == ''){
                alert('Debe seleccionar al cliente');
                return;
            }else if($("#fecha-vencimiento").val() == ''){
                alert('Debe ingresar la fecha de vencimiento');
                return;
            }else{

                var cuenta = $('#cuenta-porcobrar').val();
                if($('#totales').val() && eval(cuenta) != 0){
                    alert('Este registro no puede generar cuentas por cobrar. Verifique los montos en efectivo/cheque o transferencia ingresados.');
                    return;
                }else if(!$('#totales').val()){
                    var conf = confirm('No has ingresado productos a la  visita, Deseas continuar con el registro de la visita?' );
                    if(!conf){
                        return;
                    }
                    $('form').submit();
                }
            }

            $('form').submit();

        });


        $('#saverr').click(function(e){
            e.preventDefault();
            console.log('save',eval($('#cuenta-porcobrar').val()));

            if(!$('#totales').val() && !$('#pagar-cartera').is(':checked')){
                alert('No hay productos ingresados para la venta.');
                return;
            }else if(!$('#totales').val() && ($('#pagar-cartera').is(':checked') && ($('#total-pago-deuda').val() == '' || eval($('#total-pago-deuda').val()) == 0))){
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

                $('#totalAll').html(number_format(cuenta,0));
                // $('#cuenta-porcobrar2').val(cuenta);

                ////////////////EFECTIVO//////////////////////
                var cuentaAux = cuenta;
                var flag = false;

                var efectivo = 0;
                if($('#monto-efectivo').val() != ''){
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
                if($('#monto-transferencia').val() != ''){
                    console.log('aa');
                    transferencia = $('#monto-transferencia').val();
                    var transferencia = transferencia.replace('.', '');
                    if(transferencia <= cuentaAux){
                        var cuentaAux = eval(cuentaAux)-eval(transferencia);
                    }else{
                        flag = 'transferencia';
                    }
                }

                if(!flag){
                    cuenta = cuentaAux;
                }

                $('#cuenta-porcobrar').val(cuenta);
                cuenta = number_format(cuenta,0);
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
                    url:url1+'visitas/detalles',
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


            $("#monto-efectivo").on({
              "change": function(event) {
                $(event.target).select();

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


    })(jQuery);
</script>

