<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='set' LIMIT 4");

$stmt->execute();

$sets = $stmt->get_result();

?>
