<?php session_start();
switch ($_SESSION['user_type']) {
    case 'user':
        echo "<script>window.location.href='../account.php';</script>";
        break;
}

include('server/connection.php');
// Get the count of products
$stmt1 = $conn->prepare("SELECT COUNT(*) FROM products");
$stmt1->execute();
$products_count = $stmt1->get_result();
$stmt1->close();
// Get the number of products added in the last 24 hours
$stmt2 = $conn->prepare("SELECT COUNT(*) FROM products WHERE date_created >= NOW() - INTERVAL 24 HOUR;");
$stmt2->execute();
$products_yesterday_count = $stmt2->get_result();
$stmt2->close();
// Get the count of orders
$stmt3 = $conn->prepare("SELECT COUNT(*) FROM orders");
$stmt3->execute();
$orders_count = $stmt3->get_result();
$stmt3->close();
// Get the number of orders placed in the last 24 hours
$stmt4 = $conn->prepare("SELECT COUNT(*) FROM orders WHERE order_date >= NOW() - INTERVAL 24 HOUR;");
$stmt4->execute();
$orders_yesterday_count = $stmt4->get_result();
$stmt4->close();
// Get the count of users
$stmt5 = $conn->prepare("SELECT COUNT(*) FROM users");
$stmt5->execute();
$users_count = $stmt5->get_result();
$stmt5->close();
// Get the number of users registered in the last 24 hours
$stmt6 = $conn->prepare("SELECT COUNT(*) FROM users WHERE date_added >= NOW() - INTERVAL 24 HOUR;");
$stmt6->execute();
$users_yesterday_count = $stmt6->get_result();
$stmt6->close();
?>

<?php include('layouts/header.php'); ?>
<div class="sidebar border-end shadow">
    <div class="logo mb-3">
        <img src="assets/imgs/logo.png" class="logo" alt="">
    </div>

    <ul class="list-unstyled ps-0">

        <li class="mb-1">
            <i class="fas fa-th-large"></i>
            <a href="dashboard.php" class="text-decoration-none">Dashboard</a>

        </li>

    </ul>
</div>
<div class="page-body">
    <div class="content m-5">

        <h2 class="mb-4">Dashboard</h2>
        <div class="row justify-content-between">
            <div class="card mb-3 rounded-4 col-lg-4 col-md-6 col-sm-12" style="width: 24rem;">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text"><?php echo $users_count->fetch_array()[0] ?></p>
                    <i class="fas fa-arrow-up text-success "></i>
                    <span class=" text-success card-link">+<?php echo $users_yesterday_count->fetch_array()[0] ?> Users</span>
                    <span class="card-link">From Yesterday</span>
                </div>
            </div>
            <div class="card mb-3 rounded-4 col-lg-4 col-md-6 col-sm-12" style="width: 24rem;">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="card-text"><?php echo $orders_count->fetch_array()[0] ?></p>
                    <i class="fas fa-arrow-up text-success "></i>
                    <span class=" text-success card-link">+<?php echo $orders_yesterday_count->fetch_array()[0] ?> Orders</span>
                    <span class="card-link">From Yesterday</span>
                </div>
            </div>
            <div class="card mb-3 rounded-4 col-lg-4 col-md-6 col-sm-12" style="width: 24rem;">
                <div class="card-body">
                    <h5 class="card-title">Total Products</h5>
                    <p class="card-text"><?php echo $products_count->fetch_array()[0] ?></p>
                    <i class="fas fa-arrow-up text-success "></i>
                    <span class=" text-success card-link">+<?php echo $products_yesterday_count->fetch_array()[0] ?> Products</span>
                    <span class="card-link">From Yesterday</span>
                </div>
            </div>
        </div>

    </div>
</div>
<?php include('layouts/footer.php'); ?>
<style>
    body {
        background-color: #edf8fd;
    }

    .navbar {
        width: 85%;
        justify-self: right;
        box-shadow: none !important;
        height: 10vh;

        img,
        h2 {
            display: none;
        }
    }

    .sidebar {
        width: 15%;
        background-color: white;
        height: 100vh;
        position: absolute;
        top: 0;

        div.logo {
            width: 100%;
            text-align: center;
        }

        ul {
            margin-top: 1.5rem;

            li {
                text-align: center;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 18px;

                a {
                    margin-left: 10px;
                }
            }
        }

    }

    .page-body {
        justify-self: right;
        width: 85%;

        .card {
            .card-body {
                h5 {
                    margin-bottom: 0.8rem;
                    font-size: 17px;
                }

                p {
                    font-size: 30px;
                }

                span:last-of-type {
                    font-size: 15px;
                    margin-left: 0.5rem;
                    color: grey;
                }
            }
        }
    }

    footer {
        display: none;
    }
</style>