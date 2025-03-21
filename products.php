<?php
include('server/check_login.php');
include('server/connection.php');
switch ($_SESSION['user_type']) {
    case 'user':
        echo "<script>window.location.href='../account.php';</script>";
        break;
}
// Edit Product
if (isset($_POST['edit-product'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_category = $_POST['product_category'];

    $stmt = $conn->prepare("UPDATE products SET product_name = ?, product_description = ?, product_price = ?, product_image = ?, product_category = ? WHERE product_id = ?");
    $stmt->bind_param("sssssi", $product_name, $product_description, $product_price, $product_image, $product_category, $product_id);
    $stmt->execute();
    $stmt->close();
    header("Location: products.php");
    exit();
}
// Delete Product
if (isset($_POST['delete-product'])) {
    $product_id = $_POST['product_id'];
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->close();
    header("Location: products.php");
    exit();
}
// Add Product
if(isset($_POST['add-product'])){
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_category = $_POST['product_category'];
    $stmt = $conn->prepare("INSERT INTO products (product_name, product_description, product_price, product_image, product_category) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $product_name, $product_description, $product_price, $product_image, $product_category);
    $stmt->execute();
    $stmt->close();
    header("Location: products.php");
    exit();
}
// Pagination logic
$productsPerPage = 8; // Number of products per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number
$offset = ($page - 1) * $productsPerPage; // Calculate offset

// Fetch total number of products
$stmt1 = $conn->prepare("SELECT COUNT(*) as total FROM products");
$stmt1->execute();
$totalProductsResult = $stmt1->get_result();
$totalProducts = $totalProductsResult->fetch_assoc()['total'];
$stmt1->close();

// Fetch products for the current page
$stmt2 = $conn->prepare("SELECT * FROM products ORDER BY product_id LIMIT ? OFFSET ?");
$stmt2->bind_param("ii", $productsPerPage, $offset);
$stmt2->execute();
$products = $stmt2->get_result();
$stmt2->close();

// Calculate total number of pages
$totalPages = ceil($totalProducts / $productsPerPage);
include('layouts/header.php');
include('layouts/sidebar.php');
?>
<div class="page-body">
    <div class="content m-5">
        <h2 class="mb-4">Products</h2>
        <div class="add-product">
            <!-- Button trigger modal -->
            <button type="button" class="" data-bs-toggle="modal" data-bs-target="#addProduct">
                Add Product
            </button>

            <!-- Modal -->
            <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addProductLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="products.php" method="post">
                            <div class="modal-body row">
                                <div class="form-group mb-3 col-lg-6 col-md-12 col-sm-12">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name" required>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-md-12 col-sm-12">
                                    <label for="product_category">Product Category</label>
                                    <input type="text" class="form-control" id="product_category" name="product_category" required>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-md-12 col-sm-12">
                                    <label for="product_price">Product Price</label>
                                    <input type="number" class="form-control" id="product_price" name="product_price" required>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-md-12 col-sm-12">
                                    <label for="product_image">Product Image</label>
                                    <input type="file" class="form-control" id="product_image" name="product_image" required>
                                </div>
                                <div class="form-group mb-3 col-lg-12 col-md-12 col-sm-12">
                                    <label for="product_description">Product Description</label>
                                    <textarea class="form-control" id="product_description" name="product_description" rows="3" required></textarea>
                                </div>
                            

                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="add-product">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="latest-orders card mt-4 mb-3 rounded-4 col-lg-12 col-md-12 col-sm-12">
                <div class="card-body">
                    <div class="table-responsive">

                        <table>
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Product Category</th>
                                    <th>Product Price</th>
                                    <th>Date Added</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($product = $products->fetch_assoc()) { ?>


                                    <tr>
                                        <td>#<?php echo $product['product_id']; ?></td>
                                        <td><?php echo $product['product_name']; ?></td>
                                        <td><?php echo $product['product_category']; ?></td>
                                        <td>$<?php echo $product['product_price']; ?></td>
                                        <td class="date"><?php echo $product['date_created']; ?></td>
                                        <td class="action">
                                            <!-- Button trigger modal -->
                                            <i class="fas fa-edit" style="color: #2fa3d6;" type="button" data-bs-toggle="modal" data-bs-target="#editModel<?php echo $product['product_id']; ?>"></i>
                                            <!-- Modal -->
                                            <div class="modal fade" id="editModel<?php echo $product['product_id']; ?>"" tabindex=" -1" aria-labelledby="editModelLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="editModelLabel">Edit Product</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="products.php?page=<?php echo $page; ?>" method="post">

                                                            <div class="modal-body">
                                                                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                                                <div class="form-group mb-3">
                                                                    <label for="product_name">Product Name</label>
                                                                    <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $product['product_name']; ?>" required>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="product_category">Product Category</label>
                                                                    <input type="text" class="form-control" id="product_category" name="product_category" value="<?php echo $product['product_category']; ?>" required>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="product_price">Product Price</label>
                                                                    <input type="text" class="form-control" id="product_price" name="product_price" value="<?php echo $product['product_price']; ?>" required>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="product_image">Product Image</label>
                                                                    <input type="file" class="form-control" id="product_image" name="product_image" required>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="product_description">Product Description</label>
                                                                    <textarea class="form-control" id="product_description" name="product_description" rows="5" required></textarea>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" name="edit-product" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="products.php?page=<?php echo $page; ?>" method="post">
                                                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>"><input type="hidden" name="delete-product">
                                                <button type="submit" class="btn p-0" name="delete-product"><i class="fas fa-trash" style="color: #fb8182;"></i></button>
                                            </form>
                                        </td>
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

        .add-product {
            display: flex;
            justify-content: end;

            &>button,
            .modal-footer>button {
                background-color: #008ecc;
                color: #d7edf7;
                font-size: 12px;
                border-radius: 10px;
            }

            .modal-body {
                display: flex;
                justify-content: space-between;
                flex-wrap: wrap;
                input,
                textarea {
                    width: 100%;
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

                    &.date {
                        background-color: #ddf2fb;
                        text-align: center;
                        color: #015579 !important;
                        border-radius: 2rem;
                    }

                    &.action {
                        background-color: #ddf2fb;
                        text-align: center;
                        color: #015579 !important;
                        display: flex;
                        justify-content: space-between;
                        max-width: fit-content;
                        gap: 15px;
                        justify-self: center;
                        align-items: center;
                        border-radius: 0.5rem !important;

                        svg {
                            cursor: pointer;
                        }
                    }
                }
            }
        }
    }

    footer {
        display: none;
    }
</style>