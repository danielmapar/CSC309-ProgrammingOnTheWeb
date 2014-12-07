
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
    <link rel="stylesheet" href="<?= base_url() ?>/css/template.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	</head> 
<body>  
	<h1>Password Recovery</h1>
	
	<p>Please check your email for your new password.
	</p>
	
	
	
<?php 
	if (isset($errorMsg)) {
		echo "<p>" . $errorMsg . "</p>";
	}

	echo "<p>" . anchor('account/index','Login') . "</p>";
?>	
</body>

</html>

