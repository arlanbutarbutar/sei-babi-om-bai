<?php require_once("controller/script.php");
$_SESSION["page-name"] = "Tentang";
$_SESSION["page-url"] = "tentang";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once("resources/header.php"); ?>
</head>

<body>
  <?php if (isset($_SESSION["message-success"])) { ?>
    <div class="message-success" data-message-success="<?= $_SESSION["message-success"] ?>"></div>
  <?php }
  if (isset($_SESSION["message-info"])) { ?>
    <div class="message-info" data-message-info="<?= $_SESSION["message-info"] ?>"></div>
  <?php }
  if (isset($_SESSION["message-warning"])) { ?>
    <div class="message-warning" data-message-warning="<?= $_SESSION["message-warning"] ?>"></div>
  <?php }
  if (isset($_SESSION["message-danger"])) { ?>
    <div class="message-danger" data-message-danger="<?= $_SESSION["message-danger"] ?>"></div>
  <?php } ?>

  <div class="container-xxl bg-white p-0">
    <?php require_once("resources/navbar.php"); ?>
    <div class="container-xxl py-5 bg-dark hero-header mb-5">
      <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Tentang Kami</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-center text-uppercase">
            <li class="breadcrumb-item"><a href="./">Beranda</a></li>
            <li class="breadcrumb-item text-white active" aria-current="page">Tentang</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!-- Navbar & Hero End -->

  <!-- About Start -->
  <div class="container-xxl py-5" id="tentang">
    <div class="container">
      <div class="row g-5 align-items-center">
        <div class="col-lg-6">
          <div class="row g-3">
            <div class="col-6 text-start">
              <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.1s" src="assets/images/a.jpg">
            </div>
            <div class="col-6 text-start">
              <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.3s" src="assets/images/b.jpg" style="margin-top: 25%;">
            </div>
            <div class="col-6 text-end">
              <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.5s" src="assets/images/c.jpg">
            </div>
            <div class="col-6 text-end">
              <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.7s" src="assets/images/ab.jpg">
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <h1 class="mb-4">Tentang</h1>
          <?php if (mysqli_num_rows($tentang) > 0) {
            $row_tentang = mysqli_fetch_assoc($tentang);
            echo $row_tentang['about_us'];
          } ?>
        </div>
      </div>
    </div>
  </div>
  <!-- About End -->

  <!-- Gallery Start -->
  <?php if (mysqli_num_rows($gallery) > 0) { ?>
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
      <div class="container">
        <div class="text-center">
          <h1 class="mb-5">Galeri</h1>
        </div>
        <div class="owl-carousel testimonial-carousel">
          <?php while ($row_gallery = mysqli_fetch_assoc($gallery)) { ?>
            <div class="testimonial-item bg-transparent border rounded">
              <img src="<?= $row_gallery['image'] ?>" alt="">
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php } ?>
  <!-- Gallery End -->

  <div style="margin-bottom: 50px;"></div>

  <!--Footer-->
  <?php require_once("resources/footer.php") ?>

</body>

</html>