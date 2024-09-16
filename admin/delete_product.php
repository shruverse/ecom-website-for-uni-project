<?php

session_start();

include('../server/connection.php');

?>

<?php include('header.php'); ?>

<?php 

if(!isset($_SESSION['admin_logged_in'])){
    header('location: login.php');
    exit();
}

if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id=?");
    $stmt->bind_param('i',$product_id);
    if($stmt->execute()){
        header('location: products.php?deleted_successfully=Product deleted successfully');
    }else{
        header('location: products.php?delete_failure=Something went wrong, try again');    
    }
}

?>