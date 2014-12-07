
<!DOCTYPE html>

<html>
	<head>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="<?= base_url() ?>js/jquery.timers.js"></script>
	<script src="<?= base_url() ?>js/game.js"></script>
	<script src="<?= base_url() ?>js/jquery.tabletojson.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	
	<!-- Optional theme -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>css/template.css">
    
	<style>
		.blue { background-color : #3366FF; }
		.red {background-color : #CC0000; }
		table {
		    border-collapse: separate;
		    border-spacing: 0;
		    border: none;
		}
		 td {
		    border: 1px solid grey;
		    border-radius: 55px;
		    -moz-border-radius: 55px;
		    padding: 45px;
		    background-color: white;
		}

	</style>
	<script>

		var otherUser = "<?= $otherUser->login ?>";
		var user = "<?= $user->login ?>";
		var status = "<?= $status ?>";
		var url = "<?= base_url() ?>";
		$(function(){
			$('body').everyTime(2000,function(){
					if (status == 'waiting') {
						$.getJSON('<?= base_url() ?>index.php/arcade/checkInvitation',function(data, text, jqZHR){
								if (data && data.status=='rejected') {
									alert("Sorry, your invitation to play was declined!");
									window.location.href = '<?= base_url() ?>index.php/arcade/index';
								}
								if (data && data.status=='accepted') {
									status = 'playing';
									$('#status').html('Playing ' + otherUser);
								}
								
						});
					}
					var url = "<?= base_url() ?>index.php/board/getMsg";
					$.getJSON(url, function (data,text,jqXHR){
						if (data && data.status=='success') {
							var conversation = $('[name=conversation]').val();
							var msg = data.message;
							if (msg.length > 0)
								$('[name=conversation]').val(conversation + "\n" + otherUser + ": " + msg);
						}
					});
			});

			$('form').submit(function(){
				var arguments = $(this).serialize();
				var url = "<?= base_url() ?>index.php/board/postMsg";
				$.post(url,arguments, function (data,textStatus,jqXHR){
						var conversation = $('[name=conversation]').val();
						var msg = $('[name=msg]').val();
						$('[name=conversation]').val(conversation + "\n" + user + ": " + msg);
						});
				return false;
				});	
		});

		var myApp;
		myApp = myApp || (function () {
		    var pleaseWaitDiv = $('<div class="modal hide" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false"><div class="modal-header"><h1>Waiting other player...</h1></div><div class="modal-body"><div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div></div></div>');
		    return {
		        showPleaseWait: function() {
		            pleaseWaitDiv.modal();
		        },
		        hidePleaseWait: function () {
		            pleaseWaitDiv.modal('hide');
		        },

		    };
		})();
	
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
              </ul>
            </div>
          </div>

          <div class="inner cover">
	     <h1>Game Area</h1>
	 	<table width='650' height='450' border='1' id='tbgame'>
				<tr id='1'>
	     			<td id='1'></td>
	     			<td id='2'></td>
	     			<td id='3'></td>
	     			<td id='4'></td>
	     			<td id='5'></td>
	     			<td id='6'></td>
	     			<td id='7'></td>
	     		</tr>
	     		<tr id='2'>
	     			<td id='1'></td>
	     			<td id='2'></td>
	     			<td id='3'></td>
	     			<td id='4'></td>
	     			<td id='5'></td>
	     			<td id='6'></td>
	     			<td id='7'></td>
	     		</tr>
	     		<tr id='3'>
	     			<td id='1'></td>
	     			<td id='2'></td>
	     			<td id='3'></td>
	     			<td id='4'></td>
	     			<td id='5'></td>
	     			<td id='6'></td>
	     			<td id='7'></td>
	     		</tr>
	     		<tr id='4'>
	     			<td id='1'></td>
	     			<td id='2'></td>
	     			<td id='3'></td>
	     			<td id='4'></td>
	     			<td id='5'></td>
	     			<td id='6'></td>
	     			<td id='7'></td>
	     		</tr>
	     		<tr id='5'>
	     			<td id='1'></td>
	     			<td id='2'></td>
	     			<td id='3'></td>
	     			<td id='4'></td>
	     			<td id='5'></td>
	     			<td id='6'></td>
	     			<td id='7'></td>
	     		</tr>
	     		<tr id='6'>
	     			<td id='1'></td>
	     			<td id='2'></td>
	     			<td id='3'></td>
	     			<td id='4'></td>
	     			<td id='5'></td>
	     			<td id='6'></td>
	     			<td id='7'></td>
	     		</tr>
	     
		</table>
          </div>

          <div class="mastfoot">
            <div class="inner">
		<?php 
			if ($status == "playing")
				echo "Playing " . $otherUser->login;
			else
				echo "Wating on " . $otherUser->login;
		?>
            </div>
          </div>

        </div>

      </div>

    </div>
</body>

</html>

