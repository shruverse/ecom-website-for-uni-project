<?php include('header.php'); ?>

<?php
if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id=? ");
    $stmt->bind_param('i',$order_id);
    $stmt->execute();
    $order = $stmt->get_result();
}else if(isset($_POST['edit_order'])){
    $order_status = $_POST['order_status'];
    $order_id = $_POST['order_id'];
    $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
    $stmt->bind_param('si',$order_status,$order_id);
    if($stmt->execute()){
    header('location: index.php?order_updated=Order updated successfully');
    }else{
    header('location: index.php?order_failed=Something went wrong, try again');    
    }
}else{    
    header('location: index.php');
    exit;
}

?>

<div class="container-fluid">
    <div class="row">
  <div class="col-md-3 col-sm-12">
    <?php include('sidemenu.php'); ?> 
</div>
<div class="col-md-9 col-sm-12 justify-content-between flex-wrap align-items-center">
 <h2 class="text-center">Edit Product</h2> <br>
   
<div class="table-responsive">
    <form id="edit-order-form" method="POST" action="edit_order.php">
        <?php foreach($order as $r){?>
    <h4 class="text-center" style="color: red;"><?php if(isset($_GET ['error'])){ echo $_GET['error'];}?></h4>
    <div class="form-group my-3">
        <label>Order Id</label>
        <h4 class="my-4"><?php echo $r['order_id']; ?></h4>
    </div>
    <div class="form-group my-3">
        <label>Order Price</label>
        <h4 class="my-4"><?php echo $r['order_cost']; ?></h4>
    </div>
    <input type="hidden" name="order_id" value="<?php echo $r['order_id']; ?>" />
    <div class="form-group my-3">
        <label>Order Status</label>
        <select class="form-select" required name="order_status">
           
            <option value="not paid" <?php if($r['order_status']=='not paid') { echo "selected" ;} ?>>Not Paid</option>
            <option value="paid" <?php if($r['order_status']=='paid') { echo "selected" ;} ?>>Paid</option>
            <option value="shipped" <?php if($r['order_status']=='shipped') { echo "selected" ;} ?>>Shipped</option>
            <option value="delivered" <?php if($r['order_status']=='delivered') { echo "selected" ;} ?>>Delivered</option>
        </select>
    </div>
    <div class="form-group my-3">
        <label>Order Date</label>
        <h4 class="my-4"><?php echo $r['order_date']; ?></h4>
    </div>
    <div class="form-group mt-3">
        <input type="submit" class="btn btn-primary" name="edit_order" value="Edit"/>
    </div>
    <?php } ?>

        </form>

</div>
</div>