<?php include('layouts/header.php'); ?>


<!--Home-->
<section id="home">
    <div class="container">
        <h5>NEW ARRIVALS</h5>
        <h1><span>Best Prices</span> This Summer</h1>
        <p>MOON offers the best products for affordable prices</p>
        <a href="Clothes.php"><button>SHOP NOW</button></a>
    </div>
</section>

<!--New-->
<section id="new" class="w-100">
  <div class="row p-0 m-0">
    <!--one-->
    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img class="img-fluid" src="assets/imgs/products/1626762330aa65669137fd1cba5a0320b141cd7970_thumbnail_600x.webp"/>
      <div class="details">
        <h2>Winter Collection</h2>
        <a href="Clothes.php"><button class="text-uppercase">Shop Now</button></a>
      </div>
    </div>
    <!--two-->
    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img class="img-fluid" src="assets/imgs/products/e5613a72c01705fc6c0ee5b6fd928b19.jpg"/>
      <div class="details">
        <h2>Trendy Jewellery</h2>
        <a href="jewellery.php"><button class="text-uppercase">Shop Now</button></a>
      </div>
    </div>
    <!--three-->
    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img class="img-fluid" src="assets/imgs/products/a7ed52060e0d4f1b662dbe46c3d010ed.jpg"/>
      <div class="details">
        <h2>Office Collection</h2>
        <a href="Accessories.php"><button class="text-uppercase">Shop Now</button></a>
      </div>
    </div>
  </div>
</section>

<!--Featured-->
<section id="featured" class="my-5 pb5">
  <div class="container text-center mt-5 py-5">
    <h3>Our Featured Products</h3>
    <hr class="mx-auto">
    <p>Check out featured products of this month</p>
  </div>
  <div class="row mx-auto container-fluid">
    
<?php include('server/get_featured_products.php'); ?>

<?php while($row= $featured_products->fetch_assoc()){ ?>

    <div onclick="window.location.href='single-product.html';" class="product text-center col-lg-3 col-md-4 col-sm-12">
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
      <a href="<?php echo "single-product.php?product_id=", $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
    </div>
    
<?php } ?>

  </div>
</section>

<!--Banner-->
<section id="banner" class="my-5 py-5">
  <div class="container">
    <h4>CHECK OUT NOW!</h4>
    <h1>50% OFF<br>On Winter Clothes</h1>
    <a href="Clothes.php"><button class="text-uppercase">Shop now</button></a>
  </div>
</section>

<!--Sweaters and jackets-->
<section id="featured" class="my-5">
  <div class="container text-center mt-5 py-5">
    <h3>Sweaters and Jackets</h3>
    <hr class="mx-auto">
    <p>Trendy Sweaters, Hoodies, Jackets, Coats and more</p>
  </div>
  <div class="row mx-auto container-fluid">

  <?php include('server/get_coats.php'); ?>

<?php while($row=$coats_products->fetch_assoc()){ ?>

    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
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
      <a href="<?php echo "single-product.php?product_id=", $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
    </div>
    
<?php } ?>

  </div>
</section>

<!--Combo-->
<section id="featured" class="my-5">
  <div class="container text-center mt-5 py-5">
    <h3>Casual Outfit Sets</h3>
    <hr class="mx-auto">
    <p>Picked and Matched Outfit sets and combos</p>
  </div>
  <div class="row mx-auto container-fluid">

  <?php include('server/get_sets.php'); ?>
  <?php while($row=$sets->fetch_assoc()){ ?>

    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
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
      <a href="<?php echo "single-product.php?product_id=", $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
    </div>
    <?php } ?>
  </div>
</section>

<!--Bags-->
<section id="featured" class="my-5">
  <div class="container text-center mt-5 py-5">
    <h3>Handbags and more</h3>
    <hr class="mx-auto">
    <p>Carry stuff with style</p>
  </div>
  <div class="row mx-auto container-fluid">
  
  <?php include('server/get_bags.php'); ?>
  <?php while($row=$main_bag->fetch_assoc()){ ?>

    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
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
      <a href="<?php echo "single-product.php?product_id=", $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
    </div>
    <?php } ?>
  </div>
</section>

  <?php include('layouts/footer.php'); ?>   