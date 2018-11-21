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
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col"><?php echo $this->Paginator->sort('id','Id <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                        <th scope="col"><?php echo $this->Paginator->sort('Vendedor','Vendedor <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                        <th scope="col"><?php echo $this->Paginator->sort('Cliente','Cliente <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                        <th scope="col"><?php echo $this->Paginator->sort('Monto Total','Monto Total <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
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
                            <td class="text-center">
                                <?php echo $this->Form->postLink(__('<i class="fa fa-trash-o"></i>'), ['action' => 'delete', $venta->id], ['title'=>'Eliminar','escape' => false,'confirm' => __('Realmente deseas anular la venta {0}? Esta acción no se puede reversar.', $venta->id)]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="paginator">
            <?php echo $this->element('pagination'); ?> 
        </div>

    </div>
</div>

