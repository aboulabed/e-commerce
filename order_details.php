<?php
include('server/check_login.php');
include('server/connection.php');

// Redirect if user is not authorized
switch ($_SESSION['user_type']) {
    case 'user':
        echo "<script>window.location.href='../account.php';</script>";
        break;
}

$order_id = $_GET['order_id'];

// Get the order details
$stmt1 = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
$stmt1->bind_param("i", $order_id);
$stmt1->execute();
$order_result = $stmt1->get_result();
$order = $order_result->fetch_assoc(); // Fetch the order details
$stmt1->close();

// Get the order items
$stmt2 = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
$stmt2->bind_param("i", $order_id);
$stmt2->execute();
$order_items_result = $stmt2->get_result(); // Result set for order items
$stmt2->close();

include('layouts/header.php');
include('layouts/sidebar.php');
?>

<div class="page-body">
    <div class="content m-5">
        <h2 class="mb-4">Order #<?php echo $order_id; ?></h2>
        <h5>Customer ID: <?php echo $order['user_id']; ?></h5>
        <div class="row">
            <div class="latest-orders card mt-4 mb-3 rounded-4 col-lg-12 col-md-12 col-sm-12">
                <div class="card-body">
                    <div class="header d-flex justify-content-between">
                        <h5 class="card-title">Order Items</h5>
                    </div>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($order_item = $order_items_result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><img src="assets/imgs/<?php echo $order_item['product_image']; ?>" class="img-thumbnail" style="width: 15%;"></td>
                                        <td><?php echo $order_item['product_name']; ?></td>
                                        <td><?php echo $order_item['product_quantity']; ?></td>
                                        <td>$<?php echo $order_item['product_price']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="user-details">
                        <h5 class="mb-3">User Details:</h5>
                        <p>Phone: <?php echo $order['user_phone']; ?></p>
                        <p>Address: <?php echo $order['user_address']; ?></p>
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
                    border-bottom-left-radius: 10px;
                }

                th:last-of-type {
                    border-top-right-radius: 10px;
                    border-bottom-right-radius: 10px;
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