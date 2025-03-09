<?php include('layouts/header.php');
include('server/check_login.php');
?>

<!-- Contact-us -->
<section id="contact-us" class="mt-5 py-5">
  <div class="container text-center mt-3 pt-5">
    <h2 class="font-weight-bold">Contact us</h2>
    <hr class="mx-auto" />
  </div>
  <div class="container contact-us">

    <form action="" id="checkout-form" class="">
      <div class="input-info mb-3 col-lg-6 col-md-12 col-sm-12">

        <input name="name" type="text" class="form-control" id="name" placeholder="Joe" required>
      </div>

      <div class="input-info mb-3 col-lg-6 col-md-12 col-sm-12">

        <input name="second-name" type="text" class="form-control" id="second-name" placeholder="Doe" required>
      </div>
      <div class="input-info mb-3 col-lg-6 col-md-12 col-sm-12">

        <input name="email" type="email" class="form-control" id="email" placeholder="Email" required>
      </div>
      <div class="input-info mb-3 col-lg-6 col-md-12 col-sm-12">

        <input name="subject" type="text" class="form-control" id="subject" placeholder="Subject" required>
      </div>
      <div class="input-info mb-3 col-lg-12 col-md-12 col-sm-12">

        <textarea name="message" type="text" class="form-control" id="message" placeholder="Your Message"
          required></textarea>
      </div>

      <div class="mb-3 mt-3 form-group">
        <button type="submit" class="submit-btn">Send</button>
      </div>
    </form>

  </div>
</section>
<?php include('layouts/footer.php'); ?>