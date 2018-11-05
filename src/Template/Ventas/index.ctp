<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Clientes</strong>
            <?php echo $this->Form->create() ?>
            <!-- <div class="pull-right"> -->
                <div class="form-group">
                    <!-- <label for="company" class=" form-control-label">Buscar</label> -->
                    <div class="input-group">
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
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id','Id <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('clasificacion_id','Clasificación <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('tipo','Tipo <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('Nombres','Razon social o Nombres <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('ruta_id','Ruta <i class="fa fa-sort"></i>',array('escape' => false)) ?></th>
                        <th >Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): 
                        $tipo = $cliente->tipo == 1?'Empresa':'Persona';
                        ?>
                        <tr>
                            <td><?= $this->Number->format($cliente->id) ?></td>
                            <td><?= h($cliente->clasificacione->nombre) ?></td>
                            <td><?= h($tipo) ?></td>
                            <td><?= h($cliente->nombres) ?></td>
                            <td><?= $cliente->has('ruta') ? $cliente->ruta->nombre : '' ?></td>
                            <td class="text-center">
                                <?php echo $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'add', $cliente->id],['title'=>'Venta','escape' => false]) ?>
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

