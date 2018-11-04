<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ruta $ruta
 */
?>
<?php echo $this->Form->create($cliente) ?>
 <div class="col-lg-12 ">
    <div class="card">
        <div class="card-header">
            <strong>Editar Cliente</strong>
            <div class="pull-right">
                <?php echo $this->Html->link(__('Volver',['class'=>'btn btn-default']), ['action' => 'index']) ?></li>
            </div>
        </div>
        <div class="card-body card-block">
            <div class="form-group">
                <label for="company" class=" form-control-label">Asignar a ruta</label>
                <?php echo $this->Form->control('ruta_id',[['options' => $rutas],'class'=>'form-control','empty'=>'--Seleccione--','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Clasificación</label>
                <?php echo $this->Form->control('clasificacion_id',['class'=>'form-control','empty'=>'--Seleccione--','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Tipo Cliente</label>
                <?php echo $this->Form->control('tipo',['type'=>'select','options'=>[1=>'Empresa',2=>'Persona'],'empty'=>'--Seleccione--','class'=>'form-control','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Nombres</label>
                <?php echo $this->Form->control('nombres',['class'=>'form-control','placeholder'=>'Nombres','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Rut</label>
                <?php echo $this->Form->control('rut',['class'=>'form-control','placeholder'=>'Nombres','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Email</label>
                <?php echo $this->Form->control('email',['class'=>'form-control','placeholder'=>'Email','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Sexo</label>
                <?php echo $this->Form->control('sexo',['type'=>'select','options'=>['N'=>'--Seleccione--','M'=>'Masculino','F'=>'Femenino','O'=>'Otro'],'default'=>'N','class'=>'form-control','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Telefono 1</label>
                <?php echo $this->Form->control('telefono1',['class'=>'form-control','placeholder'=>'Telefono 1..','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Telefono 1</label>
                <?php echo $this->Form->control('telefono2',['class'=>'form-control','placeholder'=>'Telefono 2...','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Observación</label>
                <?php echo $this->Form->control('observacion',['class'=>'form-control','placeholder'=>'Observación','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Región</label>
                <?php echo $this->Form->control('region_id',['class'=>'form-control','empty'=>'--Seleccione la región--','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Comuna</label>
                <?php echo $this->Form->control('comuna_id',['class'=>'form-control','empty'=>'--Seleccione la comuna--','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Calle/Avenida</label>
                <?php echo $this->Form->control('calle',['class'=>'form-control','placeholder'=>'Calle/Avenida..','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Número</label>
                <?php echo $this->Form->control('numero_calle',['class'=>'form-control','placeholder'=>'Número','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Número casa/dept/oficina</label>
                <?php echo $this->Form->control('dept_casa_oficina_numero',['class'=>'form-control','placeholder'=>'Número casa/dept/oficina ...','label'=>false]); ?>
            </div>

            
            <?php if($currentUser['role'] == 'admin') : ?>
                 <div class="form-group">
                    <label for="company" class=" form-control-label">Credito disponible</label>
                    <?php echo $this->Form->control('credito_disponible',['class'=>'form-control','placeholder'=>'Credito...','label'=>false,'value'=>number_format($cliente->credito_disponible, 0, ",", ".")]); ?>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <?php echo $this->Form->button(__('Guardar',['class'=>'btn btn-primary'])) ?>
            </div>

        </div>
    </div>
</div>

<?= $this->Form->end() ?>

<?php $comunas = json_encode($comunasAll); ?>
<script>
    var comunas = '<?php echo $comunas ?>';
    (function( $ ) {
        $(document).ready(function() {
            var jsonComunas = $.parseJSON(comunas);
            $('#region-id').change(function() {
                cargarComuna($(this).val());
            });

            function cargarComuna(valor){
                $('#comuna-id').empty();
                $('#comuna-id').append('<option value="">--Seleccione la comuna--</option>');
                $.each(jsonComunas,function(i,valp){
                    if(valp.region_id == $('#region-id').val()){
                        $('#comuna-id').append('<option value="'+valp.id+'">'+valp.nombre+'</option>');
                    }
                });
            }

        });

        $("#credito-disponible").on({
          "change": function(event) {
            $(event.target).select();
          },
          "keyup": function(event) {
            $(event.target).val(function(index, value) {
              return value.replace(/\D/g, "")
                // .replace(/([0-9])([0-9]{2})$/, '$1.$2') //Agrega decimal 
                .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
            });
          }
        });
    })(jQuery);
</script>
