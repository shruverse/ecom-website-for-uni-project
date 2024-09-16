
<?php

include('layouts/header.php');

if(!empty($_SESSION['cart'])){

}else{

  header('location: cart.php');
  echo "<script>alert('There is nothing in your cart. Please add items to your cart.');</script>";
  

}
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['phone'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $address = mysqli_real_escape_string($conn,  $_POST['city']);
   $placed_on = order_date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ',$cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

   if($cart_total == 0){
      $message[] = 'your cart is empty';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'order already placed!'; 
      }else{
         mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
         $message[] = 'order placed successfully!';
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      }
   }
   
}

?>



<!--Checkout-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
       <h2 class="form-weight-bold">Check Out</h2>
       <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
        <form id="checkout-form" method="POST" action="./place_order.php">
            <h4 class="text-center" style="color: red;">
               <?php if(isset($_GET['message'])){echo $_GET['message'];} ?>
               <?php if(isset($_GET['message'])){?>
                   <a href="login.php" class="btn btn-primary">Login</a>    
               <?php } ?>    
            </h4>
            <div class="form-group checkout-small-element">
                <label>Name</label>
                <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required />
            </div>
            <div class="form-group checkout-small-element">
                <label>Email</label>
                <input type="text" class="form-control" id="checkout-email" name="email" placeholder="Email" required />
            </div>
            <div class="form-group checkout-small-element">
                <label>Phone</label>
                <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Phone" required />
            </div>
            <div class="form-group checkout-small-element">
                <label>City</label>
                <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required />
            </div>
            <div class="form-group checkout-large-element">
                <label>Adress</label>
                <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address" required />
            </div>
            <div class="form-group checkout-btn-container">
                <h4>Total amount: ₹<?php echo $_SESSION['total']; ?></h4><br>
              <input type="submit" class=" order_btn" id="checkout-btn" name="place_order" value="Place Order"/>
            </div>  
        </form>
    </div>
</section>





<?php include('layouts/footer.php'); ?>