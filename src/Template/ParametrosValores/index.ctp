<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Parametros Diarios</strong>
            <?php echo $this->Form->create() ?>
            <!-- <div class="pull-right"> -->
                <div class="form-group">
                    <!-- <label for="company" class=" form-control-label">Buscar</label> -->
                    <div class="input-group">
                        <?php echo $this->Form->control('fecha',[
                                        'value'=>'',
                                        'type'=> 'text',
                                        'class'=>'form-control',
                                        'placeholder'=>'Fecha venta',
                                        'label'=>false,
                                        'data-toggle'=>'datetimepicker', 
                                        'data-target'=>'#fecha',
                                    ]);  ?>
                      <span class="input-group-btn">
                        <?php echo $this->Form->button('Buscar',['class'=>'btn btn-primary','id' => 'plus']) ?>
                      </span>
                    </div>
                </div>
            <!-- </div> -->
            <?php echo $this->Form->end() ?>

            <div class="pull-right">
                <?php echo $this->Html->link(__('Agregar',['class'=>'btn btn-default']), ['action' => 'add']) ?>
            </div>
        </div>

        <div class="table-responsive">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th >Tipo Parametro</th>
                            <th >Fecha</th>
                            <th >Observación</th>
                            <th >Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($parametrosValores as $parametrosValore): ?>
                            <tr>
                                <td><?= $this->Number->format($parametrosValore->id) ?></td>
                                <td><?= h($parametrosValore->parametros_tipo->nombre) ?></td>
                                <td><?= $parametrosValore->fecha->format('Y-m-d'); ?></td>
                                <td><?= $parametrosValore->observacion; ?></td>
                                <td class="text-center">
                                    <?php if(is_null($parametrosValore->cierre_id)): ?>
                                        <?php echo $this->Html->link(__('<i class="fa fa-eye"></i>'), ['action' => 'view', $parametrosValore->id],['title'=>'Editar','escape' => false]) ?>
                                        <?php echo $this->Form->postLink(__('<i class="fa fa-trash-o"></i>'), ['action' => 'delete', $parametrosValore->id], ['title'=>'Eliminar','escape' => false,'confirm' => __('Realmente deseas eliminar el registro {0}?', $parametrosValore->parametros_tipo->nombre)]) ?>
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

<script type="text/javascript">
    var url1 = '<?php echo $url; ?>';
    var csrfToken = <?php echo json_encode($this->request->getParam('_csrfToken')) ?>;

    (function( $ ) {
        $('#fecha').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    })(jQuery);
</script>