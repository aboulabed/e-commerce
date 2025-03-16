<?php
include('server/check_login.php');



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
if (isset($_SESSION['cart'])) {

    foreach ($_SESSION['cart'] as $product) {
        $sub_total += $product['product_price'] * $product['product_quantity'];
    }
}

$tax = Round($sub_total * 0.05, 1);
$_SESSION['total_price'] = $sub_total + $tax;
?>









<?php include('layouts/header.php'); ?>

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
            <form action="payment.php" method="POST">
                <input type="submit" name="checkout" class="checkout-btn" value="Checkout">
            </form>
        </div>
    </section>
<?php } else { ?>
    <div class="cart-error-msg my-5 py-5">
        <h1 class="text-center w-100">Your cart is empty</h1>
        <i class="fas fa-cart-plus"></i>
    </div>
<?php } ?>
<?php include('layouts/footer.php'); ?>