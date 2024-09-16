<?php include('header.php'); ?>

<?php 

if(!isset($_SESSION['admin_logged_in'])){
    header('location: login.php');
    exit();
}

?>

<div class="container-fluid">
    <div class="row">
  <div class="col-md-3 col-sm-12">
    <?php include('sidemenu.php'); ?> 
</div>
<div class="col-md-9 col-sm-12 justify-content-between flex-wrap align-items-center">
 <h2 class="text-center">Add Product</h2> <br>

 <div class="mx-auto container">

<div class="container">
    <h4>Id:<?php echo $_SESSION['admin_id']; ?></h4>
    <h4>Name:<?php echo $_SESSION['admin_name']; ?></h4>
    <h4>Email:<?php echo $_SESSION['admin_email']; ?></h4>
</div>

</div>
</div>
</div>
</div>
</body>
</html>



 