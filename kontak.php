<?php require_once("controller/script.php");
$_SESSION["page-name"] = "Kontak";
$_SESSION["page-url"] = "kontak";
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

  <!-- contact section starts  -->
  <section class="contact" id="contact">
    <h1 class="heading"> <span>kontak</span> kami </h1>
    <div class="row">
      <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3925.6339640485708!2d123.72467877340257!3d-10.291047889829706!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2c56898aa5da6a25%3A0x88a03f002ec42724!2sSei%20Babi%20Om%20Bai%20(Asli)!5e0!3m2!1sid!2sid!4v1681726735097!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      <form action="" method="POST">
        <h3>Berikan Pesan</h3>
        <div class="inputBox">
          <span class="fas fa-user"></span>
          <input type="text" name="nama" placeholder="Nama">
        </div>
        <div class="inputBox">
          <span class="fas fa-envelope"></span>
          <input type="email" name="email" placeholder="Email">
        </div>
        <div class="inputBox">
          <span class="fas fa-envelope"></span>
          <input type="text" name="subject" placeholder="Subject">
        </div>
        <div class="inputBox">
          <span class="fas fa-phone"></span>
          <input type="text" name="message" placeholder="Message">
        </div>
        <input type="submit" name="contact" value="contact now" class="btn">
      </form>
    </div>
  </section>
  <!-- contact section ends -->

  <!--Footer-->
  <?php require_once("resources/footer.php") ?>

</body>

</html>