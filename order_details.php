<?php
include('server/check_login.php');
include('server/connection.php');
switch ($_SESSION['user_type']) {
    case 'user':
        echo "<script>window.location.href='../account.php';</script>";
        break;
}
$oreder_id = $_GET['order_id'];
// Get the order
$stmt1 = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
$stmt1->bind_param("i", $oreder_id);
$stmt1->execute();
$order = $stmt1->get_result();
$stmt1->close();
// Get the order items
$stmt2 = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
$stmt2->bind_param("i", $oreder_id);
$stmt2->execute();
$orders = $stmt2->get_result();
$stmt2->close();

include('layouts/header.php');
include('layouts/sidebar.php');
?>

<div class="page-body">
    <div class="content m-5">
        <h2 class="mb-4">Order #<?php echo $oreder_id; ?></h2>
        <h5>Costumer ID: <?php echo $order->fetch_assoc()['user_id']; ?></h5>
        <div class="row">
            <div class="latest-orders card mt-4 mb-3 rounded-4 col-lg-12 col-md-12 col-sm-12">
                <div class="card-body">
                    <div class="header d-flex justify-content-between">

                        <h5 class="card-title">Latest Orders</h5>
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
                                <?php while ($order = $orders->fetch_assoc()) { ?>


                                    <tr >
                                        <td><img src="assets/imgs/<?php echo $order['product_image']; ?>" class="img-thumbnail" style="width: 15%;"></td>
                                        <td><?php echo $order['product_name']; ?></td>
                                        <td><?php echo $order['product_quantity']; ?></td>
                                        <td>$<?php echo $order['product_price']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="user-details">
                        <h5>User Details</h5>
                        <p>Name: <?php echo $order->fetch_assoc()['user_name']; ?></p>
                        <p>Phone: <?php echo $order->fetch_assoc()['user_phone']; ?></p>
                        <p>Address: <?php echo $order->fetch_assoc()['user_address']; ?></p>
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