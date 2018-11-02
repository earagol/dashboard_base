<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Clasificacion de Clientes</strong>
            <div class="pull-right">
                <?php echo $this->Html->link(__('Agregar',['class'=>'btn btn-default']), ['action' => 'add']) ?></li>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th >#</th>
                        <th >Nombre</th>
                        <th >Descuento</th>
                        <th >Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clasificaciones as $clasificacione): ?>
                        <tr>
                            <td><?= $this->Number->format($clasificacione->id) ?></td>
                            <td><?= h($clasificacione->nombre) ?></td>
                            <td><?= $this->Number->format($clasificacione->descuento) ?></td>
                            <td class="text-center">
                                <?php echo $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'edit', $clasificacione->id],['title'=>'Editar','escape' => false]) ?>
                                <?php echo $this->Form->postLink(__('<i class="fa fa-trash-o"></i>'), ['action' => 'delete', $clasificacione->id], ['title'=>'Eliminar','escape' => false,'confirm' => __('Realmente deseas eliminar el registro {0}?', $clasificacione->nombre)]) ?>
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