<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ruta $ruta
 */
?>
<?php echo $this->Form->create($producto) ?>
 <div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Agregar Producto</strong>
            <div class="pull-right">
                <?php echo $this->Html->link(__('Volver',['class'=>'btn btn-default']), ['action' => 'index']) ?></li>
            </div>
        </div>
        <div class="card-body card-block">
            <div class="form-group">
                <label for="company" class=" form-control-label">Categoria</label>
                <?php echo $this->Form->control('categoria_id',['class'=>'form-control','empty'=>'--Seleccione categoria--','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Nombre</label>
                <?php echo $this->Form->control('nombre',['class'=>'form-control','placeholder'=>'Nombre','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Descripción</label>
                <?php echo $this->Form->control('descripcion',['class'=>'form-control','placeholder'=>'Descripción...','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Precio</label>
                <div class="col col-md-3">
                    <?php echo $this->Form->control('precio',['class'=>'form-control','placeholder'=>'Precio...','label'=>false]); ?>
                    <?php echo $this->Form->control('arreglo',['id'=>'arreglo','type'=>'hidden','value'=>'','class'=>'form-control','placeholder'=>'Precio...','label'=>false]); ?>
                </div>
                <div class="col col-md-1">
                     <?php echo $this->Form->button('+',['type'=>'button','class'=>'btn btn-primary','id' => 'plus']) ?>
                </div>
            </div>

            <div id="grilla">
                
            </div>

            <div class="form-group">
                <?php echo $this->Form->button(__('Guardar',['class'=>'btn btn-primary'])) ?>
            </div>

        </div>
    </div>
</div>

<?= $this->Form->end() ?>

<script>
    var url = '<?php echo $url; ?>';
    var arreglo = new Array();
    var arreglo2 = new Array();
    (function( $ ) {
        $(document).ready(function() {

             $('#plus').click(function() {
                if($('#precio').val() == ''){
                    alert('Agregue Precio');
                    return;
                }

                // arreglo = $('#arreglo').val();
                // arreglo2 = new Array();


                arreglo.push($('#precio').val());

                arreglo3 = arreglo2.concat(arreglo);

                $('#arreglo').val(arreglo3)
                $('#precio').val('');

                var tabla = '<table class="table table-striped">'+
                                '<thead>'+
                                    '<tr>'+
                                        '<th scope="col">Precio</th>'+
                                        '<th scope="col">Acción</th>'+
                                    '</tr>'+
                                '</thead>'+
                                '<tbody>';
                console.log(arreglo3);

                arreglo3.forEach( function(valor, indice, array) {
                    tabla=tabla+
                        '<tr data-id="'+indice+'">'+
                            '<th scope="col">'+valor+'</th>'+
                            '<th scope="col">Acción</th>'+
                        '</tr>';
                        // console.log("En el índice " + indice + " hay este valor: " + valor);
                });

                 tabla=tabla+'</tbody>'+
                            '</table>';

                $('#grilla').html(tabla);

                // $.ajax({
                // url : url+"productos/addPrecio",
                // dataType : 'json',
                // type : 'post',
                // data : {
                //     precio : $('#precio').val(),
                // },
                // success : function (res) {
                //   console.log(res);
                //   $('#grilla').html(res);
                // },
                // error : function() {
                //     alert(No hubo respuesta);
                //     // bootbox.alert({message: 'No hubo respuesta',className: 'bb-alternate-modal'});
                // }
            });

        });
    })(jQuery);
</script>
