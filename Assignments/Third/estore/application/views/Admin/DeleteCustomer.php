<?php
include("application/views/header.php") ?>

<?php
echo "<h2>Customers</h2>";
echo "<table class='table table-striped'>";
echo "<tr><th>Id</th><th>First name</th><th>Last name</th><th>Login</th><th>Email</th><th>Delete</th></tr>";

foreach ($customer as $cs) {
    echo "<tr>";
    echo "<td>" . $cs->id . "</td>";
    echo "<td>" . $cs->first . "</td>";
    echo "<td>" . $cs->last . "</td>";
    echo "<td>" . $cs->login . "</td>";
    echo "<td>" . $cs->email . "</td>";
    echo "<td><a href=" . site_url("Admin/DeleteCustomer") . "/" . $cs->id . "><span class='glyphicon glyphicon-remove'></span></a></td>";
    echo "</tr>";
}
echo "<table>";
?>


<?php
include("application/views/footer.php") ?>