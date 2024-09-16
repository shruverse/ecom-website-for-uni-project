<?php

include('layouts/header.php');

include('server/connection.php');

if (!isset($_SESSION['logged_in'])) {
    header('location: ../login.php?message=login/register to place and order');
    exit;
}

if (isset($_POST['place_order'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $order_cost = $_SESSION['total'];
    $order_status = "not paid";
    $user_id = $_SESSION['user_id'];
    $order_date = date('Y-m-d H:i:s');

    // Use prepared statement with bound parameters to insert data into the "orders" table
    $stmt = $conn->prepare("INSERT INTO orders (order_cost,order_status,user_id,user_phone,user_city,user_address,order_date)
                    VALUES (?,?,?,?,?,?,?); ");
    $stmt->bind_param('isiisss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);

    $stmt_status = $stmt->execute();

    if (!$stmt_status) {
        // Query failed to execute
        echo "Error: " . $stmt->error;
    } else {
        // Query executed successfully
        $order_id = $stmt->insert_id;

        foreach ($_SESSION['cart'] as $key => $value) {

            $product = $_SESSION['cart'][$key];
            $product_id = $product['product_id'];
            $product_name = $product['product_name'];
            $product_image = $product['product_image'];
            $product_price = $product['product_price'];
            $product_quantity = $product['product_quantity'];

            // Use prepared statement with bound parameters to insert data into the "order_items" table
            $stmt1 = $conn->prepare("INSERT INTO order_items (order_id,product_id,product_name,product_image,product_price,product_quantity,user_id,order_date)
                       VALUES (?,?,?,?,?,?,?,?)");
            $stmt1->bind_param('iissiiis', $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);

            $stmt1->execute();
        }
    }

    $_SESSION['order_id'] = $order_id;

    header('location: payment.php?order_status=Order placed successfully');

}

include('layouts/footer.php');
?>
