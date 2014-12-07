<html>
<head>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	
	<!-- Optional theme -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="<?= base_url() ?>/css/template.css">
</head>
<body>

<table>
<?php 
	if ($users) {
		foreach ($users as $user) {
			if ($user->id != $currentUser->id) {
?>		
			<tr>
			<td> 
			<?= anchor("arcade/invite?login=" . $user->login,$user->fullName()) ?> 
			</td>
			</tr>

<?php 	
			}
		}
	}
?>

</table>

</body>
</html>