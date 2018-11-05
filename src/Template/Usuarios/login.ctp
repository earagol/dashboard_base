<div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
        <form class="login100-form validate-form flex-sb flex-w">
          <span class="login100-form-title p-b-32">
            Login
          </span>

          <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
            <?php echo $this->Flash->render('auth') ?>
            <?php echo $this->Form->create('Usuarios'); ?>

                  <span class="txt1 p-b-11">
                    Usuario
                  </span>
                  <div class="wrap-input100 validate-input m-b-36" data-validate = "Username is required">
                    <!-- <input class="input100" type="text" name="username" > -->
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
                    <!-- <input class="input100" type="password" name="pass" > -->
                    <span class="focus-input100"></span>
                <?php echo $this->Form->end(); ?>   
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

        </form>
      </div>
    </div>
</div>

<!--   <div class="row">
            <div class="col-md-3"></div>
            <div id="loginbox" style="margin-top:100px;" class="mainbox col-md-6">                    
                <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            <?php echo $this->Flash->render('auth') ?>
                            <?php echo $this->Form->create('Usuarios'); ?>

                                    

                                <div style="margin-bottom: 25px" class="form-group row">
                                    <div class="col-md-12">
                                    
                                        <?php echo $this->Form->input('username',['class'=>'form-control input-lg','placeholder'=>'Usuario..','label'=>false,'required']); ?>

                                    </div>
                                                                        
                                </div>
                                    
                                <div style="margin-bottom: 25px" class="form-group row">
                                    <div class="col-md-12">
                                        <?php echo $this->Form->input('password',['class'=>'form-control input-lg','placeholder'=>'Contaseña','label'=>false,'required']); ?>
                                    </div>
                                </div>
                                


                                <div style="margin-top:10px" class="form-group row">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <!-- <a id="btn-login" href="#" class="btn btn-success">Login  </a> -->
                                      <?php echo $this->Form->button('Acceder', ['class'=>'btn btn-primary']); ?>
                                    </div>
                                </div>


                                
                            <?php echo $this->Form->end(); ?>   



                        </div>                     
                    </div>  
            </div>

</div> -->

