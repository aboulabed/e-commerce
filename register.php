<?php
include('server/connection.php');
session_start();

// Redirect if the user is already logged in
if (isset($_SESSION['user_name'])) {
    echo "<script>window.location.href='account.php'</script>";
    exit(); // Stop further execution
}

// Handle registration form submission
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rePassword = $_POST['rePassword'];

    // Validate password
    if ($password != $rePassword) {
        echo "<script>alert('Password does not match');</script>";
    } else if (strlen($password) < 8) {
        echo "<script>alert('Password must be at least 8 characters long');</script>";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT * FROM `users` WHERE `user_email` = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result(); // Store the result set

        if ($stmt->num_rows > 0) {
            echo "<script>alert('Email already exists');</script>";
        } else {
            // Insert new user into the database
            $hashedPassword = md5($password); // Hash the password (consider using password_hash() instead)
            $insertStmt = $conn->prepare("INSERT INTO `users` (`user_name`, `user_email`, `user_password`) VALUES (?, ?, ?)");
            $insertStmt->bind_param("sss", $name, $email, $hashedPassword);

            if ($insertStmt->execute()) {
                echo "<script>window.location.href='login.php';</script>";
                exit(); // Stop further execution
            } else {
                echo "<script>alert('Registration failed. Please try again.');</script>";
            }

            $insertStmt->close(); // Close the insert statement
        }

        $stmt->close(); // Close the select statement
    }
}
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
                        <a href="cart.php"><i class="fas fa-shopping-cart" style="color:#212529"></i></a>

                        <a href="account.php"><i class="fas fa-user" style="color:#212529"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Login -->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="font-weight-bold">Create New Account</h2>
            <hr class="mx-auto">
        </div>
        <div class="container mx-auto">
            <form id="register-form" action="register.php" method="POST">
                <div class="mb-3 form-group">
                    <label for="Inputname1" class="form-label">Name</label>
                    <input name="name" type="text" class="form-control" id="Inputname1" placeholder="Enter your name"
                        required>
                </div>
                <div class="mb-3 form-group">
                    <label for="InputEmail1" class="form-label">Email address</label>
                    <input name="email" type="email" class="form-control" id="InputEmail1"
                        placeholder="Enter your email" required>
                </div>
                <div class="mb-3 form-group">
                    <label for="InputPassword1" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="InputPassword1"
                        placeholder="Enter your password" required>
                </div>
                <div class="mb-3 form-group">
                    <label for="InputPassword2" class="form-label">Repeat Password</label>
                    <input name="rePassword" type="password" class="form-control" id="InputPassword2"
                        placeholder="Enter your password" required>
                </div>
                <div class="mb-3 form-group">
                    <button type="submit" class="submit-btn" name="register">Submit</button>
                </div>
                <div class="form-group">
                    <span class="fw-light pe-1">Already have an account?</span><a href="login.php" class="btn p-0">
                        Login</a>
                </div>
            </form>
        </div>
    </section>
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
                    <p>2nVtZ@.com</p>
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