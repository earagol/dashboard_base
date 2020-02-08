<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Clientes</strong>
            <?php echo $this->Form->create() ?>
            <!-- <div class="pull-right"> -->
                <div class="form-group">
                    <!-- <label for="company" class=" form-control-label">Buscar</label> -->
                    <div class="input-group">
                      <?php echo $this->Form->control('tipo',[
                                        'class'=>'form-control',
                                        'placeholder'=>'Buscar...',
                                        'options'=>['nombres' => 'Nombre','rut' => 'Rut','direccion' => 'Dirección'],
                                        'value' => 'direccion',
                                        'label'=>false]); ?>
                      
                      <?php echo $this->Form->control('buscar',[
                                        'class'=>'form-control',
                                        'placeholder'=>'Buscar...',
                                        'value'=>$this->request->query('buscar'),
                                        'label'=>false]); ?>
                      <span class="input-group-btn">
                        <?php echo $this->Form->button('Buscar',['class'=>'btn btn-primary','id' => 'plus']) ?>
                      </span>
                    </div>
                </div>
            <!-- </div> -->
            <?php echo $this->Form->end() ?>
            <div class="pull-right">
                <?php echo $this->Html->link(__('Agregar',['class'=>'btn btn-default']), ['action' => 'add']) ?></li>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"><?php echo $this->Paginator->sort('id','Id <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                            <th scope="col"><?php echo $this->Paginator->sort('clasificacion_id','Clasificación <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                            <th scope="col"><?php echo $this->Paginator->sort('tipo','Tipo <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                            <th scope="col"><?php echo $this->Paginator->sort('Nombres','Razon social o Nombres <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                            <th scope="col"><?php echo $this->Paginator->sort('rut','Rut <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                            <th scope="col"><?php echo $this->Paginator->sort('ruta_id','Ruta <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                            <th scope="col"><?php echo $this->Paginator->sort('full_address','Dirección <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                            <th >Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $cliente): 
                            $tipo = $cliente->tipo == 1?'Empresa':'Persona';
                            ?>
                            <tr>
                                <td><?php echo $cliente->id ?></td>
                                <td><?php echo isset($cliente->clasificacione->nombre) ? h($cliente->clasificacione->nombre) : ''; ?></td>
                                <td><?php echo h($tipo) ?></td>
                                <td><?php echo h($cliente->nombres) ?></td>
                                <td><?php echo $cliente->has('rut') ? $cliente->rut : '' ?></td>
                                <td><?php echo $cliente->has('ruta') ? $cliente->ruta->nombre : '' ?></td>
                                <td><?php echo $cliente->full_address; ?></td>
                                <td class="text-center">
                                    <?php echo $this->Html->link(__('<i class="fa fa-money"></i>'), ['action' => 'precios', $cliente->id],['title'=>'Relacionar precios','escape' => false]) ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <?php echo $this->Html->link(__('<i class="fa fa-arrow-right"></i>'), ['controller'=>'Ventas','action' => 'add', $cliente->id],['title'=>'Realizar Venta','escape' => false]) ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <?php echo $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'edit', $cliente->id],['title'=>'Editar','escape' => false]) ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <?php echo $this->Form->postLink(__('<i class="fa fa-trash-o"></i>'), ['action' => 'delete', $cliente->id], ['title'=>'Eliminar','escape' => false,'confirm' => __('Realmente deseas eliminar el registro {0}?', $cliente->nombres.' '.$cliente->apellidos)]) ?>
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

