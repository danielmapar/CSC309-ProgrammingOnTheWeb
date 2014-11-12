<?php
include("application/views/header.php") ?>

<?php 




echo "<h2>Itens</h2>";
echo "<a href='" . site_url('Admin/newProd') . "'>Add item</a>";
echo "<table class='table table-striped'>";
echo "<tr><th>Name</th><th>Description</th><th>Price</th><th>Photo</th><th>Update</th></tr>";

foreach ($products as $product) {
    echo "<tr>";
    echo "<td>" . $product->name . "</td>";
    echo "<td>" . $product->description . "</td>";
    echo "<td>" . $product->price . "</td>";
    echo "<td><img src='" . base_url() . "images/product/" . $product->photo_url . "' width='100px' class='img-thumbnail'/></td>";
    echo "<td><a href=" . site_url("Admin/DeleteItem") . "/" . $product->id . "><span class='glyphicon glyphicon-minus'></span></a><a href=" . site_url("Admin/Update") . "/" . $product->id . "><span class='glyphicon glyphicon-pencil'></span></a></td>";
    echo "</tr>";
}
echo "<table>";

?>


<?php
include("application/views/footer.php") ?>