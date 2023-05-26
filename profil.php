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

  <div class="container-xxl bg-white p-0">
    <?php require_once("resources/navbar.php"); ?>
    <div class="container-xxl py-5 bg-dark hero-header mb-5">
      <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Profil</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-center text-uppercase">
            <li class="breadcrumb-item"><a href="./">Beranda</a></li>
            <li class="breadcrumb-item text-white active" aria-current="page">Profil Saya</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!-- Navbar & Hero End -->

  <!-- Profil Start -->
  <div class="container-xxl py-5">
    <div class="container">
      <?php foreach ($profile as $row) : ?>
        <div class="row g-4">
          <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
            <img src="assets/images/user.png" style="width: 100%;object-fit: cover;" alt="Gambar Tidak Ditemukan">
          </div>
          <div class="col-md-6">
            <div class="wow fadeInUp" data-wow-delay="0.2s">
              <form action="" method="POST">
                <div class="row g-3">
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="text" name="username" value="<?= $row['username'] ?>" class="form-control" id="name" placeholder="Nama">
                      <label for="name">Nama</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="number" name="telp" value="<?= $row['telp'] ?>" class="form-control" id="email" placeholder="Telp">
                      <label for="email">Telp</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating">
                      <input type="text" name="alamat" value="<?= $row['alamat'] ?>" class="form-control" id="subject" placeholder="Alamat">
                      <label for="subject">Alamat</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating">
                      <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                      <label for="password">Password</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <button name="ubah-profile" class="btn btn-primary w-100 py-3" type="submit">Ubah Profile</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <!-- Profil End -->

  <div style="margin-bottom: 100px;"></div>

  <!--Footer-->
  <?php require_once("resources/footer.php") ?>

</body>

</html>