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
  
  $stmt = $conn->prepare("SELECT COUNT(*) AS total_records FROM products");
  $stmt->execute();
  $stmt->bind_result($total_records);
  $stmt->store_result();
  $stmt->fetch();
  
  $total_records_per_page = 10;
  $offset = ($page_no-1) * $total_records_per_page;
  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;
  $adjacents = "2";
  $total_no_of_pages = ceil($total_records/$total_records_per_page);
  
  $stmt1 = $conn->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");
  $stmt1->execute();
  $products = $stmt1->get_result();
  
?>

 

<div class="container-fluid">
    <div class="row">
  <div class="col-md-3">
    <?php include('sidemenu.php'); ?> 
</div>
<div class="col-md-9 justify-content-between flex-wrap align-items-center">
 <h2 class="text-center">Products</h2>

 <?php if(isset($_GET['edit_success_message'])){ ?>
    <h4 class="text-center" style="color: green;"><?php echo $_GET['edit_success_message']; ?></h4>
 <?php } ?>
 <?php if(isset($_GET['edit_failure_message'])){ ?>
    <h4 class="text-center" style="color: red;"><?php echo $_GET['edit_failure_message']; ?></h4>
 <?php } ?>
 <?php if(isset($_GET['deleted_successfully'])){ ?>
    <h4 class="text-center" style="color: green;"><?php echo $_GET['deleted_successfully']; ?></h4>
 <?php } ?>
 <?php if(isset($_GET['delete_failure'])){ ?>
    <h4 class="text-center" style="color: red;"><?php echo $_GET['delete_failure']; ?></h4>
 <?php } ?>
 <?php if(isset($_GET['product_created'])){ ?>
    <h4 class="text-center" style="color: green;"><?php echo $_GET['product_created']; ?></h4>
 <?php } ?>
 <?php if(isset($_GET['product_failed'])){ ?>
    <h4 class="text-center" style="color: red;"><?php echo $_GET['product_failed']; ?></h4>
 <?php } ?>
 <?php if(isset($_GET['images_updated'])){ ?>
    <h4 class="text-center" style="color: green;"><?php echo $_GET['images_updated']; ?></h4>
 <?php } ?>
 <?php if(isset($_GET['images_failed'])){ ?>
    <h4 class="text-center" style="color: red;"><?php echo $_GET['images_failed']; ?></h4>
 <?php } ?>

    <div class="table-responsive">
        <table class="table table-striped table-sn">
            <thead>
                <tr>
                    <th scope="col">Product Id</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Price</th>
                    <th scope="col">Product Offer</th>
                    <th scope="col">Product Category</th>
                    <th scope="col">Product Color</th>
                    <th scope="col">Edit Images</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product){ ?>
            <tr>
                <td><?php echo $product['product_id']; ?></td>
                <td><img src="<?php echo "../assets/imgs/products/".$product['product_image']; ?>" style="width: 70px; height: auto;"/></td>
                <td><?php echo $product['product_name']; ?></td>
                <td><?php echo "₹".$product['product_price']; ?></td>
                <td><?php echo $product['product_special_offer']."%"; ?></td>
                <td><?php echo $product['product_category']; ?></td>
                <td><?php echo $product['product_color']; ?></td>
                <td><a class="btn btn-primary" href="<?php echo "edit_images.php?product_id=".$product['product_id']."&product_name=".$product['product_name']; ?>">Edit Images</a></td>
                <td><a class="btn btn-primary" href="edit_product.php?product_id=<?php echo $product['product_id']; ?>">Edit</a></td>
                <td><a class="btn btn-danger" href="delete_product.php?product_id=<?php echo $product['product_id']; ?>">Delete</a></td>
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