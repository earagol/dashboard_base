<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ruta $ruta
 */
?>
<?php echo $this->Form->create($parametrosValore) ?>
 <div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Agregar tipo Parametro (fecha: <?php echo date('Y-m-d'); ?>)</strong>
            <div class="pull-right">
                <?php echo $this->Html->link(__('Volver',['class'=>'btn btn-default']), ['action' => 'index']) ?></li>
            </div>
        </div>
        <div class="card-body card-block">
            <div class="form-group">
                <label for="company" class=" form-control-label">Tipo</label>
                <?php echo $this->Form->control('parametros_tipo_id',['empty'=> '--Seleccione el tipo--','class'=>'form-control','label'=>false]); ?>
            </div>

            <div id="data"></div>

            <div class="form-group">
                <?php echo $this->Form->button(__('Guardar',['class'=>'btn btn-primary'])) ?>
            </div>

        </div>
    </div>
</div>

<?= $this->Form->end() ?>

<script type="text/javascript">
    var url1 = '<?php echo $url; ?>';
    var csrfToken = <?php echo json_encode($this->request->getParam('_csrfToken')) ?>;

    (function( $ ) {
        $('#parametros-tipo-id').click(function() {
            if($('#parametros-tipo-id').val() == ''){
                return;
            }

            $.ajax({
                url:url1+'parametrosValores/datos',
                dataType: 'html',
                type: 'POST',
                headers: {
                    'X-CSRF-Token': csrfToken
                },
                data:{
                    tipo_parametro: $('#parametros-tipo-id').val()
                },
                success: function(response){
                    $('#data').html(response);
                }
            });

        });
    })(jQuery);
</script>
