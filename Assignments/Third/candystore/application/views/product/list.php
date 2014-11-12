<?php
include("application/views/header.php") ?>
<?php

echo "<h2>Product Table</h2>";
echo "<table class='table table-striped'>";
echo "<tr><th>Name</th><th>Description</th><th>Price</th><th>Photo</th><th>Add to cart</th></tr>";

foreach ($products as $product) {
    echo "<tr>";
    echo "<td>" . $product->name . "</td>";
    echo "<td>" . $product->description . "</td>";
    echo "<td>" . $product->price . "</td>";
    echo "<td><img src='" . base_url() . "images/product/" . $product->photo_url . "' width='100px' class='img-thumbnail'/></td>";
    echo "<td><a href=" . site_url("CandyStore/add") . "/" . $product->id . "><span class='glyphicon glyphicon-plus'></span></a></td>";
    echo "</tr>";
}
echo "<table>";

?>



<?php
include("application/views/footer.php") ?>