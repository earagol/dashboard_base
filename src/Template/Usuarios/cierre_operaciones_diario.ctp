 <div class="col-lg-12 ">
    <div class="card">
        <div class="card-header">
            <strong>Cierre de Operaciones (<?php echo date('d-m-Y'); ?>)</strong>
            <div class="pull-right">
                <?php echo $this->Html->link(__('Agregar',['class'=>'btn btn-default']), ['action' => 'addCierre']) ?></li>
            </div>
        </div>
        <div class="card-body">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th >#</th>
                        <th >Vendedor</th>
                        <th >Administrador</th>
                        <th >Fecha</th>
                        <th >Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cierres as $cierre): ?>
                        <tr>
                            <td><?php echo $this->Number->format($cierre->id) ?></td>
                            <td><?php echo h($cierre->vendedor->full_name) ?></td>
                            <td><?php echo h($cierre->admin->full_name) ?></td>
                            <td><?php echo $cierre->fecha; ?></td>
                            <td class="text-center">
                                <?php echo $this->Form->postLink(__('<i class="fa fa-trash-o"></i>'), ['controller' => 'usuarios','action' => 'deleteCierre', $cierre->id], ['title'=>'Eliminar','escape' => false,'confirm' => __('Realmente deseas eliminar el registro {0}?', $cierre->id)]) ?>
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


