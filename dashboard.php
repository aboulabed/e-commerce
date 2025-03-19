<?php 
include('server/connection.php');
include('server/check_login.php');
switch ($_SESSION['user_type']) {
    case 'user':
        echo "<script>window.location.href='../account.php';</script>";
        break;
}

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
// Get the orders
$stmt7 = $conn->prepare("SELECT * FROM orders ORDER BY order_date DESC LIMIT 5;");
$stmt7->execute();
$orders = $stmt7->get_result();
$stmt7->close();
?>

<?php include('layouts/header.php'); ?>
<?php include('layouts/sidebar.php'); ?>

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

        <div class="row">
            <div class="latest-orders card mt-4 mb-3 rounded-4 col-lg-12 col-md-12 col-sm-12">
                <div class="card-body">
                    <div class="header d-flex justify-content-between">

                        <h5 class="card-title">Latest Orders</h5>
                        <a href="#" class="text-decoration-none">View All</a>
                    </div>
                    <div class="table-responsive">

                        <table>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>User Address</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($order = $orders->fetch_assoc()) { ?>
                                    <tr>
                                        <td>#<?php echo $order['order_id']; ?></td>
                                        <td><?php echo $order['user_address']; ?></td>
                                        <td><?php echo $order['order_date']; ?></td>
                                        <td><?php echo $order['order_status']; ?></td>
                                        <td>$<?php echo $order['order_cost']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
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
        max-height: 10vh;
        position: sticky !important;

        img,
        h2 {
            display: none;
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

                .header {
                    a {
                        color: grey !important;
                    }
                }

                span:last-of-type {
                    font-size: 15px;
                    margin-left: 0.5rem;
                    color: grey;
                }
            }
        }

        table {
            width: 100%;
            margin-top: 2rem;
            border-collapse: separate;
            border-spacing: 0 20px;
            overflow: hidden;

            thead {
                background-color: #edf8fd;


                th {
                    font-weight: 600;
                    padding: 10px;
                    overflow: hidden;
                }

                th:first-of-type {
                    border-top-left-radius: 10px;
                    border-bottom-left-radius: 10px
                }

                th:last-of-type {
                    border-top-right-radius: 10px;
                    border-bottom-right-radius: 10px
                }
            }

            tbody {
                td {
                    padding: 10px;
                    color: #6e7070;
                }
            }
        }
    }

    footer {
        display: none;
    }
</style>