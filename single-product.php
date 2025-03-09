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
  <nav class="navbar navbar-expand-lg bg-white fixed-top shadow py-3">
    <div class="container">
      <img src="assets/imgs/logo.png" class="logo" alt="" />
      <h2>FASHION</h2>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
  <!-- Single Product -->
  <?php
  $parts = explode("=", $_SERVER["QUERY_STRING"]);
  $product_id = $parts[1];
  ?>
  <?php

  include("server/connection.php");
  $stmt = $conn->prepare("SELECT * FROM products WHERE product_id=$product_id");
  $stmt->execute();

  $single_product = $stmt->get_result();
  ?>

  <?php while ($row = $single_product->fetch_assoc()) { ?>
    <div class="container single-product my-5 pt-5">
      <div class="row mt-5 justify-content-around">
        <div class="col-lg-5 col-md-6 col-sm-12">
          <img src="assets/imgs/<?php echo $row["product_image"]; ?>" class="img-fluid w-100 pb-3" id="main-img" alt="">
          <div class="small-img-row">
            <div class="small-img-col">
              <img src="assets/imgs/<?php echo $row["product_image"]; ?>" class="img-fluid w-100 small-img" alt="">
            </div>
            <div class="small-img-col">
              <img src="assets/imgs/<?php echo $row["product_image"]; ?>" class="img-fluid w-100 small-img" alt="">
            </div>
            <div class="small-img-col">
              <img src="assets/imgs/<?php echo $row["product_image"]; ?>" class="img-fluid w-100 small-img" alt="">
            </div>
            <div class="small-img-col">
              <img src="assets/imgs/<?php echo $row["product_image"]; ?>" class="img-fluid w-100 small-img" alt="">
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-12">
          <h6>Home/<?php echo $row["product_category"]; ?></h6>
          <h3 class="py-4"><?php echo $row["product_name"]; ?></h3>
          <h2>$<?php echo $row["product_price"]; ?></h2>
          <form action="cart.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $row["product_id"]; ?>">
            <input type="hidden" name="product_image" value="<?php echo $row["product_image"]; ?>">
            <input type="hidden" name="product_name" value="<?php echo $row["product_name"]; ?>">
            <input type="hidden" name="product_price" value="<?php echo $row["product_price"]; ?>">
            <input class="mx-1" name="product_quantity" type="number" value="1" />
            <button class="buy-btn" name="add_to_cart" type="submit">Add To Cart</button>
          </form>
          <h4 class="my-5">Product Details</h4>
          <span><?php echo $row["product_description"]; ?></span>

        </div>
      </div>
    </div>
  <?php } ?>

  <!-- Footer -->
  <footer class="mt-5 py-5">
    <div class="row container mx-auto pt-5">
      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <img src="assets/imgs/logo.png" class="img-fluid logo" />
        <p class="pt-3">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam,
          quae.
        </p>
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
          <img src="assets/imgs/bag-1.jpg" alt="" class="img-fluid instagram m-2" />
          <img src="assets/imgs/bag-1.jpg" alt="" class="img-fluid instagram m-2" />
          <img src="assets/imgs/bag-1.jpg" alt="" class="img-fluid instagram m-2" />
          <img src="assets/imgs/bag-1.jpg" alt="" class="img-fluid instagram m-2" />
          <img src="assets/imgs/bag-1.jpg" alt="" class="img-fluid instagram m-2" />
        </div>
      </div>
    </div>
    <div class="copyright mt-5">
      <div class="row container mx-auto">
        <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
          <img src="assets/imgs/visa.png" alt="" class="img-fluid" />
          <img src="assets/imgs/card.png" alt="" class="img-fluid" />
          <img src="assets/imgs/paypal.png" alt="" class="img-fluid" />
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
    const mainImg = document.querySelector('#main-img');
    const smallImg = document.querySelectorAll('.small-img');

    smallImg.forEach((item) => {
      item.addEventListener('click', () => {
        mainSrc = mainImg.getAttribute('src');
        mainImg.src = item.src;
        item.src = mainSrc;
      });
    });
  </script>
</body>

</html>