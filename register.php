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
            $hashedPassword = $password; // Hash the password (consider using password_hash() instead)
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

<?php include('layouts/header.php'); ?>

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
<?php include('layouts/footer.php'); ?>