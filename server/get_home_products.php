<?php
include("connection.php");
$stmt = $conn->prepare("WITH RankedProducts AS (
    SELECT 
        product_id, product_name, product_category,product_image,product_price,
        ROW_NUMBER() OVER (PARTITION BY product_category ORDER BY product_id) AS row_num
    FROM products
)
SELECT product_id, product_name, product_category,product_image,product_price
FROM RankedProducts
WHERE row_num <= 4;");

$stmt->execute();

$home_products = $stmt->get_result();
$home_products->fetch_all(MYSQLI_ASSOC);