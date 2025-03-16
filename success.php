<?php
session_start();
unset($_SESSION['cart']);
?>
<?php include('layouts/header.php') ?>
    <!-- success message -->
    <section class="my-5 py-5 success">
        <div class="container row mx-auto">
            <div class="text-center col-lg-12 col-md-12 col-sm-12 pt-5 mt-3">
                <i class="fas fa-check-circle"></i>
                <h2 class="mt-3">Your Order has been placed successfully.</h2>
                <button class="submit-btn mt-3"><a href="../shop.php">Continue Shopping</a></button>
            </div>
        </div>
    </section>
    <?php include('layouts/footer.php') ?>