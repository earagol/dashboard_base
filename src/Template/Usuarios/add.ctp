<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ruta $ruta
 */
?>
<?php echo $this->Form->create($usuario) ?>
 <div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Agregar Usuario</strong>
            <div class="pull-right">
                <?php echo $this->Html->link(__('Volver',['class'=>'btn btn-default']), ['action' => 'index']) ?></li>
            </div>
        </div>
        <div class="card-body card-block">
            <div class="form-group">
                <label for="company" class=" form-control-label">Usuario</label>
                <?php echo $this->Form->control('username',['class'=>'form-control','placeholder'=>'Nombre de usuario..','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Contraseña</label>
                <?php echo $this->Form->control('password',['class'=>'form-control','placeholder'=>'Contraseña','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Repetir Contraseña</label>
                <?php echo $this->Form->control('password2',['class'=>'form-control','placeholder'=>'Repetir Contraseña','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Nombres</label>
                <?php echo $this->Form->control('nombres',['class'=>'form-control','placeholder'=>'Nombres','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Apellidos</label>
                <?php echo $this->Form->control('apellidos',['class'=>'form-control','placeholder'=>'Apellidos','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Email</label>
                <?php echo $this->Form->control('email',['class'=>'form-control','placeholder'=>'Email','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Tipo usuario</label>
                <?php echo $this->Form->control('role',['type'=>'select','options'=>['admin'=>'Administrador','usuario'=>'Vendedor'],'empty'=>'--Seleccione--','class'=>'form-control','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Asignar ruta(s)</label>
                <?php echo $this->Form->control('ruta_id',['class'=>'form-control','multiple'=>'multiple','label'=>false]); ?>
            </div>

            <div class="form-group">
                <?php echo $this->Form->button(__('Guardar',['class'=>'btn btn-primary'])) ?>
            </div>

        </div>
    </div>
</div>

<?= $this->Form->end() ?>
