<?php

include('layouts/header.php');

include('server/connection.php');

if(isset($_GET['product_id'])){

$product_id = $_GET['product_id'];

  $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
  $stmt->bind_param("i",$product_id);

  $stmt->execute();
  
  $product = $stmt->get_result();

}else{

  header('location: index.php');

}

?>


<section class="container single-product my-5 pt-5">
    <div class="row mt-5">

    <?php while($row = $product->fetch_assoc()){ ?>

      



        <div class="col-lg-5 col-md-6 col-sm-12">
            <img class="img-fluid w-100 pb-1" id="mainImg" src="assets/imgs/products/<?php echo $row['product_image']; ?>"/>
            <div class="small-img-group">
                <div class="small-img-col">
                    <img src="assets/imgs/products/<?php echo $row['product_image']; ?>" width="100%" class="small-img"/>
                </div>
                <div class="small-img-col">
                    <img src="assets/imgs/products/<?php echo $row['product_image2']; ?>" width="100%" class="small-img"/>
                </div>
                <div class="small-img-col">
                    <img src="assets/imgs/products/<?php echo $row['product_image2']; ?>" width="100%" class="small-img"/>
                </div>
                <div class="small-img-col">
                    <img src="assets/imgs/products/<?php echo $row['product_image4']; ?>" width="100%" class="small-img"/>
                </div>
            </div>
        </div>

      

<div class="col-lg-6 col-md-12 col-sm-12">
    <h6>Products/Clothes</h6>
    <h3 class="py-4"><?php echo $row['product_name']; ?></h3>
    <h2>₹<?php echo $row['product_price']; ?></h2>
    
    <form method="POST" action="cart.php">
        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>" />
        <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>" />
        <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>" />
        <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>" />
    
    <input type="number" name="product_quantity" value="1"/>

    <button class="buy-btn" type="submit" name="add_to_cart">Add to Cart</button>

    </form>

    
    <h4 class="mt-5 mb-5">Product details</h4>
    <span><?php echo $row['product_description']; ?></span>
</div>

      <?php } ?>

 </div>
</section>

<!--Related products-->
<section id="featured" class="my-5">
    <div class="container text-center mt-5 py-5">
      <h3>Related Products</h3>
      <hr class="mx-auto">
    </div>
    <div class="row mx-auto container-fluid">
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/products/16466246576d16098d92a3b7d15d6ec28ba4a388b9_thumbnail_750x.webp"/>
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Mint Sweatshirt Plain</h5>
            <h4 class="p-price">₹750</h4>
            <button class="buy-btn">Buy Now</button>
          </div>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/products/16617649116d853f2e9e1510662314144037a4076f_thumbnail_600x.jpg"/>
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name">Knit pattern Long sleeve Black Sweater</h5>
        <h4 class="p-price">₹900</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/products/4cf93947c172b1ec6afa6ca31a70c441.jpg"/>
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name">Long sleeve Black plain Sweater</h5>
        <h4 class="p-price">₹550</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/products/44b9a6e8ebe17e169cd9a6de43e4d577.jpg"/>
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name">Oversized multicolor dark Hoodie</h5>
        <h4 class="p-price">₹600</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
    </div>
  </section>


           
        
           
        <script>
            var mainImg = document.getElementById("mainImg");
            var smallImg = document.getElementsByClassName("small-img");
            
            for(let i=0; i<4; i++){
                smallImg[i].onclick = function(){
                mainImg.src = smallImg[i].src;
            }
            }

            
        </script>
    
    <?php include('layouts/footer.php');?>