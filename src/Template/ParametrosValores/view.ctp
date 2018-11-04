<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Parametros Diarios</strong>
            <div class="pull-right">
                <?php echo $this->Html->link(__('Volver',['class'=>'btn btn-default']), ['action' => 'index']) ?>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th >#</th>
                        <th >Tipo Parametro</th>
                        <th >Producto</th>
                        <th >Monto/Cantidad</th>
                        <th >Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($parametrosValores as $parametrosValore): 
                            $padre = $parametrosValore->padre_id;
                            $nombre = $parametrosValore->parametros_tipo->nombre;
                        ?>
                        <tr>
                            <td><?= $this->Number->format($parametrosValore->id) ?></td>
                            <td><?= h($parametrosValore->parametros_tipo->nombre) ?></td>
                            <td><?= h($parametrosValore->producto->nombre) ?></td>
                            <td><?= h($parametrosValore->monto_o_cantidad) ?></td>
                            <td><?= $parametrosValore->created->format('Y-m-d H:i:s'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="form-group">
                <?php echo $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $padre], ['class'=>'btn btn-primary','title'=>'Eliminar','escape' => false,'confirm' => __('Realmente deseas eliminar el registro {0}?', $nombre)]) ?>
            </div>

        </div>

        

    </div>
</div>