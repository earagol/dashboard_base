<div class="row">
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

</div>

