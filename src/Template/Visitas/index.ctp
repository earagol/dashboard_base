<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Visitas</strong>
            <div class="pull-right">
                <?php echo $this->Html->link(__('Agregar',['class'=>'btn btn-default']), ['action' => 'add']) ?></li>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>


                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id','Id <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('usuario_id','Vendedor <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('Clientes.nombres','Cliente <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('fecha_vencimiento','Fecha Vencimiento <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('status','Status <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                        <th >Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($visitas as $visita): ?>
                        <tr>
                            <td><?= $this->Number->format($visita->id) ?></td>
                            <td><?= h($visita->usuario->full_name) ?></td>
                            <td><?= h($visita->cliente->nombres) ?></td>
                            <td><?= h($visita->fecha_vencimiento->format('Y-m-d')) ?></td>
                            <td><?= h($visita->status) ?></td>
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

        <div class="paginator">
            <?php echo $this->element('pagination'); ?> 
        </div>

    </div>
</div>