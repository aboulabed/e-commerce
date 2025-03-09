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
                        <a class="nav-link active" href="shop.html">Shop</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact-us.html">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="cart.html"><i class="fas fa-shopping-cart " style="color:#212529 
"></i></a>

                        <a href="account.php"><i class="fas fa-user" style="color:#212529"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="d-flex shop justify-content-between">
        <!-- Filter Products -->
        <section id="search" class="my-5 py-5 ms-2 	d-none d-lg-block " style="width: 20%;">
            <div class="container mt-5 py-5">
                <p>Search For Products</p>
                <hr>
            </div>
            <form action="">
                <div class="row mx-auto container">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p>Category</p>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="category" id="category1">
                            <label class="form-check-label" for="category1">
                                Bags
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="category" id="category2">
                            <label class="form-check-label" for="category2">
                                Pants
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="category" id="category3">
                            <label class="form-check-label" for="category3">
                                Hats
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="category" id="category4">
                            <label class="form-check-label" for="category4">
                                Shoes
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mx-auto container mt-5">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p>Price</p>
                        <input type="range" class="form-range w-50" min="1" max="1000" id="priceRange">
                        <div class="w-50">
                            <p id="priceValue" class="float-start">1</p>
                            <p id="priceValue" class="float-end">1000</p>

                        </div>
                    </div>

                </div>
                <div class="form-group m-3">
                    <input type="submit" value="Search" name="search" class="btn btn-primary">
                </div>
            </form>
        </section>
        <!-- Featured  -->
        <section id="featured" class="my-5 py-5">
            <div class="container text-center mt-5 py-5">
                <h3>Products Collection</h3>
                <hr class="mx-auto" />
                <p>Check Out All The New Products</p>

            </div>
            <div class="row mx-auto container ">
                <div class="product mb-5 text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="assets/imgs/bag-1.jpg" alt="" class="img-fluid mb-3 img-thumbnail">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h5 class="p-name">White T-Shirt</h5>
                    <h4 class="p-price">$19</h4>
                    <button class="buy-btn">Buy Now</button>
                </div>
                <div class="product mb-5 text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="assets/imgs/bag-1.jpg" alt="" class="img-fluid mb-3 img-thumbnail">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name">Sports Bag</h5>
                    <h4 class="p-price">$9</h4>
                    <button class="buy-btn">Buy Now</button>
                </div>
                <div class="product mb-5 text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="assets/imgs/bag-1.jpg " alt="" class="img-fluid mb-3 img-thumbnail">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h5 class="p-name">Brown Trouser</h5>
                    <h4 class="p-price">$29</h4>
                    <button class="buy-btn">Buy Now</button>
                </div>
                <div class="product mb-5 text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="assets/imgs/bag-1.jpg " alt="" class="img-fluid mb-3 img-thumbnail">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name">Classic Wallet</h5>
                    <h4 class="p-price">$49</h4>
                    <button class="buy-btn">Buy Now</button>
                </div>
                <div class="product mb-5 text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="assets/imgs/bag-1.jpg" alt="" class="img-fluid mb-3 img-thumbnail">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h5 class="p-name">White T-Shirt</h5>
                    <h4 class="p-price">$19</h4>
                    <button class="buy-btn">Buy Now</button>
                </div>
                <div class="product mb-5 text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="assets/imgs/bag-1.jpg" alt="" class="img-fluid mb-3 img-thumbnail">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name">Sports Bag</h5>
                    <h4 class="p-price">$9</h4>
                    <button class="buy-btn">Buy Now</button>
                </div>
                <div class="product mb-5 text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="assets/imgs/bag-1.jpg " alt="" class="img-fluid mb-3 img-thumbnail">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h5 class="p-name">Brown Trouser</h5>
                    <h4 class="p-price">$29</h4>
                    <button class="buy-btn">Buy Now</button>
                </div>
                <div class="product mb-5 text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="assets/imgs/bag-1.jpg " alt="" class="img-fluid mb-3 img-thumbnail">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name">Classic Wallet</h5>
                    <h4 class="p-price">$49</h4>
                    <button class="buy-btn">Buy Now</button>
                </div>
                <div class="product mb-5 text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="assets/imgs/bag-1.jpg" alt="" class="img-fluid mb-3 img-thumbnail">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h5 class="p-name">White T-Shirt</h5>
                    <h4 class="p-price">$19</h4>
                    <button class="buy-btn">Buy Now</button>
                </div>
                <div class="product mb-5 text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="assets/imgs/bag-1.jpg" alt="" class="img-fluid mb-3 img-thumbnail">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name">Sports Bag</h5>
                    <h4 class="p-price">$9</h4>
                    <button class="buy-btn">Buy Now</button>
                </div>
                <div class="product mb-5 text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="assets/imgs/bag-1.jpg " alt="" class="img-fluid mb-3 img-thumbnail">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h5 class="p-name">Brown Trouser</h5>
                    <h4 class="p-price">$29</h4>
                    <button class="buy-btn">Buy Now</button>
                </div>
                <div class="product mb-5 text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="assets/imgs/bag-1.jpg " alt="" class="img-fluid mb-3 img-thumbnail">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name">Classic Wallet</h5>
                    <h4 class="p-price">$49</h4>
                    <button class="buy-btn">Buy Now</button>
                </div>
                <div class="product mb-5 text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="assets/imgs/bag-1.jpg" alt="" class="img-fluid mb-3 img-thumbnail">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h5 class="p-name">White T-Shirt</h5>
                    <h4 class="p-price">$19</h4>
                    <button class="buy-btn">Buy Now</button>
                </div>
                <div class="product mb-5 text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="assets/imgs/bag-1.jpg" alt="" class="img-fluid mb-3 img-thumbnail">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name">Sports Bag</h5>
                    <h4 class="p-price">$9</h4>
                    <button class="buy-btn">Buy Now</button>
                </div>
                <div class="product mb-5 text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="assets/imgs/bag-1.jpg " alt="" class="img-fluid mb-3 img-thumbnail">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h5 class="p-name">Brown Trouser</h5>
                    <h4 class="p-price">$29</h4>
                    <button class="buy-btn">Buy Now</button>
                </div>
                <div class="product mb-5 text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="assets/imgs/bag-1.jpg " alt="" class="img-fluid mb-3 img-thumbnail">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name">Classic Wallet</h5>
                    <h4 class="p-price">$49</h4>
                    <button class="buy-btn">Buy Now</button>
                </div>

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