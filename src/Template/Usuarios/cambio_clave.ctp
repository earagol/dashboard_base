<div class="col-lg-12">
	<?php echo $this->Form->create($usuario) ?>
	    <div class="card">
	        <div class="card-header">
	            <strong class="card-title">Cambio Clave</strong>
	        </div>
	        <div class="card-body">
	        	<div id="personales">
		            <div class="form-group">
						<label for="clave1" class="col-sm-4 control-label">Clave nueva:</label>
						<div class="col-sm-8">
							<?php echo $this->Form->password('password', [
								'div' => false,
								'label' => false,
								'required' => false,
								'id' => 'password',
								'value' => '',
								'class' => 'form-control confirmar-password',
								'placeholder' => 'Tu clave nueva aquí'
							]); ?>
						</div>
					</div>
					<div class="form-group" id="confirmar-password">
						<label for="claveee" class="col-sm-4 control-label">Repetir clave nueva:</label>
						<div class="col-sm-8">
							<?php echo $this->Form->password('clave_confirmacion', [
								'div' => false,
								'label' => false,
								'required' => false,
								'id' => 'repetirPassword',
								'value' => '',
								'class' => 'form-control confirmar-password',
								'placeholder' => 'Repite tu clave nueva aquí'
							]); ?>
							<!-- <p id="Message" class="help-block p-xs"><p> -->
						</div>
					</div>
					<div id="Message" style="display:none;" class="alert alert-success">
					</div>

					<div class="form-group" id="confirmar-password">
						<button id="Submit" type="submit" class="btn btn-primary" disabled>
							Guardar
						</button>
					</div>

				</div>
	        </div>

	    </div>
    <?= $this->Form->end() ?>
</div>

<script type="text/javascript">
	
(function( $ ) {
		$(document).on('keyup', '.confirmar-password', function() {
			var padre = $('#personales');
			var message = $('#Message');
			// var messagesContainer = $('#messagesContainer');
			var password = padre.find('input[name=password]').val();
			var repetirPassword = padre.find('input[name=clave_confirmacion]').val();
			$('#repetirPassword').bind("cut copy paste",function(e) {
				e.preventDefault();
			});
			var html = '';
			$('#Submit').prop('disabled','disabled');
			
			if(password.length > 0 && password.length < 6) {
				message.removeClass('alert-danger alert-success');
				message.attr('style', 'display: block');
				message.addClass('alert-danger');
				message.text('La contraseña debe tener un mínimo de 6 caracteres.');
			} else if (password.length != repetirPassword.length) {
				message.removeClass('alert-danger alert-success');
				message.attr('style', 'display: block');
				message.addClass('alert-danger');
				message.text('Las contraseñas no son iguales');
			} else if (password !== repetirPassword) {
				message.removeClass('alert-danger alert-success');
				message.attr('style', 'display: block');
				message.addClass('alert-danger');
				message.text('Las contraseñas no son iguales.');
			} else {
				message.removeClass('alert-danger');
				message.attr('style', 'display: block');
				message.addClass('alert-success');
				message.text('Las contraseñas son iguales.');
				$('#Submit').prop('disabled','');
			}
		});

})(jQuery);

</script>



