<?php include('header.php'); ?>

<div class="container-fluid">
    <div class="row">
  <div class="col-md-3 col-sm-12">
    <?php include('sidemenu.php'); ?> 
</div>
<div class="col-md-9 col-sm-12 justify-content-between flex-wrap align-items-center">
 <h2 class="text-center">Add Product</h2> <br>

 <div class="mx-auto container">
 <form id="create-form" enctype="multipart/form-data" method="POST" action="create_product.php">
            <h4 class="text-center" style="color: red;"><?php if(isset($_GET ['error'])){ echo $_GET['error'];}?></h4>
        
                <div class="form-group mt-2">
                    <label>Name</label>
                    <input type="text" class="form-control" id="product-name" name="name" placeholder="Name" required/>
                </div>
                <div class="form-group mt-2">
                    <label>Description</label>
                    <input type="text" class="form-control" id="product-desc" name="description" placeholder="Description" required/>
                </div>
                <div class="form-group mt-2">
                    <label>Price</label>
                    <input type="text" class="form-control" id="product-price" name="price" placeholder="Price" required/>
                </div>
                <div class="form-group mt-2">
                    <label>Category</label>
                    <input type="text" class="form-control" id="product-cat" name="category" placeholder="Category" required/>
                </div>
                <div class="form-group mt-2">
                    <label>Color</label>
                    <input type="text" class="form-control" id="product-color"name="color" placeholder="Color" required/>
                </div>
                <div class="form-group mt-2">
                    <label>Special offer</label>
                    <input type="text" class="form-control" id="product-offer" name="offer" placeholder="Offer" required/>
                </div>
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
                    <input type="submit" class="btn btn-primary" name="create_product" value="Create"/>
                </div>
               
            </form>



</div>
       </div>
    </div>
</div>
</body>
</html>