<?php require_once("controller/script.php");
$_SESSION["page-name"] = "";
$_SESSION["page-url"] = "./";
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
      <div class="container my-5 py-5">
        <div class="row align-items-center g-5">
          <div class="col-lg-6 text-center text-lg-start">
            <h1 class="display-3 text-white animated slideInLeft">Se'i Babi Om Ba'i <div style="font-size: 46px;">Siap Menggoyang Lidah</div>
            </h1>
            <p class="text-white animated slideInLeft mb-4 pb-2">Rasakan Sensasi Gurihnya Daging Se'i Babi Om Ba'i Menari-nari Dimulut</p>
            <div class="col-md-9">
              <div class="d-flex justify-content-between">
                <a href="tentang" class="btn btn-outline-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">Selengkapnya</a>
                <a href="menu" class="btn btn-primary py-sm-3 px-sm-3 me-3 animated slideInLeft">Lihat Menu</a>
              </div>
            </div>
          </div>
          <div class="col-lg-6 text-center text-lg-end overflow-hidden">
            <img class="img-fluid" src="assets/images/ddd.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Navbar & Hero End -->

  <!--Footer-->
  <?php require_once("resources/footer.php") ?>

</body>

</html>