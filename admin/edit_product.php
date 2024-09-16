<?php include('header.php'); ?>

<?php  

if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id=? ");
    $stmt->bind_param('i',$product_id);
    $stmt->execute();
    $products = $stmt->get_result();
}else if(isset($_POST['edit_product'])){
    $product_id = $_POST['product_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $color = $_POST['color'];
    $offer = $_POST['offer'];
    $stmt = $conn->prepare("UPDATE products SET product_name=?, product_description=?, product_price=?, product_category=?, product_color=?, product_special_offer=? WHERE product_id=?");
    $stmt->bind_param('ssssssi',$title,$description,$price,$category,$color,$offer,$product_id);
    if($stmt->execute()){
    header('location: products.php?edit_success_message=Product updated successfully');
    }else{
    header('location: products.php?edit_failure_message=Something went wrong, try again');    
    }
}else{    
    header('location: products.php');
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
    
 <div class="mx-auto container">
 <form id="edit-form" method="POST" action="edit_product.php">
            <h4 class="text-center" style="color: red;"><?php if(isset($_GET ['error'])){ echo $_GET['error'];}?></h4>
              <?php foreach($products as $product){ ?>
                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>" />
                <div class="form-group mt-2">
                    <label>Name</label>
                    <input type="text" class="form-control" id="product-name" value="<?php echo $product['product_name'] ?>" name="title" placeholder="Name" required/>
                </div>
                <div class="form-group mt-2">
                    <label>Description</label>
                    <input type="text" class="form-control" id="product-desc" value="<?php echo $product['product_description'] ?>" name="description" placeholder="Description" required/>
                </div>
                <div class="form-group mt-2">
                    <label>Price</label>
                    <input type="text" class="form-control" id="product-price" value="<?php echo $product['product_price'] ?>" name="price" placeholder="Price" required/>
                </div>
                <div class="form-group mt-2">
                    <label>Category</label>
                    <input type="text" class="form-control" id="product-cat" value="<?php echo $product['product_category'] ?>" name="category" placeholder="Category" required/>
                </div>
                <div class="form-group mt-2">
                    <label>Color</label>
                    <input type="text" class="form-control" id="product-color" value="<?php echo $product['product_color'] ?>" name="color" placeholder="Color" required/>
                </div>
                <div class="form-group mt-2">
                    <label>Special offer</label>
                    <input type="text" class="form-control" id="product-offer" value="<?php echo $product['product_special_offer'] ?>" name="offer" placeholder="Offer" required/>
                </div>
                <div class="form-group mt-3">
                    <input type="submit" class="btn btn-primary" name="edit_product" value="Edit"/>
                </div>
                <?php } ?>
            </form>



</div>
       </div>
    </div>
</div>
</body>
</html>       