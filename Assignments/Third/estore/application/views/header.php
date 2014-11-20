<html>
<head>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
    <script src="//code.jquery.com/jquery-2.1.0.min.js" type="application/javascript"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <style>
        body {
            min-height: 2000px;
            padding-top: 70px;
        }
    </style>
    <meta name="description" content="EStore Application">
    <meta name="author" content="Daniel Marchena e Guilherme Borges">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        EStore
    </title>
</head>
<body>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo site_url(""); ?>">EStore</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class=""><a href="<?php echo site_url(""); ?>">Inventory</a></li>
                <?php 
		        if (session_status() == PHP_SESSION_NONE) {
					session_start();
				}
               	if(isset($_SESSION['customer'])){
               		$usr = $_SESSION['customer'];
	                if ($usr->login == 'admin' )
	                {
	                	echo '<li class="dropdown">';
	                	echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">Administrator <b class="caret"></b></a>';
	                	echo '<ul class="dropdown-menu">';
	                	echo '<li><a href="' . site_url("admin/ShowOrders") . '">View orders</a></li>';
	                	echo '<li><a href="' . site_url("admin/Edit") . '">Edit products</a></li>';
	                	echo '<li><a href="' . site_url("admin/DeleteCustomerShow") . '">Delete customer</a></li>';
	                	echo '</ul>';
	                	echo '</li>';
	                }
	                else {
	                	
						echo	'<li class="dropdown">';
						echo	'<a href="#" class="dropdown-toggle" data-toggle="dropdown">Shopping Cart <b class="caret"></b></a>';
						echo	'<ul class="dropdown-menu">';
						echo	'<li><a href=" ' . site_url("shoppingcart/Edit") . '">Edit</a></li>';
						echo	'<li><a href=" ' . site_url("shoppingcart/Checkout"). '">Checkout</a></li>';
						echo	'</ul>';
						echo	'</li>';

	                }
                }
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <?php 
         	   if(isset($_SESSION['customer'])){
		             	if (session_status() == PHP_SESSION_NONE) {
							session_start();
						}
		            	if ($usr != NULL)
		            	{
		            		echo '<li><a href="' . site_url("user/logout") . '">[' . "Logout: " . $usr->email . ']</a></li>';
		            	}else
		            	{
		            		echo '<li><a href="' . site_url("user/index") . '">[ Login/Register ]</a></li>';
		            	}
            	}else
            	{
            		echo '<li><a href="' . site_url("user/index") . '">[ Login/Register ]</a></li>';
            	}
            ?>
                
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>
<div class="container">
