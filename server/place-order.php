<?php
include('server/connection.php');
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
    $order_status = 'pending';
    $user_id = 1;
    $user_address = $country . ', ' . $city . ', ' . $zip_code;
    $order_date = date('Y-m-d H:i:s');

    $conn->prepare('INSERT INTO `orders`( `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`)
    VALUES (?,?,?,?,?,?,?)')->execute([$order_cost, $order_status, $user_id, $phone_number, $city, $user_address, $order_date]);
    $order_id = $conn->insert_id;
    echo $order_id;
}
