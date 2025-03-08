<?php
include('connection.php');
session_start();
if (isset($_POST['place-order'])) {
  // get user info
  $name = $_POST['name'];
  $second_name = $_POST['second-name'];
  $phone_number = $_POST['phone-number'];
  $zip_code = $_POST['zip-code'];
  $country = $_POST['country'];
  $city = $_POST['city'];
  $order_cost = $_SESSION['total_price'];
  $user_id = $_SESSION['user_id'];
  $user_address = $country . ', ' . $city . ', ' . $zip_code;

  $conn->prepare('INSERT INTO `orders`( `order_cost`,  `user_id`, `user_phone`, `user_city`, `user_address`)
    VALUES (?,?,?,?,?)')->execute([$order_cost,  $user_id, $phone_number, $city, $user_address]);
  $order_id = $conn->insert_id;
  // get products from session and insert into order_items
  foreach ($_SESSION['cart'] as $product) {
    $product_id = $product['product_id'];
    $product_name = $product['product_name'];
    $product_image = $product['product_image'];
    $product_price = $product['product_price'];
    $product_quantity = $product['product_quantity'];
    $conn->prepare("INSERT INTO 
          `order_items`(`order_id`, `product_id`,
                        `product_name`, `product_image`, `user_id`,
                        `product_price`, `product_quantity`) VALUES
          (?,?,?,?,?,?,?)")->execute(
      [
        $order_id,
        $product_id,
        $product_name,
        $product_image,
        $user_id,
        $product_price,
        $product_quantity
      ]
    );
  }
  header("Location: payment.php?order_id=$order_id");
  exit();
}
