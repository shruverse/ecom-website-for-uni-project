<?php

include('layouts/header.php');

include('server/connection.php');

if(isset($_POST['order_details_btn'], $_POST['order_id'])){
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status']; 

    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id=?");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $order_details = $stmt->get_result();
    $order_total_price = calculateTotalOrderPrice($order_details);



} else {
    header('Location: account.php');
    exit;
}

function calculateTotalOrderPrice($order_details){

  $total = 0;

  foreach($order_details as $row){ 

    $product_price = $row['product_price'];
    $product_quantity = $row['product_quantity'];
    $total = $total + ($product_price * $product_quantity);


  }

  return $total;

}
?>



      <!--Orders-->
      <section id="orders" class="orders container my-5 py-3">
        <div class="container mt-5">
            <h2 class="font-weight-bold text-center">Order details</h2>
            <hr class="mx-auto">
        </div>

        <table class="mt-5 pt-5 mx-auto">
            <tr>
                <th style="text-align: center;">Product</th>
                <th style="text-align: center;">Product price</th>
                <th style="text-align: center;">Quantity</th>
                
            </tr>
            <?php foreach($order_details as $row){ ?>
           <tr>
                <td style="text-align: center;">
                  <div class="product-info">
                    <img src="assets/imgs/products/<?php echo $row['product_image']; ?>" />
                    <div>
                        <h5 class="mt-3"><?php echo $row['product_name']; ?></h5>
                    </div>
                  </div> 
                 
                </td>
        
                <td style="text-align: center;">
                  <h5>₹<?php echo $row['product_price']; ?></h5>
                </td>

                <td style="text-align: center;">
                  <h5><?php echo $row['product_quantity']; ?></h5>
                </td>
              

            
            </tr>
       <?php } ?>
        </table>
          
        <?php if($order_status == "not paid"){ ?>

            <form method="POST" action="payment.php">
              <input type="hidden" name="order_id" value="<?php echo $order_id; ?>"/>
              <input type="hidden" name="order_total_price" value="<?php echo $order_total_price; ?>"/>
              <input type="hidden" name="order_status" value="<?php echo $order_status; ?>"/>
              <input style="float: right; background-color: blueviolet; color: #fff; font-weight: 700;" class="btn" type="submit" name="order_pay_btn" value="Pay Now" />
            </form>    
           
        <?php } ?>



      </section> 





      <?php include('layouts/footer.php');?>