<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ruta $ruta
 */
?>
<?php echo $this->Form->create($cliente,['url' => ['controller'=>'clientes','action' => 'add']]) ?>
 <div class="col-lg-12 ">
    <div class="card">
        <div class="card-header">
            <strong>Agregar Cliente</strong>
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
                <?php echo $this->Form->control('rut',['value' =>'','class'=>'form-control','placeholder'=>'Rut','label'=>false]); ?>
                <p><b>El formato del rut debe ser por ejemplo: 11111111-1</b></p>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Email</label>
                <?php echo $this->Form->control('email',['value' =>'','class'=>'form-control','placeholder'=>'Email','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Sexo</label>
                <?php echo $this->Form->control('sexo',['type'=>'select','options'=>['N'=>'--Seleccione--','M'=>'Masculino','F'=>'Femenino','O'=>'Otro'],'default'=>'N','class'=>'form-control','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Telefono 1</label>
                <?php echo $this->Form->control('telefono1',['value' =>'','class'=>'form-control','placeholder'=>'Telefono 1..','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Telefono 2</label>
                <?php echo $this->Form->control('telefono2',['value' =>'','class'=>'form-control','placeholder'=>'Telefono 2...','label'=>false]); ?>
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
                <?php echo $this->Form->control('comuna_id',['options'=>[],'class'=>'form-control','empty'=>'--Seleccione la comuna--','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Calle/Avenida</label>
                <?php echo $this->Form->control('calle',['value' =>'','class'=>'form-control','placeholder'=>'Calle/Avenida..','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Número</label>
                <?php echo $this->Form->control('numero_calle',['value' =>'','class'=>'form-control','placeholder'=>'Número','label'=>false]); ?>
            </div>

            <div class="form-group">
                <label for="company" class=" form-control-label">Número casa/dept/oficina</label>
                <?php echo $this->Form->control('dept_casa_oficina_numero',['value' =>'','class'=>'form-control','placeholder'=>'Número casa/dept/oficina ...','label'=>false]); ?>
            </div>

            
            <?php if($currentUser['role'] == 'admin') : ?>
                <div class="form-group">
                    <label for="company" class=" form-control-label">Credito disponible</label>
                    <?php echo $this->Form->control('credito_disponible',['class'=>'form-control','placeholder'=>'Credito...','label'=>false]); ?>
                </div>
            <?php endif; ?>

            <?php echo $this->Form->control('where',['value' =>$where,'type'=>'hidden']); ?>

            <div class="form-group">
                <?php echo $this->Form->button('Guardar',['type'=>'button','class'=>'btn btn-primary','id' => 'saveAll']) ?>
            </div>

        </div>
    </div>
</div>

<?= $this->Form->end() ?>

<?php $comunas = json_encode($comunas); ?>
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

    $("#saveAll").on({"click": function(event) {
        event.preventDefault();

        var rut = $('#rut').val();
        // var rut = "25525331-5";
        console.log(rut);

        if(rut == ''){
            alert('Debe ingresar el rut.');
            return;
        }else if(!validadorDeRut(rut)){
            alert('Debe ingrasar un formato de rut valido. Ej: 11111111-1');
            return;
        }

        $('form').submit();
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

<script type="text/javascript">
    
    function revisarDigito( dvr ){
    dv = dvr + "";
    if ( dv != '0' && dv != '1' && dv != '2' && dv != '3' && dv != '4' && dv != '5' && dv != '6' && dv != '7' && dv != '8' && dv != '9' && dv != 'k'  && dv != 'K'){
        return false;
    }
    return true;
}

function revisarDigito2( crut ){
    largo = crut.length;
    if ( largo < 2 ){
        return false;
    }
    if ( largo > 2 ){
        rut = crut.substring(0, largo - 1);
    }else{
        rut = crut.charAt(0);
    }
    dv = crut.charAt(largo-1);
    revisarDigito( dv );

    if ( rut === null || dv === null ){
        return 0
    }

    var dvr = '0'
    suma = 0
    mul  = 2

    for (i= rut.length -1 ; i >= 0; i--){
        suma = suma + rut.charAt(i) * mul
        if (mul == 7){
            mul = 2
        }else{
            mul++
        }
    }
    res = suma % 11;
    if (res==1){
        dvr = 'k';
    }else if (res==0){
        dvr = '0';
    }else{
        dvi = 11-res;
        dvr = dvi + "";
    }
    if ( dvr != dv.toLowerCase() ){
        return false;
    }

    return true
}

function validadorDeRut(texto){
    var tmpstr = "";
    for ( i=0; i < texto.length ; i++ ){
        if ( texto.charAt(i) != ' ' && texto.charAt(i) != '.' && texto.charAt(i) != '-' ){
            tmpstr = tmpstr + texto.charAt(i);
        }
    }
    texto = tmpstr;
    largo = texto.length;

    if ( largo < 2 ){
        return false;
    }

    for (i=0; i < largo ; i++ ){
        if ( texto.charAt(i) !="0" && texto.charAt(i) != "1" && texto.charAt(i) !="2" && texto.charAt(i) != "3" && texto.charAt(i) != "4" && texto.charAt(i) !="5" && texto.charAt(i) != "6" && texto.charAt(i) != "7" && texto.charAt(i) !="8" && texto.charAt(i) != "9" && texto.charAt(i) !="k" && texto.charAt(i) != "K" ){
            return false;
        }
    }

    var invertido = "";
    for ( i=(largo-1),j=0; i>=0; i--,j++ ){
        invertido = invertido + texto.charAt(i);
    }
    var dtexto = "";
    dtexto = dtexto + invertido.charAt(0);
    dtexto = dtexto + '-';
    cnt = 0;

    for ( i=1,j=2; i<largo; i++,j++ ){
        if ( cnt == 3 ){
            dtexto = dtexto + '.';
            j++;
            dtexto = dtexto + invertido.charAt(i);
            cnt = 1;
        }else{
            dtexto = dtexto + invertido.charAt(i);
            cnt++;
        }
    }

    invertido = "";
    for ( i=(dtexto.length-1),j=0; i>=0; i--,j++ ){
        invertido = invertido + dtexto.charAt(i);
    }

    if ( revisarDigito2(texto) ){
        return true;
    }

    return false;
}

</script>

