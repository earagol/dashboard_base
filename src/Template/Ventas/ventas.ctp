<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Ventas</strong>
            <?php echo $this->Form->create() ?>
            <!-- <div class="pull-right"> -->
                <div class="form-group">
                    <!-- <label for="company" class=" form-control-label">Buscar</label> -->
                    <div class="input-group">
                      <?php echo $this->Form->control('buscar',[
                                        'class'=>'form-control',
                                        'placeholder'=>'Buscar...',
                                        'value'=>$this->request->query('buscar'),
                                        'label'=>false]); ?>
                      <span class="input-group-btn">
                        <?php echo $this->Form->button('Buscar',['class'=>'btn btn-primary','id' => 'plus']) ?>
                      </span>
                    </div>
                </div>
            <!-- </div> -->
            <?php echo $this->Form->end() ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"><?php echo $this->Paginator->sort('id','Id <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                            <th scope="col"><?php echo $this->Paginator->sort('Vendedor','Vendedor <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                            <th scope="col"><?php echo $this->Paginator->sort('Cliente','Cliente <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                            <th scope="col"><?php echo $this->Paginator->sort('Monto Total','Monto Total <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                            <th scope="col"><?php echo $this->Paginator->sort('CXC','CXC <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                            <th scope="col"><?php echo $this->Paginator->sort('Monto Cartera','Monto Cartera <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                            <th >Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ventas as $venta): ?>
                            <tr>
                                <td><?php echo $this->Number->format($venta->id) ?></td>
                                <td><?php echo h($venta->Usuarios['nombres'].' '.$venta->Usuario['apellidos']) ?></td>
                                <td><?php echo h($venta->Clientes['nombres']) ?></td>
                                <td><?php echo $this->Number->format($venta->monto_total) ?></td>
                                <td><?php echo $this->Number->format($venta->cuenta_porcobrar) ?></td>
                                <td><?php echo $this->Number->format($venta->monto_cartera) ?></td>
                                <td class="text-center">
                                    <?php if($currentUser['role'] == 'admin') : ?>
                                        <button data-id="<?php echo $venta->id; ?>" type="button" class="btn btn-danger cancelar" title="Anular"><i class="fa fa-ban"></i></button>
                                        <?php //echo $this->Form->postLink(__('<i class="fa fa-trash-o"></i>'), ['action' => 'delete', $venta->id], ['title'=>'Eliminar','escape' => false,'confirm' => __('Realmente deseas anular la venta {0}? Esta acción no se puede reversar.', $venta->id)]) ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="paginator">
            <?php echo $this->element('pagination'); ?> 
        </div>

    </div>
</div>


<div class="modal" id="anularVenta">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Anular Venta</h4>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <?php echo $this->Form->create('anular',['action'=>'delete']) ?>

                <?php echo $this->Form->control('venta_id', ['type'=>'hidden','value' => '','label'=>false]); ?>

                <div class="form-group">
                    <label for="company" class=" form-control-label">Observación</label>
                    <?php echo $this->Form->control('observacion_anulacion', ['type'=>'textarea','class'=>'form-control','value' => '','label'=>false]); ?>
                </div>

                <div class="form-group">
                    <?php echo $this->Form->button('Anular',['type'=>'button','class'=>'btn btn-primary','id' => 'save']) ?>
                </div>

            <?= $this->Form->end() ?>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
    var url1 = '<?php echo $url; ?>';
    var csrfToken = <?php echo json_encode($this->request->getParam('_csrfToken')) ?>;


    (function( $ ) {

            $('.cancelar').on("click", function() {

                $('#anularVenta').modal('show');

                var id = $(this).data('id');

                $('#venta-id').val(id);
                $('#observacion-anulacion').val('');

            });


            $('#save').on("click", function() {

                if($('#observacion-anulacion').val() == ''){
                    alert('Ingrese una observación');
                    return;
                }


                var conf = confirm('Realmente deseas anular la venta? esta operación no se puede reversar.' );
                if(!conf){
                    return;
                }
                $('form').submit();
                return;


                // $.ajax({
                //     url:url1+'ventas/detalles',
                //     dataType: 'html',
                //     type: 'POST',
                //     headers: {
                //         'X-CSRF-Token': csrfToken
                //     },
                //     data:{
                //         tipo: 2,
                //         index: id
                //     },
                //     success: function(response){
                //         $('#grilla').html(response);
                //     }
                // });


            });

            
    })(jQuery);
</script>
