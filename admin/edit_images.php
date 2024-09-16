<?php include('header.php'); ?> 

<?php

if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $product_name = $_GET['product_name'];
}else{
    header('location: products.php');
}

?>

<div class="container-fluid">
    <div class="row">
  <div class="col-md-3 col-sm-12">
    <?php include('sidemenu.php'); ?> 
</div>
<div class="col-md-9 col-sm-12 justify-content-between flex-wrap align-items-center">
 <h2 class="text-center">Edit Images</h2> <br>

<div class="mx-auto container">
 <form id="edit-image-form" enctype="multipart/form-data" method="POST" action="update_images.php">
            <h4 class="text-center" style="color: red;"><?php if(isset($_GET ['error'])){ echo $_GET['error'];}?></h4>
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                <input type="hidden" name="product_name" value="<?php echo $product_name; ?>" />
                <div class="form-group mt-2">
                    <label>Image main</label>
                    <input type="file" class="form-control" id="image1" name="image1" placeholder="Image 1" required/>
                </div>
                <div class="form-group mt-2">
                    <label>Image 2</label>
                    <input type="file" class="form-control" id="image2" name="image2" placeholder="Image 2" required/>
                </div>
                <div class="form-group mt-2">
                    <label>Image 3</label>
                    <input type="file" class="form-control" id="image3" name="image3" placeholder="Image 3" required/>
                </div>
                <div class="form-group mt-2">
                    <label>Image 4</label>
                    <input type="file" class="form-control" id="image4" name="image4" placeholder="Image 4" required/>
                </div>
                <div class="form-group mt-3">
                    <input type="submit" class="btn btn-primary" name="update_images" value="Edit"/>
                </div>
               
            </form>



</div>
       </div>
    </div>
</div>
</body>
</html>