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
        <?php 
            $total = 0;
            $i = 1;
            foreach ($detalles as $key => $detalle): 
                $total+=$detalle['total'];
            ?>
                <tr id="row_<?php echo $key; ?>">
                    <td class="text-center"><?= $this->Number->format($i) ?></td>
                    <td><?= h($detalle['producto']) ?></td>
                    <td class="text-left"><?php echo number_format($detalle['precio'], 0, ",", ".");  ?> $</td>
                    <td class="text-center"><?php echo $this->Number->format($detalle['cantidad']) ?></td>
                    <td class="text-left"><?php echo number_format($detalle['total'], 0, ",", ".");  ?> $</td>
                    <td class="text-center">
                        <button data-id="<?php echo $key; ?>" type="button" class="btn btn-danger eliminar"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
        <?php 
                $i++;
            endforeach; ?>
            <tr>
                <td colspan="4" class="text-right"><b>Total:</b></td>
                <td class="text-left"><?php echo number_format($total, 0, ",", ".");  ?> $</td>
                <td>&nbsp;</td>
            </tr>
    </tbody>
</table>

<?php echo $this->Form->control('totales', ['type'=>'hidden','value'=>$total,'label'=>false]); ?>

<script type="text/javascript">
    var url1 = '<?php echo $url; ?>';
    var csrfToken = <?php echo json_encode($this->request->getParam('_csrfToken')) ?>;

    <?php if($mensaje){ ?>
            alert('<?php echo $mensaje; ?>');
    <?php } ?>

    

    (function( $ ) {
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

            calculo();

            $('#producto-id').val('');
            $('#precio-id').val('');
            $('#cantidad').val('');

            $('.eliminar').on("click", function() {

                var id = $(this).data('id');

                $.ajax({
                    url:url1+'visitas/detalles',
                    dataType: 'html',
                    type: 'POST',
                    headers: {
                        'X-CSRF-Token': csrfToken
                    },
                    data:{
                        tipo: 2,
                        index: id
                    },
                    success: function(response){
                        $('#grilla').html(response);
                    }
                });

            });

            
    })(jQuery);
</script>


