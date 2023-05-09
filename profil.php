<?php require_once("controller/script.php");
$_SESSION["page-name"] = "Profil";
$_SESSION["page-url"] = "profil";
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
  <?php foreach ($profile as $row) : ?>
    <section class="contact" id="contact">
      <h1 class="heading"> <span>Profil</span> Saya </h1>
      <div class="row">
        <img src="assets/images/user.png" style="width: 50%;object-fit: cover;" alt="Gambar Tidak Ditemukan">
        <form action="" method="POST">
          <div class="inputBox">
            <span class="fas fa-user"></span>
            <input type="text" name="username" value="<?= $row['username'] ?>" placeholder="Nama" required>
          </div>
          <div class="inputBox">
            <span class="fa fa-phone"></span>
            <input type="number" name="telp" value="<?= $row['telp'] ?>" placeholder="Telp">
          </div>
          <div class="inputBox">
            <span class="fa fa-map-marker"></span>
            <input type="text" name="alamat" value="<?= $row['alamat'] ?>" placeholder="alamat">
          </div>
          <div class="inputBox">
            <span class="fa fa-key"></span>
            <input type="password" name="password" placeholder="Password" required>
          </div>
          <input type="submit" name="ubah-profile" value="Ubah Profil" class="btn" style="color: #000;">
        </form>
      </div>
    </section>
  <?php endforeach; ?>
  <!-- contact section ends -->

  <!--Footer-->
  <?php require_once("resources/footer.php") ?>

</body>

</html>