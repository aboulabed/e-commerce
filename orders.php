<?php
include('server/check_login.php');
include('server/connection.php');
switch ($_SESSION['user_type']) {
    case 'user':
        echo "<script>window.location.href='../account.php';</script>";
        break;
}

// Pagination logic
$ordersPerPage = 5; // Number of orders per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number
$offset = ($page - 1) * $ordersPerPage; // Calculate offset

// Fetch total number of orders
$stmt1 = $conn->prepare("SELECT COUNT(*) as total FROM orders");
$stmt1->execute();
$totalOrdersResult = $stmt1->get_result();
$totalOrders = $totalOrdersResult->fetch_assoc()['total'];
$stmt1->close();

// Fetch orders for the current page
$stmt2 = $conn->prepare("SELECT * FROM orders ORDER BY order_id LIMIT ? OFFSET ?");
$stmt2->bind_param("ii", $ordersPerPage, $offset);
$stmt2->execute();
$orders = $stmt2->get_result();
$stmt2->close();

// Calculate total number of pages
$totalPages = ceil($totalOrders / $ordersPerPage);

include('layouts/header.php');
include('layouts/sidebar.php');
?>

<div class="page-body">
    <div class="content m-5">
        <h2 class="mb-4">Orders</h2>
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
                                    <th>Order ID</th>
                                    <th>User Address</th>
                                    <th>Order Date</th>
                                    <th>Order Cost</th>
                                    <th>Order Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($order = $orders->fetch_assoc()) { ?>


                                    <tr onclick="window.location='order_details.php?order_id=<?php echo $order['order_id']; ?>';" style="cursor: pointer;" title="View order details for order #<?php echo $order['order_id']; ?>">
                                        <td>#<?php echo $order['order_id']; ?></td>
                                        <td><?php echo $order['user_address']; ?></td>
                                        <td><?php echo $order['order_date']; ?></td>
                                        <td>$<?php echo $order['order_cost']; ?></td>
                                        <td><?php echo $order['order_status']; ?></td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <?php if ($page > 1) { ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php } ?>

                                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php } ?>

                                <?php if ($page < $totalPages) { ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </nav>
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

                    &:last-child {
                        background-color: #ddf2fb;
                        text-align: center;
                        color: #015579 !important;
                        border-radius: 2rem;
                    }
                }
            }
        }
    }

    footer {
        display: none;
    }
</style>