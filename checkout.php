<?php
include('server/check_login.php');

if (isset($_POST['checkout'])) {
    header("Location: checkout.php");
    exit(); // Ensure no further code is executed
}
?>

<?php include('layouts/header.php'); ?>

<!-- Checkout -->
<section class="my-5 py-5">
    <div class="container row mx-auto">
        <div class="text-start col-lg-12 col-md-12 col-sm-12 pt-5 mt-3">

            <h3 class="font-weight-bold mb-4">Checkout</h3>
            <div class="checkout">
                <form action="server/place-order.php" method="POST" id="checkout-form" class="">
                    <div class="input-info mb-3 col-lg-6 col-md-12 col-sm-12">
                        <label for="name" class="form-label">First Name</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Joe" required>
                    </div>

                    <div class="input-info mb-3 col-lg-6 col-md-12 col-sm-12">
                        <label for="second-name" class="form-label">Second Name</label>
                        <input name="second-name" type="text" class="form-control" id="second-name"
                            placeholder="Doe" required>
                    </div>
                    <div class="input-info mb-3 col-lg-6 col-md-12 col-sm-12">
                        <label for="city" class="form-label">City</label>
                        <input name="city" type="text" class="form-control" id="city" placeholder="City" required>
                    </div>
                    <div class="input-info mb-3 col-lg-6 col-md-12 col-sm-12">
                        <label for="zip-code" class="form-label">Zip Code</label>
                        <input name="zip-code" type="number" class="form-control" id="zip-code" placeholder="00-000"
                            required>
                    </div>
                    <div class="input-info mb-3 col-lg-6 col-md-12 col-sm-12">
                        <label for="country" class="form-label">Country</label>
                        <input name="country" type="text" class="form-control" id="country" placeholder="Country"
                            required>
                    </div>
                    <div class="input-info mb-3 col-lg-6 col-md-12 col-sm-12">
                        <label for="phone-number" class="form-label">Phone Number</label>
                        <input name="phone-number" type="tel" class="form-control" id="phone-number"
                            placeholder="123456789" required>
                    </div>
                    <div class="mb-3 mt-3 form-group">
                        <p>Total: $<?php echo $_SESSION['total_price']; ?></p>
                        <button type="submit" name="place-order" class="submit-btn">Checkout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php include('layouts/footer.php'); ?>