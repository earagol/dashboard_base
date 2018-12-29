<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ruta $ruta
 */
?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Productos</strong>
            <div class="pull-right">
                <?php echo $this->Html->link(__('Agregar',['class'=>'btn btn-default']), ['action' => 'add']) ?>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><?php echo $this->Paginator->sort('id','Id <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                            <th><?php echo $this->Paginator->sort('categoria_id','Categoria <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                            <th><?php echo $this->Paginator->sort('nombre','Nombre <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                            <th >Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $producto): ?>
                            <tr>
                                <td><?php echo $this->Number->format($producto->id) ?></td>
                                <td><?php echo h($producto->categoria->nombre) ?></td>
                                <td><?php echo h($producto->nombre) ?></td>
                                <td class="text-center">
                                    <?php echo $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'edit', $producto->id],['title'=>'Editar','escape' => false]) ?>
                                    <?php echo $this->Form->postLink(__('<i class="fa fa-trash-o"></i>'), ['action' => 'delete', $producto->id], ['title'=>'Eliminar','escape' => false,'confirm' => __('Realmente deseas eliminar el registro {0}?', $producto->nombre)]) ?>
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