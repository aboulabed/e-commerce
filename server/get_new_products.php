<?php

include("connection.php");
$stmt = $conn->prepare("SELECT * FROM products ORDER BY RAND() LIMIT 3");
$stmt->execute();

$new_products = $stmt->get_result();
