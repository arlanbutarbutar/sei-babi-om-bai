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

  <!-- about section starts  -->
  <section class="about" id="about">
    <h1 class="heading"> <span>about</span> us </h1>
    <div class="row">
      <div class="image">
        <img src="assets/images/b.jpg" alt="">
      </div>
      <div class="content">
        <h3>Se'i Babi Om Ba'i</h3>
        <?php if (mysqli_num_rows($tentang) > 0) {
          $row = mysqli_fetch_assoc($tentang);
          echo $row['about_us'];
        } ?>
      </div>
    </div>
  </section>

  <!--Footer-->
  <?php require_once("resources/footer.php") ?>

</body>

</html>