<?php
include("application/views/header.php") ?>
<h2>Login</h2>
<div class="row">
  <div class="col-md-6">
  <?php if($message){ ?>
  <div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>
    <?= $message ?>
  </div>
  <?php } ?>
  
  <h4>Create account</h4>
      <?php echo form_open_multipart("/user/createAccount", 'class="form-horizontal" role="form"'); ?>
	   <div class="form-group">
	    <label for="inputEmail3" class="col-sm-2 control-label">Login</label>
	    <div class="col-sm-10">
	     <?php echo form_input('login',set_value('login'),"class='form-control'  placeholder='Login' required"); ?> 
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputEmail3" class="col-sm-2 control-label">First name</label>
	    <div class="col-sm-10">
	    <?php echo form_input('first',set_value('first'),"class='form-control'  placeholder='First name' required"); ?> 
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputEmail3" class="col-sm-2 control-label">Last name</label>
	    <div class="col-sm-10">
	    <?php echo form_input('last',set_value('last'),"class='form-control'  placeholder='Last name' required"); ?> 
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
	    <div class="col-sm-10">
	    <?php 
	        $data = array(
             'name'        => 'email',
             'id'          => 'email',
             'value'       => set_value('email'),
             'placeholder' => 'Email',
             'class' => 'form-control',
             'type' => 'email',
             'required' => 'required');
	    
	       echo form_input($data); ?> 
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
	    <div class="col-sm-10">
	  	  <?php echo form_password('password',set_value('password'),"class='form-control' pattern='.{6,}' title='6 characters minimum' placeholder='Password' required"); ?> 
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <?php echo form_submit('submit','Create account','class="btn btn-primary"'); ?>
	    </div>
	  </div>
      <?php echo form_close(); ?>
  </div>
  <div class="col-md-6">
  <h4>Login</h4>
  <?php echo form_open_multipart("/user/login/", 'class="form-horizontal" role="form"'); ?>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Login</label>
    <div class="col-sm-10">
       <?php echo form_input('login',set_value('login'),"class='form-control'  placeholder='Login' required"); ?> 
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <?php echo form_password('password',set_value('password'),"class='form-control' pattern='.{6,}' title='6 characters minimum' placeholder='Password' required"); ?>  
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Remember me
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
       <?php echo form_submit('submit','Sign in' ,'class="btn btn-info"'); ?>
    </div>
  </div>
      <?php echo form_close(); ?>
  </div>
</div>
<?php
include("application/views/footer.php") ?>