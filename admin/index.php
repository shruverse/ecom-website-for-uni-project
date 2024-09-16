<?php include('header.php'); ?>

<?php 

if(!isset($_SESSION['admin_logged_in'])){
    header('location: login.php');
    exit();
}

?>

<?php

if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
    $page_no = $_GET['page_no'];
  }else{
    $page_no = 1;
  }  
  
  $stmt = $conn->prepare("SELECT COUNT(*) AS total_records FROM orders");
  $stmt->execute();
  $stmt->bind_result($total_records);
  $stmt->store_result();
  $stmt->fetch();
  
  $total_records_per_page = 20;
  $offset = ($page_no-1) * $total_records_per_page;
  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;
  $adjacents = "2";
  $total_no_of_pages = ceil($total_records/$total_records_per_page);
  
  $stmt1 = $conn->prepare("SELECT * FROM orders LIMIT $offset,$total_records_per_page");
  $stmt1->execute();
  $orders = $stmt1->get_result();
  
?>

 

<div class="container-fluid">
    <div class="row">
  <div class="col-md-3 col-sm-12">
    <?php include('sidemenu.php'); ?> 
</div>
<div class="col-md-9 col-sm-12 justify-content-between flex-wrap align-items-center">
 <h2 class="text-center">Orders</h2>
 <?php if(isset($_GET['order_updated'])){ ?>
    <h4 class="text-center" style="color: green;"><?php echo $_GET['order_updated']; ?></h4>
 <?php } ?>
 <?php if(isset($_GET['order_failed'])){ ?>
    <h4 class="text-center" style="color: red;"><?php echo $_GET['order_failed']; ?></h4>
 <?php } ?>
    <div class="table-responsive">
        <table class="table table-striped table-sn">
            <thead>
                <tr>
                    <th scope="col">Order Id</th>
                    <th scope="col">Order Status</th>
                    <th scope="col">User Id</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">User Phone</th>
                    <th scope="col">User Address</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($orders as $order){ ?>
            <tr>
                <td><?php echo $order['order_id']; ?></td>
                <td><?php echo $order['order_status']; ?></td>
                <td><?php echo $order['user_id']; ?></td>
                <td><?php echo $order['order_date']; ?></td>
                <td><?php echo $order['user_phone']; ?></td>
                <td><?php echo $order['user_address']; ?></td>
                <td><a class="btn btn-primary" href="edit_order.php?order_id=<?php echo $order['order_id']; ?>">Edit</a></td>
                <td><a class="btn btn-danger" href="delete_order.php?order_id=<?php echo $order['order_id']; ?>">Delete</a></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
</div>


<nav aria-label="page navigation example">
        <ul class="pagination mt-5">
          <li class="page-item <?php if($page_no <= 1){ echo 'disabled';} ?> "><a class="page-link" href="<?php if($page_no <= 1) { echo '#';}else{ echo "?page_no=".($page_no-1); } ?>">Prev</a></li>
          <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
          <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>
          <?php if($page_no >= 3) { ?>
            <li class="page-item"><a class="page-link" href="#">...</a></li>
            <li class="page-item"><a class="page-link" href="<?php echo "?page_no=".$page_no; ?>"><?php echo $page_no; ?></a></li>
          <?php } ?>
          <li class="page-item <?php if($page_no >= $total_no_of_pages){ echo 'disabled';} ?> "><a class="page-link" href="<?php if($page_no >= $total_no_of_pages) { echo '#';}else{ echo "?page_no=".($page_no+1); } ?>">Next</a></li>
        </ul>
       </nav>
       </div>
    </div>
</div>
</body>
</html>       