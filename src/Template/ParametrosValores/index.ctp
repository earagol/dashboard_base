<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Parametros Diarios (<?php echo $fecha; ?>)</strong>
            <div class="pull-right">
                <?php echo $this->Html->link(__('Agregar',['class'=>'btn btn-default']), ['action' => 'add']) ?>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th >#</th>
                        <th >Tipo Parametro</th>
                        <th >Fecha</th>
                        <th >Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($parametrosValores as $parametrosValore): ?>
                        <tr>
                            <td><?= $this->Number->format($parametrosValore->id) ?></td>
                            <td><?= h($parametrosValore->parametros_tipo->nombre) ?></td>
                            <td><?= $parametrosValore->created->format('Y-m-d H:i:s'); ?></td>
                            <td class="text-center">
                                <?php echo $this->Html->link(__('<i class="fa fa-eye"></i>'), ['action' => 'view', $parametrosValore->id],['title'=>'Editar','escape' => false]) ?>
                                <?php echo $this->Form->postLink(__('<i class="fa fa-trash-o"></i>'), ['action' => 'delete', $parametrosValore->id], ['title'=>'Eliminar','escape' => false,'confirm' => __('Realmente deseas eliminar el registro {0}?', $parametrosValore->parametros_tipo->nombre)]) ?>
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