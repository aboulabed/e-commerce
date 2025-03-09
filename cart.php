<?php

// Start or resume a session to store cart data
session_start();

// Check if the 'add_to_cart' form has been submitted
if (isset($_POST['add_to_cart'])) {

    // Check if the 'cart' session variable already exists
    if (isset($_SESSION['cart'])) {

        // Extract all product IDs from the cart into an array
        $products_array_ids = array_column($_SESSION['cart'], 'product_id');

        // Check if the product being added is already in the cart
        if (!in_array($_POST['product_id'], $products_array_ids)) {

            // If the product is not in the cart, create an array with its details
            $product_array = array(
                'product_id' => $_POST['product_id'],         // Product ID from the form
                'product_name' => $_POST['product_name'],     // Product name from the form
                'product_price' => $_POST['product_price'],   // Product price from the form
                'product_image' => $_POST['product_image'],   // Product image from the form
                'product_quantity' => $_POST['product_quantity'], // Product quantity from the form
            );

            // Add the product array to the cart session, using the product ID as the key
            $_SESSION['cart'][$_POST['product_id']] = $product_array;
            header("Location: cart.php");
            exit(); // Ensure no further code is executed
        } else {
            // If the product is already in the cart, show an alert message
            $_SESSION['cart'][$_POST['product_id']]['product_quantity'] += $_POST['product_quantity'];
            header("Location: cart.php");
            exit(); // Ensure no further code is executed
        }
    } else {
        // If the 'cart' session variable doesn't exist, initialize it as an empty array
        $_SESSION['cart'] = array();

        // Create an array with the product details
        $product_array = array(
            'product_id' => $_POST['product_id'],         // Product ID from the form
            'product_name' => $_POST['product_name'],     // Product name from the form
            'product_price' => $_POST['product_price'],   // Product price from the form
            'product_image' => $_POST['product_image'],   // Product image from the form
            'product_quantity' => $_POST['product_quantity'], // Product quantity from the form
        );

        // Add the product array to the cart session, using the product ID as the key
        $_SESSION['cart'][$_POST['product_id']] = $product_array;
        header("Location: cart.php");
        exit(); // Ensure no further code is executed
    }
} else if (isset($_POST['remove_from_cart'])) {

    // Check if the 'remove_from_cart' form has been submitted
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
    header("Location: cart.php");
    exit(); // Ensure no further code is executed
} else if (isset($_POST['edit_quantity'])) {

    // Check if the 'edit_quantity' form has been submitted
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];
    $_SESSION['cart'][$product_id]['product_quantity'] = $product_quantity;
    header("Location: cart.php");
    exit(); // Ensure no further code is executed
}
$sub_total = 0;
foreach ($_SESSION['cart'] as $product) {
    $sub_total += $product['product_price'] * $product['product_quantity'];
}

$tax = Round($sub_total * 0.05, 1);
$_SESSION['total_price'] = $sub_total + $tax;
?>









<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-white  fixed-top shadow py-3">
        <div class="container">
            <img src="assets/imgs/logo.png" class="logo" alt="">
            <h2>FASHION</h2>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="shop.php">Shop</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact-us.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="cart.php"><i class="fas fa-shopping-cart active" style="color:#212529 
"></i></a>

                        <a href="account.php"><i class="fas fa-user" style="color:#212529"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php if (!empty($_SESSION['cart'])) { ?>
        <section class="cart my-5 py-5 container">
            <div class="container mt-5">
                <h2 class="font-weight-bold">Your Cart</h2>
                <hr>
            </div>
            <table class="mt-5 pt-5">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $product) { ?>
                        <tr>
                            <td>
                                <div class="product-info">
                                    <img src="assets/imgs/<?php echo $product['product_image']; ?>" alt="" class="img-fluid">
                                    <div>
                                        <p><?php echo $product['product_name']; ?></p>
                                        <small><span>$</span><?php echo $product['product_price']; ?></small>
                                        <form action="cart.php" method="POST">
                                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                            <input type="submit" name="remove_from_cart" class="remove-btn" value="Remove">
                                        </form>

                                    </div>
                                </div>
                            </td>
                            <td>
                                <form action="cart.php" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    <input type="number" name="product_quantity" value="<?php echo $product['product_quantity']; ?>" min="1">
                                    <input type="submit" name="edit_quantity" class="edit-btn" value="Edit">
                                </form>
                            </td>
                            <td>
                                <span>$</span>
                                <span class="product-price"><?php echo $product['product_price'] * $product['product_quantity']; ?></span>

                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
            <div class="total-price">
                <table>
                    <tr>
                        <td>Subtotal</td>
                        <td>$<?php echo $sub_total; ?></td>
                    </tr>
                    <tr>
                        <td>Tax</td>
                        <td>$<?php echo $tax; ?></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>$<?php echo $_SESSION['total_price']; ?></td>
                    </tr>
                </table>
            </div>
            <div class="checkout-div">
                <form action="checkout.php" method="POST">
                    <input type="submit" name="checkout" class="checkout-btn" value="Checkout">
                </form>
            </div>
        </section>
    <?php } else {?>
        <div class="cart-error-msg my-5 py-5">
            <h1 class="text-center w-100">Your cart is empty</h1>
            <i class="fas fa-cart-plus"></i>
        </div>
    <?php } ?>
    <!-- Footer -->
    <footer class="mt-5 py-5">
        <div class="row container mx-auto pt-5">
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <img src="assets/imgs/logo.png" class="img-fluid logo">
                <p class="pt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</p>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Featured</h5>
                <ul class="text-uppercase">
                    <li><a href="#">men</a></li>
                    <li><a href="#">women</a></li>
                    <li><a href="#">boys</a></li>
                    <li><a href="#">girls</a></li>
                    <li><a href="#">new arrivals</a></li>
                    <li><a href="#">shoes</a></li>
                    <li><a href="#">clothes</a></li>
                </ul>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Contact Us</h5>
                <div>
                    <h6 class="text-uppercase">Address</h6>
                    <p>123, Main Street, Your City</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Phone</h6>
                    <p>(123) 456-7890</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Email</h6>
                    <p>2nVtZ@example.com</p>
                </div>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Instagram</h5>
                <div class="row">
                    <img src="assets/imgs/bag-1.jpg" alt="" class="img-fluid instagram  m-2">
                    <img src="assets/imgs/bag-1.jpg" alt="" class="img-fluid instagram  m-2">
                    <img src="assets/imgs/bag-1.jpg" alt="" class="img-fluid instagram  m-2">
                    <img src="assets/imgs/bag-1.jpg" alt="" class="img-fluid instagram  m-2">
                    <img src="assets/imgs/bag-1.jpg" alt="" class="img-fluid instagram  m-2">
                </div>
            </div>
        </div>
        <div class="copyright mt-5">
            <div class="row container mx-auto">
                <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                    <img src="assets/imgs/visa.png" alt="" class="img-fluid">
                    <img src="assets/imgs/card.png" alt="" class="img-fluid">
                    <img src="assets/imgs/paypal.png" alt="" class="img-fluid">
                </div>
                <div class="col-lg-4 col-md-5 col-sm-12 text-nowrap mb-2">
                    <p>Copyright ©2025 All Rights Reserved</p>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-12">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
        crossorigin="anonymous"></script>

</body>

</html>