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
  
  <!-- header section starts -->
  <?php require_once("resources/navbar.php"); ?>
  <!-- header section ends -->

  <!-- home section starts  -->
  <section class="home" id="home">
    <div class="content">
      <h3>Se'i Babi Om Ba'i Siap Menggoyang Lidah</h3>
      <p>Rasakan Sensasi Gurihnya Daging Se'i Babi Om Ba'i Menari-nari Dimulut</p>
      <a href="about" class="btn" style="color: #000;">Selengkapnya</a>
    </div>
  </section>
  <!-- home section ends -->

  <!--Footer-->
  <?php require_once("resources/footer.php") ?>

</body>

</html>