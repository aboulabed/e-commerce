<?php

include("connection.php");
$stmt = $conn->prepare("SELECT DISTINCT product_category FROM products ");
$stmt->execute();

$products_category = $stmt->get_result();
$data = $products_category->fetch_all(MYSQLI_ASSOC);
