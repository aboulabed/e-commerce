<?php


include('server/check_login.php');

if (isset($_POST['payment'])) {
    header("Location: payment.php");
    exit(); // Ensure no further code is executed
}


?>
<?php include('layouts/header.php') ?>



<!-- Payment -->
<section class="">
    <div class="container row mx-auto">
        <div class="text-start col-lg-12 col-md-12 col-sm-12 pt-5 mt-3">

            <div class="">
                <form action="server/place-order.php" method="post">
                    <div class="w-100 d-flex gap-3">

                        <div class="checkout  col-lg-6 col-md-12 col-sm-12">
                            <h3 class="mb-5 ">Checkout</h3>
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
                        </div>

                        <hr>
                        <div class="payment  col-lg-6 col-md-12 col-sm-12">
                            <h3 class="mb-5 ">Payment</h3>

                            <div class="input-info mb-3 col-lg-12 col-md-12 col-sm-12">
                                <label for="card-name" class="form-label">Card Name</label>
                                <input name="card-name" type="text" class="form-control" id="card-name" placeholder="John Doe" required>
                            </div>
                            <div class="input-info mb-3 col-lg-12 col-md-12 col-sm-12">
                                <label for="card-number" class="form-label">Card Number</label>
                                <input name="card-number" type="number" class="form-control" id="card-number" placeholder="xxxx-xxxx-xxxx-xxxx" required>
                            </div>
                            <div class="input-info mb-3 col-lg-6 col-md-12 col-sm-12">
                                <label for="expiration-date" class="form-label">Expiration Date</label>
                                <input name="expiration-date" type="date" class="form-control" id="expiration-date" style="width: 98%;" required>
                            </div>
                            <div class="input-info mb-3 col-lg-6 col-md-12 col-sm-12">
                                <label for="cvv" class="form-label">CVV</label>
                                <input name="cvv" type="number" class="form-control" id="cvv" placeholder="xxx" required>
                            </div>

                        </div>
                    </div>
                    <div class="mb-3 mt-3 form-group w-100">
                        <p>Total: $<?php echo $_SESSION['total_price']; ?></p>
                        <button type="submit" name="pay-now" class="submit-btn w-100">Pay Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include('layouts/footer.php') ?>