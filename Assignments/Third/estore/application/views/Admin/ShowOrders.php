<?php
include("application/views/header.php") ?>

<?php
echo "<h2>Orders</h2>";
echo "<table class='table table-striped'>";
echo "<tr><th>Id</th><th>Customer Id</th><th>Date</th><th>Hour</th><th>Total</th></tr>";

foreach ($orders as $order) {
    echo "<tr>";
    echo "<td>" . $order->id. "</td>";
    echo "<td>" . $order->customer_id . "</td>";
    echo "<td>" . $order->order_date . "</td>";
    echo "<td>" . $order->order_time . "</td>";
    echo "<td>" . $order->total . "</td>";
    echo "</tr>";
}
echo "<table>";
?>

<?php
include("application/views/footer.php") ?>