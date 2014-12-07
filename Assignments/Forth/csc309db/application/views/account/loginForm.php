
<!DOCTYPE html>

<html>
	<head>
		<style>
			input {
				display: block;
			}
		</style>

	<script src="http://code.jquery.com/jquery-latest.js"></script>
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	
	<!-- Optional theme -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/template.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	</head> 
<body>  
	<h1 class="cover-heading">Login</h1>
	<?php 
	if (isset($errorMsg)) {
		echo "<p>" . $errorMsg . "</p>";
	}
	?>
	
	<div class="container">
	    <div class="well">
	    <?php echo form_open('account/login'); ?>
	      <div class="form-signin" role="form">
	      <?php echo form_input('username',set_value('username'),"required class='form-control' placeholder='Username' "); ?>
	      <?php echo form_password('password',set_value('password'),"required 'required' type='password' class='form-control' placeholder='Password' "); ?>
	      <?php  echo form_submit('submit', "Login", "Password class='btn btn-lg btn-primary btn-block'"); ?>
	      </div>

	      </div>
     </div> 
	      <?php echo form_close();?>
	      	<?php echo "<p>" . anchor('account/newForm','Create Account') . "</p>";?>

	        <?php echo "<p>" . anchor('account/recoverPasswordForm','Recover Password') . "</p>";?>
</body>

</html>

