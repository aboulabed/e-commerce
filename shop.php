<?php
include('server/connection.php');
include('server/check_login.php');
if (isset($_POST['search']) && isset($_POST['category'])) {
    $category = $_POST['category'];

    $price = $_POST['price'];
    $_SESSION['selected_category'] = $category;
    $_SESSION['selected_price'] = $price;
    $stmt1 = $conn->prepare("SELECT * FROM products WHERE product_category = ? AND product_price BETWEEN 0 AND ? ");
    $stmt1->bind_param("si", $_SESSION['selected_category'], $_SESSION['selected_price']);
    $stmt1->execute();
    $products = $stmt1->get_result();
    $stmt1->close();
} else {

    $stmt1 = $conn->prepare("SELECT * FROM products ORDER BY product_category DESC");
    $stmt1->execute();
    $products = $stmt1->get_result();
    $stmt1->close();
}

$stmt2 = $conn->prepare("SELECT DISTINCT product_category FROM products ");
$stmt2->execute();
$products_category = $stmt2->get_result();
$stmt2->close();

// Prepare the SQL query

$stmt3 = $conn->prepare("SELECT MIN(product_price) AS lowest_price, MAX(product_price) AS highest_price FROM products");
$stmt3->bind_result($lowest_price, $highest_price);
$stmt3->execute();
$stmt3->fetch();
$stmt3->close();
$highest_price = ceil($highest_price);
$lowest_price = ceil($lowest_price);
?>







<?php include('layouts/header.php'); ?>

<div class="d-flex shop justify-content-between" style="width: 90%;">
    <!-- Filter Products -->
    <section id="search" class="my-5 py-5 ms-2 ps-2	d-none d-lg-block " style="width: 20%;">
        <div class="container mt-5 py-5">
            <p>Search For Products</p>
            <hr>
        </div>
        <form action="shop.php" method="post">
            <div class="row mx-auto container">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p>Category</p>
                    <?php while ($category = $products_category->fetch_assoc()) { ?>
                        <div class="form-check">
                            <input class="form-check-input" value="<?php echo $category['product_category']; ?>" type="radio" name="category" id="category1" required
                                <?php echo (isset($_SESSION['selected_category']) && $_SESSION['selected_category'] === $category['product_category']) ? 'checked' : ''; ?>>

                            <label class="form-check-label" for="category1">
                                <?php echo $category['product_category']; ?>
                            </label>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="row mx-auto container mt-5">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p>Price</p>
                    <input type="range" class="form-range w-50" name="price" value="<?php echo isset($_SESSION['selected_price'])  ? $_SESSION['selected_price'] : 20 ?>" min="<?php echo $lowest_price; ?>" max="<?php echo $highest_price; ?>" id="priceRange" required>
                    <div class="w-50">
                        <p id="priceValue" class="float-start">$<?php echo $lowest_price; ?></p>
                        <p id="priceValue" class="float-end">$<?php echo $highest_price; ?></p>

                    </div>
                </div>

            </div>
            <div class="form-group m-3">
                <input type="submit" value="Search" name="search" class="btn btn-primary">
            </div>
        </form>
    </section>
    <!-- Products  -->
    <section id="products" class="my-5 py-5">
        <div class="container text-center mt-5 py-5">
            <h3>Products Collection</h3>
            <hr class="mx-auto" />
            <p>Check Out All The New Products</p>

        </div>
        <div class="row mx-auto container ">
            <?php while ($product = $products->fetch_assoc()) { ?>
                <div class="product mb-5 text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="assets/imgs/<?php echo $product['product_image']; ?>" alt="" class="img-fluid mb-3 img-thumbnail">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h5 class="p-name"><?php echo $product['product_name']; ?></h5>
                    <h4 class="p-price">$<?php echo $product['product_price']; ?></h4>
                    <a href="single-product.php?product_id=<?php echo $product["product_id"] ?>"><button class="buy-btn">Buy Now</button></a>

                </div>
            <?php } ?>

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
</div>



<?php include('layouts/footer.php'); ?>