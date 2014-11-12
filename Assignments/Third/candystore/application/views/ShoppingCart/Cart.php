<?php
include("application/views/header.php") ?>

<?php
echo "<h2>Shopping Cart</h2>";
echo "<table class='table table-striped'>";
echo "<tr><th>Name</th><th>Description</th><th>Price</th><th>Photo</th><th>Quantity</th><th>Total</th><th>Update</th></tr>";

foreach ($products as $product) {
    echo "<tr>";
    echo "<td>" . $product[0]->name . "</td>";
    echo "<td>" . $product[0]->description . "</td>";
    echo "<td>" . $product[0]->price . "</td>";
    echo "<td><img src='" . base_url() . "images/product/" .  $product[0]->photo_url . "' width='100px' class='img-thumbnail'/></td>";
    echo "<td>" . $product[0]->qtd . "</td>";
    echo "<td>" . $product[0]->qtd * $product[0]->price . "</td>";
    echo "<td><a href=" . site_url("ShoppingCart/add") . "/" .  $product[0]->id . "><span class='glyphicon glyphicon-plus'></span></a><a href=" . site_url("CandyStore/remove") . "/" .  $product[0]->id . "><span class='glyphicon glyphicon-minus'></span></a></td>";
    echo "</tr>";
}
echo "</table>";
?>

<?php
include("application/views/footer.php") ?>