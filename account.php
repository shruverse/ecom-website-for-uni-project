<?php

include('layouts/header.php');

include('server/connection.php');

if(!isset($_SESSION['logged_in'])){
  header('location: login.php');
  exit;
}

if(isset($_GET['logout'])){
  if(isset($_SESSION['logged_in'])){
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    header('location: login.php');
    exit;
  }
}

if(isset($_POST['change_password'])){

  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];
  $user_email = $_SESSION['user_email'];

  if($password !== $confirmPassword){
    header('location: account.php?error=Passwords do not match!');
  

  }else if(strlen($password) < 6){
    header('location: account.php?error=Password must be at least 6 characters!');
  
  }else{
    $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
    $stmt->bind_param('ss',md5($password),$user_email);
    if($stmt->execute()){
      header('location: account.php?message=Password Updated seccessfully!');

    }else{
      header('location: account.php?error=Could not update password. Please try again.');
    }
  }


}

if(isset($_SESSION['logged_in'])){
  $user_id = $_SESSION['user_id'];
  $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=?");

  $stmt->bind_param('i',$user_id);
  $stmt->execute();

  $orders = $stmt->get_result();

}

?>


     
<!--Account-->
<section class="my-5 py-5">
    <div class="row container mx-auto">
        <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
        <h4 class="text-center" style="color: green;"><?php if(isset($_GET['register_success'])){ echo $_GET['register_success'];}?></h4>
        <h4 class="text-center" style="color: green;"><?php if(isset($_GET['login_success'])){ echo $_GET['login_success'];}?></h4>    
        <h3 class="font-weight-bold">Account info</h3>
            <hr class="mx-auto">
            <div class="account-info">
                <p>Name: <span><?php if(isset($_SESSION['user_name'])){ echo $_SESSION['user_name'];} ?></span></p>
                <p>Email: <span><?php if(isset($_SESSION['user_email'])){  echo $_SESSION['user_email'];} ?></span></p>
                <p><a href="#orders" id="orders-btn">Your orders</a></p>
                <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <form id="account-form" method="POST" action="account.php">
            <h4 class="text-center" style="color: red;"><?php if(isset($_GET ['error'])){ echo $_GET['error'];}?></h4>
            <h4 class="text-center" style="color: green ;"><?php if(isset($_GET ['message'])){ echo $_GET['message'];}?></h4>
                <h3>Change password</h3>
                <hr class="mx-auto">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="account-password" name="password" placeholder="Password" required />
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword" placeholder="Confirm Password" required />
                </div>
                <div class="form-group">
                    <input type="submit" value="Change Password" name="change_password" class="btn" id="change-pass-btn" />
                </div>
            </form>
        </div>
    </div>
</section>

      <!--Orders-->
      <section id="orders" class="orders container my-5 py-3">
        <div class="container mt-2">
            <h2 class="font-weight-bold text-center">Your Orders</h2>
            <hr class="mx-auto">
        </div>

        <table class="mt-5 pt-5">
            <tr>
                <th style="text-align: center;">Order Id</th>
                <th style="text-align: center;">Order Cost</th>
                <th style="text-align: center;">Order Status</th>
                <th style="text-align: center;">Order Date</th>
                <th style="text-align: center;">Order Details</th>
            </tr>
            <?php while($row = $orders->fetch_assoc()){?>
           <tr>
                <td style="text-align: center;">
                <h5><?php echo $row['order_id']; ?></h5>
                </td>
        
                <td style="text-align: center;">
                  <h5><?php echo $row['order_cost']; ?></h5>
                </td>

                <td style="text-align: center;">
                  <h5><?php echo $row['order_status']; ?></h5>
                </td>

                <td style="text-align: center;">
                  <h5><?php echo $row['order_date']; ?></h5>
                </td>
              
                <td style="text-align: center;">
                  <form method="POST" action="order_details.php">
                  <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status" />
                    <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id"/>
                    <input name="order_details_btn" style="font-weight: 700; color: #fff; background-color: blueviolet;" class="btn" type="submit" value="details" />
                  </form>
                </td>

            
            </tr>
            <?php } ?>
        </table>

        

      </section>     

      <?php include('layouts/footer.php'); ?>