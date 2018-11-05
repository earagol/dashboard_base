<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Usuarios</strong>
            <div class="pull-right">
                <?php echo $this->Html->link(__('Agregar',['class'=>'btn btn-default']), ['action' => 'add']) ?>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th >#</th>
                        <th >Nombres</th>
                        <th >Apellidos</th>
                        <th >Usuario</th>
                        <th >Ruta(s)</th>
                        <th >Activo</th>
                        <th >Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo $this->Number->format($usuario->id) ?></td>
                            <td><?php echo h($usuario->nombres) ?></td>
                            <td><?php echo h($usuario->apellidos) ?></td>
                            <td><?php echo h($usuario->username) ?></td>
                            <td><?php echo ($usuario->activo)?'Si':'No'; ?></td>
                            <td><?php echo ($usuario->activo)?'Si':'No'; ?></td>
                            <td class="text-center">
                                <?php echo $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'edit', $usuario->id],['title'=>'Editar','escape' => false]) ?>
                                <?php echo $this->Form->postLink(__('<i class="fa fa-trash-o"></i>'), ['action' => 'delete', $usuario->id], ['title'=>'Eliminar','escape' => false,'confirm' => __('Realmente deseas eliminar el registro {0}?', $usuario->nombres.' '.$usuario->apellidos)]) ?>
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
