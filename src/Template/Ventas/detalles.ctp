<table class="table table-striped">
    <thead>
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
            $('#producto-id').val('');
            $('#precio-id').val('');
            $('#cantidad').val('');
            if($('#pagar-cartera').is(':checked')){
                var cuenta = eval($('#totales').val()) + eval($('#monto-deuda').val());
                $('#cuenta-porcobrar').val(cuenta);
            }else{
                // $('#cuenta-porcobrar').val(<?php echo number_format($total, 0, ",", ".");  ?>);
                var monto = '<?php echo number_format($total, 0, ".", ",");  ?>';
                // var res = monto.replace(",", ".");
                var res = monto.replace(/,/g, '.');

                console.log(monto,monto.replace(/,/g, '.'),monto.replace(/./g, ','))
                // tt.replace(/,/g, '.')
                $('#cuenta-porcobrar').val(monto.replace(/,/g, '.'));
                // $('#cuenta-porcobrar').val($('#cuenta-porcobrar').val().replace(',','.'));
            }
            
            

            $('.eliminar').on("click", function() {

                var id = $(this).data('id');

                $.ajax({
                    url:url1+'ventas/detalles',
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


