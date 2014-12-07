
<!DOCTYPE html>

<html>
	
	<head>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="<?= base_url() ?>/js/jquery.timers.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	
	<!-- Optional theme -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="<?= base_url() ?>/css/template.css">
	<script>
		$(function(){

			$('#availableUsers').everyTime(500,function(){
					$('#availableUsers').load('<?= base_url() ?>index.php/arcade/getAvailableUsers');

					$.getJSON('<?= base_url() ?>index.php/arcade/getInvitation',function(data, text, jqZHR){
							if (data && data.invited) {
								var user=data.login;
								var time=data.time;
								if(confirm('Play ' + user)) 
									$.getJSON('<?= base_url() ?>index.php/arcade/acceptInvitation',function(data, text, jqZHR){
										if (data && data.status == 'success')
											window.location.href = '<?= base_url() ?>index.php/board/index'
									});
								else  
									$.post("<?= base_url() ?>index.php/arcade/declineInvitation");
							}
						});
				});
			});
	
	</script>
	</head> 
<body>  


<div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">Connect4 - Hello <?= $user->fullName() ?> </h3>
              <ul class="nav masthead-nav">
                <li class="active"><?= anchor('account/logout','Logout') ?>  </li>
                <li class=""><?= anchor('account/updatePasswordForm','Update Password') ?>  </li>
              </ul>
            </div>
          </div>

          <div class="inner cover">
				<?php 
					if (isset($errmsg)) 
						echo "<p>$errmsg</p>";
				?>
					<h1>Available Users</h1>
					<div id="availableUsers">
					</div>
          </div>

          <div class="mastfoot">
            <div class="inner">
					<p> Connect4 </p>
            </div>
          </div>

        </div>

      </div>

    </div>

	
</body>

</html>

