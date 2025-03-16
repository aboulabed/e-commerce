<?php
include('server/connection.php');
include('server/check_login.php');

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
        $hashedPassword = $password;

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
<?php include('layouts/header.php'); ?>

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
    <?php include('layouts/footer.php'); ?>