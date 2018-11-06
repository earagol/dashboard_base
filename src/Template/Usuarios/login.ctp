<div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
        <?php echo $this->Form->create('Usuarios',['class'=>'login100-form validate-form flex-sb flex-w']); ?>
          <span class="login100-form-title p-b-32">
            Login
          </span>

          <?php echo $this->Flash->render('auth') ?>

          <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                    <span class="txt1 p-b-11">
                            Usuario
                    </span>
                    <div class="wrap-input100 validate-input m-b-36" data-validate = "Username is required">
                            <?php echo $this->Form->input('username',['class'=>'input100','placeholder'=>'Usuario..','label'=>false,'required']); ?>
                            <span class="focus-input100"></span>
                    </div>
                  
                    <span class="txt1 p-b-11">
                            Password
                    </span>
                    <div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
                        <span class="btn-show-pass">
                                <i class="fa fa-eye"></i>
                        </span>
                    <?php echo $this->Form->input('password',['class'=>'input100','placeholder'=>'Contaseña','label'=>false,'required']); ?>
                    <span class="focus-input100"></span>
                
          </div>
          
          <!-- <div class="flex-sb-m w-full p-b-48">
            <div class="contact100-form-checkbox">
              <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
              <label class="label-checkbox100" for="ckb1">
                Remember me
              </label>
            </div>

            <div>
              <a href="#" class="txt3">
                Forgot Password?
              </a>
            </div>
          </div> -->

          <div class="container-login100-form-btn">
            <?php echo $this->Form->button('Login', ['class'=>'login100-form-btn']); ?>
          </div>

        <?php echo $this->Form->end(); ?>   
      </div>
    </div>
</div>



