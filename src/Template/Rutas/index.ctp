<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Rutas</strong>
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
                        <th >Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rutas as $ruta): ?>
                        <tr>
                            <td><?php echo $this->Number->format($ruta->id) ?></td>
                            <td><?php echo h($ruta->nombre) ?></td>
                            <td class="text-center">
                                <?php echo $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'edit', $ruta->id],['title'=>'Editar','escape' => false]) ?>
                                <?php echo $this->Form->postLink(__('<i class="fa fa-trash-o"></i>'), ['action' => 'delete', $ruta->id], ['title'=>'Eliminar','escape' => false,'confirm' => __('Realmente deseaseliminar el registro # {0}?', $ruta->nombre)]) ?>
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