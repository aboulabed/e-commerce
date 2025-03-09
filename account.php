<?php
include('server/connection.php');
session_start();

// Redirect to login if the user is not logged in
if (!isset($_SESSION['user_name'])) {
    echo "<script>window.location.href='login.php';</script>";
    exit(); // Stop further execution
}

// Extract first name and last name from session
$name = explode(" ", $_SESSION['user_name']);
$firstName = $name[0];
$lastName = (count($name) > 1) ? $name[1] : ''; // Set last name if it exists
$email = $_SESSION['user_email'];

// Handle logout
if (isset($_GET['logout'])) {
    session_unset(); // Clear all session variables
    session_destroy(); // Destroy the session
    echo "<script>window.location.href='login.php';</script>";
    exit(); // Stop further execution
}

// Handle profile update
if (isset($_POST['update'])) {
    $name = trim($_POST['name']);
    $lastName = trim($_POST['lastName']);
    $fullName = $name . " " . $lastName;
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (strlen($password) < 8) {
        echo "<script>alert('Please enter valid details');</script>";
    } else {
        // Hash the password (consider using password_hash() instead of md5)
        $hashedPassword = md5($password);

        // Debugging: Print the query and parameters
        echo "<script>console.log('Updating profile with:', '" . $name . "', '" . $email . "', '" . $hashedPassword . "');</script>";

        // Update user details in the database
        $stmt = $conn->prepare("UPDATE `users` SET `user_name`=?, `user_email`=?, `user_password`=? WHERE `user_email`=?");
        if ($stmt) {
            $stmt->bind_param("ssss", $fullName, $email, $hashedPassword, $_SESSION['user_email']);

            if ($stmt->execute()) {
                echo "<script>alert('Profile updated successfully');</script>";
            } else {
                echo "<script>alert('Failed to update profile: " . $stmt->error . "');</script>";
            }

            $stmt->close(); // Close the statement
        } else {
            echo "<script>alert('Database error: Unable to prepare statement');</script>";
        }
    }
    $_SESSION['user_name'] = $fullName;
    $_SESSION['user_email'] = $email;
    header("Location: account.php");
    exit();
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
                        <a href="account.php"><i class="fas fa-user active" style="color:#212529"></i></a>

                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- account -->
    <section class="my-5 py-5">
        <div class="container row mx-auto">
            <div class="logout mb-3 text-end ">
                <button style="padding: 13px 23px;">

                    <i class="fas fa-sign-out-alt "></i>
                    <a href="account.php?logout=1" class="ms-2">Logout</a>
                </button>
            </div>
            <div class="text-start col-lg-12 col-md-12 col-sm-12 pt-5 mt-3">
                <h3 class="font-weight-bold mb-4">Account Details</h3>

                <div class="account-info">
                    <form action="account.php" method="POST" id="account">
                        <div class="input-info mb-3">
                            <label for="name" class="form-label">First Name</label>
                            <input name="name" type="text" class="form-control" id="name" value="<?php echo $firstName ?>" required>
                        </div>
                        <?php if (isset($lastName)) { ?>
                            <div class="input-info mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input name="lastName" type="text" class="form-control" id="lastName" value="<?php echo $lastName ?>"
                                    required>
                            </div>
                        <?php } ?>
                        <div class="input-info mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" id="email" value="<?php echo $email ?>"
                                required>
                        </div>
                        <div class="input-info mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input name="password" type="text" class="form-control" id="password" placeholder="Change Password"
                                required>
                        </div>
                        <div class="mb-3 form-group">
                            <button type="submit" class="submit-btn" name="update">Update</button>
                        </div>
                    </form>

                </div>
            </div>
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