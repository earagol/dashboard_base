<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ruta $ruta
 */
?>
<?php echo $this->Form->create($parametrosTipo) ?>
 <div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Editar Tipo Parametro</strong>
            <div class="pull-right">
                <?php echo $this->Html->link(__('Volver',['class'=>'btn btn-default']), ['action' => 'index']) ?></li>
            </div>
        </div>
        <div class="card-body card-block">
            <div class="form-group">
                <label for="company" class=" form-control-label">Usuario</label>
                <?php echo $this->Form->control('tipo',['options'=>[1=>'Diario',2=>'Gastos'],'class'=>'form-control','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Nombre</label>
                <?php echo $this->Form->control('nombre',['class'=>'form-control','placeholder'=>'Nombre','label'=>false]); ?>
            </div>

            <div class="form-group">
                <?php echo $this->Form->button(__('Guardar',['class'=>'btn btn-primary'])) ?>
            </div>

        </div>
    </div>
</div>

<?= $this->Form->end() ?>