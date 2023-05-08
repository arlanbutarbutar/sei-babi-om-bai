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

  <!-- menu section ends -->
  <section class="products" id="products">
    <h1 class="heading"> Menu Makan <span>Ditempat</span> </h1>
    <div class="box-container">
      <?php if (mysqli_num_rows($menu_makanStay) > 0) {
        while ($row = mysqli_fetch_assoc($menu_makanStay)) { ?>
          <div class="box">
            <div class="image">
              <img src="<?= $row['image'] ?>" style="width: 100%;height: 300px;object-fit: cover;margin-bottom: 10px;" alt="Gambar Tidak Ditemukan">
            </div>
            <div class="content">
              <h3><?= $row['nama_makanan'] ?></h3>
            </div>
          </div>
      <?php }
      } ?>
    </div>
  </section>

  <!-- menu section starts  -->
  <section class="menu" id="menu">
    <h1 class="heading"> Menu <span>Pesan Antar</span> </h1>
    <div class="box-container">
      <?php if (mysqli_num_rows($menu_makanSend) > 0) {
        while ($row = mysqli_fetch_assoc($menu_makanSend)) { ?>
          <div class="box">
            <img src="<?= $row['image'] ?>" style="width: 100%;height: 300px;object-fit: cover;margin-bottom: 10px;" alt="Gambar Tidak Ditemukan">
            <h3><?= $row['nama_makanan'] ?></h3>
            <h3 style="font-size: 16px;"><?= $row['deskripsi'] ?></h3>
            <div class="price">Rp.<?= number_format($row['harga']) . "/<span>" . $row['satuan'] ?>20.99</span></div>
            <h3 style="font-size: 16px;">Stok <?= $row['stok'] ?> Kg</h3>
            <?php if (!isset($_SESSION['data-user'])) { ?>
              <form action="" method="post">
                <input type="hidden" name="id-menu" value="<?= $row['id_menu'] ?>">
                <button type="submit" name="pesan-sekarang" class="btn">Pesan</button>
              </form>
              <?php } else {
              if ($_SESSION['data-user']['role'] == 3) { ?>
                <form action="" method="post">
                  <div class="inputBox">
                    <input type="number" name="jumlah" value="1" placeholder="Jumlah" min="1" max="<?= $row['stok'] ?>" style="width: 100px;" required>
                  </div>
                  <input type="hidden" name="id-menu" value="<?= $row['id_menu'] ?>">
                  <input type="hidden" name="image_url" value="<?= $row['image'] ?>">
                  <input type="hidden" name="harga" value="<?= $row['harga'] ?>">
                  <button type="submit" name="pesan-sekarang" class="btn">Pesan</button>
                </form>
            <?php }
            } ?>
          </div>
      <?php }
      } ?>
    </div>
  </section>

  <!--Footer-->
  <?php require_once("resources/footer.php") ?>

</body>

</html>