<?php include('layouts/header.php');
include('server/check_login.php');
?>

<!-- Single Product -->
<?php
$parts = explode("=", $_SERVER["QUERY_STRING"]);
$product_id = $parts[1];
?>
<?php

include("server/connection.php");
$stmt = $conn->prepare("SELECT * FROM products WHERE product_id=$product_id");
$stmt->execute();

$single_product = $stmt->get_result();
?>

<?php while ($row = $single_product->fetch_assoc()) { ?>
  <div class="container single-product my-5 pt-5">
    <div class="row mt-5 justify-content-around">
      <div class="col-lg-5 col-md-6 col-sm-12">
        <img src="assets/imgs/<?php echo $row["product_image"]; ?>" class="img-fluid w-100 pb-3" id="main-img" alt="">
        <div class="small-img-row">
          <div class="small-img-col">
            <img src="assets/imgs/<?php echo $row["product_image"]; ?>" class="img-fluid w-100 small-img" alt="">
          </div>
          <div class="small-img-col">
            <img src="assets/imgs/<?php echo $row["product_image"]; ?>" class="img-fluid w-100 small-img" alt="">
          </div>
          <div class="small-img-col">
            <img src="assets/imgs/<?php echo $row["product_image"]; ?>" class="img-fluid w-100 small-img" alt="">
          </div>
          <div class="small-img-col">
            <img src="assets/imgs/<?php echo $row["product_image"]; ?>" class="img-fluid w-100 small-img" alt="">
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-12">
        <h6>Home/<?php echo $row["product_category"]; ?></h6>
        <h3 class="py-4"><?php echo $row["product_name"]; ?></h3>
        <h2>$<?php echo $row["product_price"]; ?></h2>
        <form action="cart.php" method="POST">
          <input type="hidden" name="product_id" value="<?php echo $row["product_id"]; ?>">
          <input type="hidden" name="product_image" value="<?php echo $row["product_image"]; ?>">
          <input type="hidden" name="product_name" value="<?php echo $row["product_name"]; ?>">
          <input type="hidden" name="product_price" value="<?php echo $row["product_price"]; ?>">
          <input class="mx-1" name="product_quantity" type="number" value="1" />
          <button class="buy-btn" name="add_to_cart" type="submit">Add To Cart</button>
        </form>
        <h4 class="my-5">Product Details</h4>
        <span><?php echo $row["product_description"]; ?></span>

      </div>
    </div>
  </div>
<?php } ?>

<?php include('layouts/footer.php'); ?>