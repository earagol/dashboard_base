<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Regiones</strong>
            <div class="pull-right">
                <?php echo $this->Html->link(__('Agregar',['class'=>'btn btn-default']), ['action' => 'add']) ?>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th >Nombre</th>
                            <th >Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($regiones as $regione): ?>
                            <tr>
                                <td><?php echo $this->Number->format($regione->id) ?></td>
                                <td><?php echo h($regione->nombre) ?></td>
                                <td class="text-center">
                                    <?php echo $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'edit', $regione->id],['title'=>'Editar','escape' => false]) ?>
                                    <?php echo $this->Form->postLink(__('<i class="fa fa-trash-o"></i>'), ['action' => 'delete', $regione->id], ['title'=>'Eliminar','escape' => false,'confirm' => __('Realmente deseas eliminar el registro {0}?', $regione->nombre)]) ?>
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