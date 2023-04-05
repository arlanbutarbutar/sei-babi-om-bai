<?php require_once("controller/script.php");
$_SESSION["page-name"] = "";
$_SESSION["page-url"] = "./";
?>

<!DOCTYPE html>
<html class="no-js" lang="">

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
  <div class="preloader">
    <div class="loaded">&nbsp;</div>
  </div>
  <header id="home" class="navbar-fixed-top">
    <div class="main_menu_bg">
      <div class="container">
        <div class="row">
          <nav class="navbar navbar-default">
            <div class="container-fluid">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./" style="color: #fff;font-weight: bold;font-size: 24px;">Sei Babi Om Ba'i</a>
              </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
              <?php require_once("resources/navbar.php"); ?>
              <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- End Header Section -->

  <section id="slider" class="slider">
    <div class="slider_overlay">
      <div class="container">
        <div class="row">
          <div class="main_slider text-center">
            <div class="col-md-12">
              <div class="main_slider_content wow zoomIn" data-wow-duration="1s">
                <h1>Sei Babi</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="tentang" class="abouts">
    <div class="container">
      <div class="row">
        <div class="abouts_content">
          <div class="col-md-6">
            <div class="single_abouts_text text-center wow slideInLeft" data-wow-duration="1s">
              <img src="assets/images/ab.jpg" alt="" />
            </div>
          </div>

          <div class="col-md-6">
            <div class="single_abouts_text wow slideInRight" style="color: #fff;" data-wow-duration="1s">
              <h4>Tentang Kami</h4>
              <h3>Sei Babi Om Ba'i</h3>
              <?php if (mysqli_num_rows($tentang) > 0) {
                $row = mysqli_fetch_assoc($tentang);
                echo $row['about_us'];
              } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="menu" class="features">
    <div class="slider_overlay">
      <div class="container">
        <div class="row">
          <div class="main_features_content_area wow fadeIn" data-wow-duration="3s">
            <div class="col-md-12">
              <div class="main_features_content text-left">
                <?php if (mysqli_num_rows($menu_makanan) > 0) {
                  while ($row = mysqli_fetch_assoc($menu_makanan)) { ?>
                    <div class="col-md-6" style="margin-bottom: 30px;">
                      <div class="single_features_text" style="width: 400px;color: #fff;">
                        <img src="<?= $row['image'] ?>" style="width: 100%;height: 200px;object-fit: cover;margin-bottom: 10px;" alt="Gambar Tidak Ditemukan">
                        <h3><?= $row['nama_makanan'] ?></h3>
                        <p><?= $row['deskripsi'] ?></p>
                        <p>Rp.<?= number_format($row['harga']) . "/" . $row['satuan'] ?></p>
                        <p>Stok <?= $row['stok'] ?> Kg</p>
                        <div class="d-flex" style="display: flex;">
                          <?php if (!isset($_SESSION['data-user'])) { ?>
                            <form action="" method="post">
                              <input type="hidden" name="id-menu" value="<?= $row['id_menu'] ?>">
                              <button type="submit" name="pesan-sekarang" class="btn btn-primary">Pesan Sekarang</button>
                            </form>
                            <?php } else {
                            if ($_SESSION['data-user']['role'] == 3) { ?>
                              <form action="" method="post">
                                <div class="d-flex" style="display: flex;">
                                  <div class="input-group">
                                    <input type="number" name="jumlah" value="1" class="form-control" placeholder="Jumlah" aria-describedby="basic-addon1" min="1" max="<?= $row['stok'] ?>" style="width: 100px;" required>
                                  </div>
                                  <input type="hidden" name="id-menu" value="<?= $row['id_menu'] ?>">
                                  <input type="hidden" name="harga" value="<?= $row['harga'] ?>">
                                  <button type="submit" name="pesan-sekarang" class="btn btn-primary">Pesan Sekarang</button>
                                  <button type="submit" name="tambah-keranjang" class="btn btn-success"><i class="bi bi-cart2"></i></button>
                                </div>
                              </form>
                          <?php }
                          } ?>
                        </div>
                      </div>
                    </div>
                <?php }
                } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--Footer-->
  <?php require_once("resources/footer.php") ?>
</body>

</html>