<?php include('layouts/header.php'); ?>
  <!-- home -->
  <section id="home">
    <div class="container">
      <h5>NEW ARRIVALS</h5>
      <h1><span>Best Prices</span> This Year</h1>
      <p>Discover all the new arrivals of ready-to-wear and accessories.</p>
      <a href="shop.php"><button>Shop Now</button></a>

    </div>
  </section>
  <!-- brands -->
  <section id="brands" class="container">
    <div class="row">
      <img src="assets/imgs/1.jpg" class="img-fluid col-lg-3 col-md-6 col-sm-12" alt="" />
      <img src="assets/imgs/2.jpg" class="img-fluid col-lg-3 col-md-6 col-sm-12" alt="" />
      <img src="assets/imgs/3.jpg" class="img-fluid col-lg-3 col-md-6 col-sm-12" alt="" />
      <img src="assets/imgs/4.jpg" class="img-fluid col-lg-3 col-md-6 col-sm-12" alt="" />
    </div>
  </section>
  <!-- new -->
  <section id="new" class="w-100 ">
    <div class="row p-0 m-0">
      <?php include('server/get_new_products.php') ?>
      <?php while ($row = $new_products->fetch_assoc()) { ?>
        <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
          <img src="assets/imgs/<?php echo $row['product_image'] ?>" alt="" class="img-fluid img-thumbnail">
          <div class="details rounded">
            <h2><?php echo $row['product_name'] ?></h2>
            <a href="single-product.php?product_id=<?php echo $row["product_id"] ?>"><button class="buy-btn">Buy Now</button></a>
          </div>
        </div>
      <?php } ?>
    </div>
  </section>
  <!-- Featured  -->
  <section id="featured" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>Featured Collection</h3>
      <hr class="mx-auto" />
      <p>Check Out All The New Trends</p>

    </div>
    <div class="row mx-auto container-fluid ">
      <?php include('server/get_featured_products.php') ?>
      <?php while ($row = $featured_products->fetch_assoc()) { ?>
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img src="assets/imgs/<?php echo $row['product_image'] ?>" alt="" class="img-fluid mb-3 img-thumbnail">
          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
          </div>
          <h5 class="p-name"><?php echo $row['product_name'] ?></h5>
          <h4 class="p-price">$<?php echo $row['product_price'] ?></h4>
          <a href="single-product.php?product_id=<?php echo $row["product_id"] ?>"><button class="buy-btn">Buy Now</button></a>
        </div>
      <?php } ?>
    </div>
  </section>
  <!-- Banner -->
  <section id="banner" class="my-5 py-5">
    <div class="container">
      <h4>SEASONAL SALE</h4>
      <h1>Winter Collection <br> 50% OFF</h1>
      <button class="text-uppercase">shop now</button>
    </div>
  </section>
  <!-- Clothes -->
  <?php include('server/get_product_category.php'); ?>
  <?php include('server/get_home_products.php'); ?>

  <?php
  foreach ($data as $item) {


  ?>
    <section id="<?php echo $item["product_category"] ?>" class="my-5">
      <div class="container text-center mt-5 py-5">
        <h3><?php echo $item["product_category"] ?></h3>
        <hr class="mx-auto" />
        <p>Check Out All The Amazing <?php echo $item["product_category"] ?></p>

      </div>
      <div class="row mx-auto container-fluid">
        <?php
        foreach ($home_products as $product) {
          if ($product["product_category"] == $item["product_category"]) {
        ?>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
              <img src="assets/imgs/<?php echo $product["product_image"] ?>" alt="" class="img-fluid mb-3 img-thumbnail">
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
              </div>
              <h5 class="p-name"><?php echo $product["product_name"] ?></h5>
              <h4 class="p-price">$<?php echo $product["product_price"] ?></h4>
              <a href="single-product.php?product_id=<?php echo $product["product_id"] ?>"><button class="buy-btn">Buy Now</button></a>
            </div>
        <?php
          }
        }
        ?>
      </div>
    </section>
  <?php } ?>
  <?php include('layouts/footer.php'); ?>