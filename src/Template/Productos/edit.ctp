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
                <div class="input-group">
                  <?php echo $this->Form->control('precio',['class'=>'form-control','placeholder'=>'Precio...','label'=>false]); ?>
                  <span class="input-group-btn">
                    <?php echo $this->Form->button('+',['type'=>'submit','name'=>'plus','class'=>'btn btn-primary','id' => 'plus']) ?>
                  </span>
                </div>
            </div>

            <div id="grilla">

                 <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if($producto->productos_precios): ?>
                            <?php foreach ($producto->productos_precios as $precio): ?>
                                <tr>
                                    <td><?php echo $this->Number->format($precio->id) ?></td>
                                    <td><?php echo number_format($precio->precio, 0, ",", ".");  ?> $</td>

                                    <td class="text-center">
                                        <?php echo $this->Form->postLink(__('<i class="fa fa-trash-o"></i>'), ['action' => 'deletePrecio', $precio->id], ['title'=>'Eliminar','escape' => false,'confirm' => __('Realmente deseas eliminar el precio # {0}?', $precio->id)]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>

                
            </div>

            <div class="form-group">
                <?php echo $this->Form->button(__('Guardar',['class'=>'btn btn-primary'])) ?>
            </div>

        </div>
    </div>
</div>

<?php echo $this->Form->end() ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript">
    var url = '<?php echo $url; ?>';
    var arreglo = new Array();
    var arreglo2 = new Array();

    function eliminar(elemento,indice){
        arreglo.splice(indice);
        $('#arreglo').val(arreglo)

        $('#row_'+indice).remove();
    }

    (function( $ ) {

        $('#plus').click(function() {
            if($('#precio').val() == ''){
                alert('Agregue Precio');
                return;
            }
            $('#grilla').html(tabla);
        });

        $("#precio").on({
          "focus": function(event) {
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


