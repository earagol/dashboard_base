<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Comunas</strong>
            <div class="pull-right">
                <?php echo $this->Html->link(__('Agregar',['class'=>'btn btn-default']), ['action' => 'add']) ?>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th >#</th>
                        <th >Región</th>
                        <th >Nombre Comuna</th>
                        <th >Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comunas as $comuna): ?>
                        <tr>
                            <td><?php echo $this->Number->format($comuna->id) ?></td>
                            <td><?php echo h($comuna->regione->nombre) ?></td>
                            <td><?php echo h($comuna->nombre) ?></td>
                            <td class="text-center">
                                <?php echo $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'edit', $comuna->id],['title'=>'Editar','escape' => false]) ?>
                                <?php echo $this->Form->postLink(__('<i class="fa fa-trash-o"></i>'), ['action' => 'delete', $comuna->id], ['title'=>'Eliminar','escape' => false,'confirm' => __('Realmente deseas eliminar el registro {0}?', $comuna->nombre)]) ?>
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