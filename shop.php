<?php
include('server/connection.php');
if (isset($_POST['search']) && isset($_POST['category'])) {
    $category = $_POST['category'];

    $price = $_POST['price'];
    $stmt1 = $conn->prepare("SELECT * FROM products WHERE product_category = ? AND product_price BETWEEN 0 AND ? ");
    $stmt1->bind_param("si", $category, $price);
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







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <style>
        .pagination a {
            color: coral;

            &:hover {
                background-color: coral;
                color: white;
            }
        }
    </style>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-white  fixed-top shadow py-3">
        <div class="container">
            <img src="assets/imgs/logo.png" class="logo" alt="">
            <h2>FASHION</h2>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="shop.php">Shop</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact-us.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="cart.php"><i class="fas fa-shopping-cart " style="color:#212529 
"></i></a>

                        <a href="account.php"><i class="fas fa-user" style="color:#212529"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
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
                                <input class="form-check-input" value="<?php echo $category['product_category']; ?>" type="radio" name="category" id="category1" required> 
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
                        <input type="range" class="form-range w-50" name="price" value="20" min="<?php echo $lowest_price; ?>" max="<?php echo $highest_price; ?>" id="priceRange" required>
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



    <!-- Footer -->
    <footer class="mt-5 py-5">
        <div class="row container mx-auto pt-5">
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <img src="assets/imgs/logo.png" class="img-fluid logo">
                <p class="pt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</p>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Featured</h5>
                <ul class="text-uppercase">
                    <li><a href="#">men</a></li>
                    <li><a href="#">women</a></li>
                    <li><a href="#">boys</a></li>
                    <li><a href="#">girls</a></li>
                    <li><a href="#">new arrivals</a></li>
                    <li><a href="#">shoes</a></li>
                    <li><a href="#">clothes</a></li>
                </ul>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Contact Us</h5>
                <div>
                    <h6 class="text-uppercase">Address</h6>
                    <p>123, Main Street, Your City</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Phone</h6>
                    <p>(123) 456-7890</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Email</h6>
                    <p>2nVtZ@example.com</p>
                </div>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Instagram</h5>
                <div class="row">
                    <img src="assets/imgs/bag-1.jpg" alt="" class="img-fluid instagram  m-2">
                    <img src="assets/imgs/bag-1.jpg" alt="" class="img-fluid instagram  m-2">
                    <img src="assets/imgs/bag-1.jpg" alt="" class="img-fluid instagram  m-2">
                    <img src="assets/imgs/bag-1.jpg" alt="" class="img-fluid instagram  m-2">
                    <img src="assets/imgs/bag-1.jpg" alt="" class="img-fluid instagram  m-2">
                </div>
            </div>
        </div>
        <div class="copyright mt-5">
            <div class="row container mx-auto">
                <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                    <img src="assets/imgs/visa.png" alt="" class="img-fluid">
                    <img src="assets/imgs/card.png" alt="" class="img-fluid">
                    <img src="assets/imgs/paypal.png" alt="" class="img-fluid">
                </div>
                <div class="col-lg-4 col-md-5 col-sm-12 text-nowrap mb-2">
                    <p>Copyright ©2025 All Rights Reserved</p>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-12">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
        crossorigin="anonymous"></script>
    <script>
        const product = document.querySelectorAll('.product');
        product.forEach((item) => {
            item.addEventListener('click', () => {
                window.location.href = 'single-product.php';
            });
        })
    </script>
</body>

</html>