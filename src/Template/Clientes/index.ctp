<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Clientes</strong>
            <div class="pull-right">
                <?php echo $this->Html->link(__('Agregar',['class'=>'btn btn-default']), ['action' => 'add']) ?></li>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id','Id <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('clasificacion_id','Clasificación <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('tipo','Tipo <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('Nombres','Razon social o Nombres <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('ruta_id','Ruta <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                        <th >Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): 
                        $tipo = $cliente->tipo == 1?'Empresa':'Persona';
                        ?>
                        <tr>
                            <td><?= $this->Number->format($cliente->id) ?></td>
                            <td><?= $this->Number->format($cliente->clasificacion_id) ?></td>
                            <td><?= h($tipo) ?></td>
                            <td><?= h($cliente->nombres) ?></td>
                            <td><?= $cliente->has('ruta') ? $cliente->ruta->nombre : '' ?></td>
                            <td class="text-center">
                                <?php echo $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'edit', $cliente->id],['title'=>'Editar','escape' => false]) ?>
                                <?php echo $this->Form->postLink(__('<i class="fa fa-trash-o"></i>'), ['action' => 'delete', $cliente->id], ['title'=>'Eliminar','escape' => false,'confirm' => __('Realmente deseas eliminar el registro {0}?', $cliente->nombres.' '.$cliente->apellidos)]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="paginator">
            <ul class="pagination">
                <?php echo $this->Paginator->first('<< ' . __('first')) ?>
                <?php echo $this->Paginator->prev('< ' . __('previous')) ?>
                <?php echo $this->Paginator->numbers() ?>
                <?php echo $this->Paginator->next(__('next') . ' >') ?>
                <?php echo $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?php echo $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>

    </div>
</div>

