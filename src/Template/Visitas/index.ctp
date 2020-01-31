<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Visitas</strong>
            <?php echo $this->Form->create() ?>
            <!-- <div class="pull-right"> -->
                <div class="form-group">
                    <!-- <label for="company" class=" form-control-label">Buscar</label> -->
                    <div class="input-group">
                      <?php echo $this->Form->control('tipo',[
                                        'class'=>'form-control',
                                        'placeholder'=>'Buscar...',
                                        'options'=>['nombres' => 'Nombre','rut' => 'Rut','calle' => 'Calle'],
                                        'selected'=>$this->request->query('tipo'),
                                        'label'=>false
                                    ]); ?>

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
            <div class="pull-right">
                <?php echo $this->Html->link(__('Agregar',['class'=>'btn btn-default']), ['action' => 'add']) ?></li>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"><?= $this->Paginator->sort('id','Id <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                            <th scope="col"><?= $this->Paginator->sort('usuario_id','Vendedor <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Clientes.nombres','Cliente <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                            <th scope="col"><?= $this->Paginator->sort('fecha_vencimiento','Fecha Vencimiento <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                            <th scope="col"><?= $this->Paginator->sort('status','Status <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                            <th scope="col"><?php echo $this->Paginator->sort('full_address','Dirección <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                            <th >Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($visitas as $visita): 
                            // pr($visita);
                            // exit;
                            if($visita->status == 'P'){
                                $status = 'Pendiente';
                            }else if($visita->status == 'V'){
                                $status = 'Vencida';
                            }else if($visita->status == 'R'){
                                $status = 'Realizada';
                            }
                        ?>
                            <tr>
                                <td><?= $this->Number->format($visita->id) ?></td>
                                <td><?= h($visita->_matchingData['Usuarios']->full_name) ?></td>
                                <td><?= h($visita->_matchingData['Clientes']->nombres) ?></td>
                                <td><?= h($visita->fecha_vencimiento->format('Y-m-d')) ?></td>
                                <td><?= h($status) ?></td>
                                <td><?php echo $visita->_matchingData['Clientes']->full_address; ?></td>
                                <td class="text-center">
                                    <?php if($currentUser['role'] === 'admin'): ?>
                                        <?php echo $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'edit', $visita->id],['title'=>'Editar','escape' => false]) ?>
                                        <?php echo $this->Form->postLink(__('<i class="fa fa-trash-o"></i>'), ['action' => 'delete', $visita->id], ['title'=>'Eliminar','escape' => false,'confirm' => __('Realmente deseas eliminar el registro # {0}?', $visita->id)]) ?>
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