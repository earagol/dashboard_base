<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ruta $ruta
 */
?>
<?php echo $this->Form->create($producto) ?>
 <div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Agregar Producto</strong>
            <div class="pull-right">
                <?php echo $this->Html->link(__('Volver',['class'=>'btn btn-default']), ['action' => 'index']) ?></li>
            </div>
        </div>
        <div class="card-body card-block">
            <div class="form-group">
                <label for="company" class=" form-control-label">Categoria</label>
                <?php echo $this->Form->control('categoria_id',['class'=>'form-control','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Nombre</label>
                <?php echo $this->Form->control('nombre',['class'=>'form-control','placeholder'=>'Nombre','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Descripción</label>
                <?php echo $this->Form->control('descripcion',['class'=>'form-control','placeholder'=>'Descripción...','label'=>false]); ?>
            </div>

            <div class="form-group">
                <?php echo $this->Form->button(__('Guardar',['class'=>'btn btn-primary'])) ?>
            </div>

        </div>
    </div>
</div>

<?= $this->Form->end() ?>
