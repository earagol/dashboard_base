<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
---------->


<style>
  #login {
      padding-top: 50px
  }
  #login .form-wrap {
      width: 30%;
      margin: 0 auto;
  }
  #login h1 {
      color: #1fa67b;
      font-size: 18px;
      text-align: center;
      font-weight: bold;
      padding-bottom: 20px;
  }
  #login .form-group {
      margin-bottom: 25px;
  }
  #login .checkbox {
      margin-bottom: 20px;
      position: relative;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      -o-user-select: none;
      user-select: none;
  }
  #login .checkbox.show:before {
      content: '\e013';
      color: #1fa67b;
      font-size: 17px;
      margin: 1px 0 0 3px;
      position: absolute;
      pointer-events: none;
      font-family: 'Glyphicons Halflings';
  }
  #login .checkbox .character-checkbox {
      width: 25px;
      height: 25px;
      cursor: pointer;
      border-radius: 3px;
      border: 1px solid #ccc;
      vertical-align: middle;
      display: inline-block;
  }
  #login .checkbox .label {
      color: #6d6d6d;
      font-size: 13px;
      font-weight: normal;
  }
  #login .btn.btn-custom {
      font-size: 14px;
    margin-bottom: 20px;
  }
  #login .forget {
      font-size: 13px;
    text-align: center;
    display: block;
  }

  /*    --------------------------------------------------
    :: Inputs & Buttons
    -------------------------------------------------- */
  .form-control {
      color: #212121;
  }
  .btn-custom {
      color: #fff;
    background-color: #1fa67b;
  }
  .btn-custom:hover,
  .btn-custom:focus {
      color: #fff;
  }

  /*    --------------------------------------------------
      :: Footer
    -------------------------------------------------- */
  #footer {
      color: #6d6d6d;
      font-size: 12px;
      text-align: center;
  }
  #footer p {
      margin-bottom: 0;
  }
  #footer a {
      color: inherit;
  }

  body{
    display: block;
    width: 100%;
    height: 34px;
    padding: 100px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    /*border: 1px solid #ccc;*/
    border-radius: 4px;
  }

  input, textarea, select, button {
    text-rendering: auto;
    color: initial;
    letter-spacing: normal;
    word-spacing: normal;
    text-transform: none;
    text-indent: 0px;
    text-shadow: none;
    display: inline-block;
    text-align: start;
    margin: 0em;
    font: 400 13.3333px Arial;
}
user agent stylesheet
input, textarea, select, button, meter, progress {
    -webkit-writing-mode: horizontal-tb !important;
}

.form-control {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}

</style>

<section id="login">
      <div class="row">
          <div class="col-xs-12">
              <div class="form-wrap">
                <h1>Login</h1>
                    <?php echo $this->Form->create('Usuarios',['autocomplete'=>'off','id'=>'login-form','role'=>"form"]); ?>
                        <?php echo $this->Flash->render('auth') ?>
                        <div class="form-group">
                            <label for="email" class="sr-only">Usuario</label>
                            <?php echo $this->Form->input('username',['class'=>'form-control','placeholder'=>'Usuario..','label'=>false,'required']); ?>
                        </div>
                        <div class="form-group">
                            <label for="key" class="sr-only">Password</label>
                            <?php echo $this->Form->input('password',['class'=>'form-control','placeholder'=>'Contaseña','label'=>false,'required']); ?>
                        </div>
                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Log in">

                    <?php echo $this->Form->end(); ?>   
                    <hr>
              </div>
        </div> <!-- /.col-xs-12 -->
      </div> <!-- /.row -->
</section>

<div class="modal fade forget-modal" tabindex="-1" role="dialog" aria-labelledby="myForgetModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">×</span>
          <span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title">Recovery password</h4>
      </div>
      <div class="modal-body">
        <p>Type your email account</p>
        <input type="email" name="recovery-email" id="recovery-email" class="form-control" autocomplete="off">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-custom">Recovery</button>
      </div>
    </div> <!-- /.modal-content -->
  </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->

<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p>Estrella © - 2018</p><br>
                <?php echo $this->element('version'); ?>
            </div>
        </div>
    </div>
</footer>