<?php
include('server/connection.php');
session_start();

// Redirect if the user is already logged in
if (isset($_SESSION['user_name'])) {
    echo "<script>window.location.href='account.php';</script>";
    exit(); // Stop further execution
}

// Handle login form submission
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user from the database
    $stmt = $conn->prepare("SELECT * FROM `users` WHERE `user_email` = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password (using md5 for now, but consider password_verify() for secure hashing)
        if (md5($password) === $user['user_password']) {
            // Set session variables
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_email'] = $user['user_email'];

            // Redirect to account page
            echo "<script>window.location.href='account.php';</script>";
            exit(); // Stop further execution
        } else {
            echo "<script>alert('Incorrect password');</script>";
        }
    } else {
        echo "<script>alert('Email not found');</script>";
    }

    // Close the statement
    $stmt->close();
}
?>

<?php include('layouts/header.php'); ?>

    <!-- Login -->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="font-weight-bold">Login</h2>
            <hr class="mx-auto">
        </div>
        <div class="container mx-auto">
            <form id="login-form" method="post" action="login.php">
                <div class="mb-3 form-group">
                    <label for="InputEmail1" class="form-label">Email address</label>
                    <input name="email" type="email" class="form-control" id="InputEmail1"
                        placeholder="Enter your email" required>
                </div>
                <div class="mb-3 form-group">
                    <label for="InputPassword" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="InputPassword"
                        placeholder="Enter your password" required>
                </div>
                <div class="mb-3 form-group form-check">
                    <input type="checkbox" class="form-check-input" id="Check">
                    <label class="form-check-label" for="Check">Remember me</label>
                </div>
                <div class="mb-3 form-group">
                    <button type="submit" class="submit-btn" name="login">Submit</button>
                </div>
                <div class="form-group">
                    <span class="fw-light pe-1">Don’t have an account?</span><a href="register.php" class="btn p-0">
                        Register</a>
                </div>
            </form>
        </div>
    </section>
    <?php include('layouts/footer.php'); ?>