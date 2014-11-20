<?php
include("application/views/header.php") 
?>
<?php

if(!isset($_SESSION['customer'])){
	echo '<div class="alert alert-warning">  
  		  	<a class="close" data-dismiss="alert">×</a>  
  			<h4 class="alert-heading">Warning!</h4>  
 			Please login to add items to the shopping cart! 
		  </div>';	
}

echo "<h2>Product Table</h2>";
echo "<table class='table table-striped'>";
echo "<tr><th>Name</th><th>Description</th><th>Price</th><th>Photo</th>";
if(isset($_SESSION['customer'])){
 echo "<th>Add to cart</th>";
}
echo "</tr>";

foreach ($products as $product) {
	echo "<tr>";
    echo "<td>" . $product->name        . "</td>";
    echo "<td>" . $product->description . "</td>";
    echo "<td>" . $product->price       . "</td>";
    echo "<td><img src='" . base_url() . "images/product/" . $product->photo_url . "' width='100px' class='img-thumbnail'/></td>";
    if(isset($_SESSION['customer'])){
    	echo "<td><a href=" . site_url("estore/add") . "/" . $product->id . "><span class='glyphicon glyphicon-plus'></span></a></td>";
    }
    echo "</tr>";
}
echo "</table>";

?>

<?php
include("application/views/footer.php") ?>