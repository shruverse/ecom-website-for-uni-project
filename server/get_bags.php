<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='main_bag' LIMIT 4");

$stmt->execute();

$main_bag = $stmt->get_result();

?>
