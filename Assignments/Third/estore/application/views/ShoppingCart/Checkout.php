<?php
include("application/views/header.php") ?>

<h2>Checkout</h2>
<div class="row">
  <h4>Personal information</h4>
      <?php echo form_open_multipart("/ShoppingCart/saveOrder", 'class="form-horizontal" role="form"'); ?>
	   <div class="form-group">
	    <label for="inputEmail3" class="col-sm-2 control-label">Creditcard</label>
	    <div class="col-sm-4">
	     <?php echo form_input('creditcard',set_value('creditcard'),"class='form-control' pattern='.{16,16}' title='16 characters minimum' placeholder='Creditcard' required"); ?> 
	    </div>
	  </div>
	  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Expiration date</label>
		  <div class="row">
			    <div class="col-sm-1">
			    <?php echo form_input('yy',set_value('yy'),"class='form-control' pattern='/^2013|2014|2015|2016|2017|2018|2019|2020|2021$' title='Creditcard expired' placeholder='YYYY' required"); ?> 
			  </div>
			  <div class="col-md-1 col-md-offset-0">
			    <?php echo form_input('mm',set_value('mm'),"class='form-control' pattern='[1-9]|1[012]' placeholder='MM' required"); ?> 
		    	</div>
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <?php echo form_submit('submit','Checkout','class="btn btn-primary"'); ?>
	    </div>
	  </div>
      <?php echo form_close(); ?>
<?php
echo "<h2>Shopping Cart</h2>";
echo "<table class='table table-striped'>";
echo "<tr><th>Name</th><th>Description</th><th>Price</th><th>Quantity</th><th>Total</th></tr>";
$total = 0;
foreach ($products as $product) {
    echo "<tr>";
    echo "<td>" . $product[0]->name . "</td>";
    echo "<td>" . $product[0]->description . "</td>";
    echo "<td>" . $product[0]->price . "</td>";
    echo "<td>" . $product[0]->qtd . "</td>";
    echo "<td>" . $product[0]->qtd * $product[0]->price . "</td>";
    echo "</tr>";
    $total += $product[0]->qtd * $product[0]->price;
}
echo "<tr class='success'>";
echo "<td> <b>Total</b>";
echo "<td colspan='4'><b>" . $total . "</b></td>";
echo "</tr>";
	    		
echo "</table>";
?>
      
  </div>
<?php
include("application/views/footer.php") ?>