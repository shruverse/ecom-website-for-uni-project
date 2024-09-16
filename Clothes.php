<?php

include('layouts/header.php');

include('<server/connection.php');

if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
  $page_no = $_GET['page_no'];
}else{
  $page_no = 1;
}  

$stmt = $conn->prepare("SELECT COUNT(*) AS total_records FROM products WHERE product_category IN ('coats', 'clothes', 'set')");
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

$stmt1 = $conn->prepare("SELECT * FROM products WHERE product_category IN ('coats', 'clothes', 'set') LIMIT $offset,$total_records_per_page");
$stmt1->execute();
$products = $stmt1->get_result();

?>

<style>

.pagination a {
  color: blueviolet;
  font-weight: 700;
}

.pagination li:hover a{
  color: #fff;
  background-color: blueviolet;
  font-weight:700;
}
</style>


    
<!--Clothes-->
<section id="featured" class="my-5 py-5">
    <div class="container text-center mt-5 py-5">
      <h3>Clothes</h3>
      <hr class="mx-auto">
    </div>
    <div class="row mx-auto container">


    <?php while($row = $products->fetch_assoc()) { ?>


      <div onclick="window.location.href='single_product.php'" class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/products/<?php echo $row['product_image']; ?>"/>
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
        <h4 class="p-price">₹<?php echo $row['product_price']; ?></h4>
        <a style="background-color: #1d1d1d; color: #fff; font-weight: 700; padding: 10px 20px; border-radius: 5px; text-decoration: none;" href="<?php echo "single-product.php?product_id=".$row['product_id'];?>" onmouseover="this.style.backgroundColor='#8a2be2';" onmouseout="this.style.backgroundColor='#1d1d1d';">Buy Now</a>

      </div>
      <?php } ?>
    
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
  </section>

  <?php include('layouts/footer.php');?>