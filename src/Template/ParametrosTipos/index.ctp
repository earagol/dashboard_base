<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Tipos Parametros</strong>
            <div class="pull-right">
                <?php echo $this->Html->link(__('Agregar',['class'=>'btn btn-default']), ['action' => 'add']) ?>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th >#</th>
                        <th >Tipo</th>
                        <th >Nombre</th>
                        <th >Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($parametrosTipos as $parametrosTipo): 
                            if($parametrosTipo->tipo==1){
                                $tipo = 'Diario';
                            }else if($parametrosTipo->tipo==2){
                                $tipo = 'Gastos';
                            }
                            ?>
                        <tr>
                            <td><?php echo $this->Number->format($parametrosTipo->id) ?></td>
                            <td><?php echo h($parametrosTipo->tipo) ?></td>
                            <td><?php echo h($parametrosTipo->nombre) ?></td>
                            <td class="text-center">
                                <?php if($parametrosTipo->modificable): ?>
                                    <?php echo $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'edit', $parametrosTipo->id],['title'=>'Editar','escape' => false]) ?>
                                    <?php echo $this->Form->postLink(__('<i class="fa fa-trash-o"></i>'), ['action' => 'delete', $parametrosTipo->id], ['title'=>'Eliminar','escape' => false,'confirm' => __('Realmente deseas eliminar el registro {0}?', $parametrosTipo->nombre)]) ?>
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