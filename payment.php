<?php

include('layouts/header.php');

include ('server/connection.php');


$user_id = $_SESSION['user_id'];

if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
    exit;
  }

?>


<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
       <h2 class="form-weight-bold">Order Placed</h2>
       <h3 class="form-weight-bold">Currently only cash on delivery available.</h3>
       <hr class="mx-auto">
    </div>

            <?php
            $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                while ($order_row = $result->fetch_assoc()) {
                    // Retrieve values from the fetched row
                    $order_id = $order_row['order_id'];
                    $order_cost = $order_row['order_cost'];
                    $order_status = $order_row['order_status'];
                    $order_date = $order_row['order_date'];
                    
                    // Display the retrieved values in the HTML template
                    echo '<div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Order ID: ' . $order_id . '</h5>
                                    <p class="card-text">Order Cost: ₹' . $order_cost . '</p>
                                    <p class="card-text">Order Status: ' . $order_status . '</p>
                                    <p class="card-text">Order Date: ' . $order_date . '</p>
                                    <a href="order_details.php?order_id=' . $order_id . '" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>';
                }
            } else {
                echo '<div class="col-md-12 text-center">No orders found.</div>';
            }
            
            $stmt->close();
            $conn->close();
            

            ?>

    

    </section>

    <?php include('layouts/footer.php'); ?>
