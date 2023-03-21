<?php require_once("controller/script.php");
$_SESSION["page-name"] = "Profil Saya";
$_SESSION["page-url"] = "profil";
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
                <h1>Profil Saya</h1>
                <?php if (mysqli_num_rows($profile) > 0) {
                  while ($row = mysqli_fetch_assoc($profile)) { ?>
                    <form action="" method="post">
                      <div style="margin-top: 20px;">
                        <label for="username">Nama</label>
                        <input type="text" name="username" value="<?= $row["username"] ?>" class="form-control" style="width: 350px;margin: auto;color: #fff;" id="username" placeholder="Nama" required>
                      </div>
                      <div style="margin-top: 20px;">
                        <label for="password">Kata Sandi</label>
                        <input type="password" name="password" value="" class="form-control" style="width: 350px;margin: auto;color: #fff;" id="password" placeholder="Kata Sandi" required>
                      </div>
                      <div style="margin-top: 20px;">
                        <label for="telp">Telp</label>
                        <input type="number" name="telp" value="<?= $row['telp'] ?>" class="form-control" style="width: 350px;margin: auto;color: #fff;" id="telp" placeholder="Telp" maxlength="12" required>
                      </div>
                      <div style="margin-top: 20px;">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" class="form-control" style="width: 350px;height: 100px;margin: auto;color: #fff;" id="alamat" placeholder="Alamat" maxlength="200" cols="30" rows="10" required><?= $row['alamat'] ?></textarea>
                      </div>
                      <button type="submit" name="ubah-profile" class="btn btn-primary" style="margin-top: 30px;">Simpan</button>
                    </form>
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