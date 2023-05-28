<?php require_once("controller/script.php");
$_SESSION["page-name"] = "Menu";
$_SESSION["page-url"] = "menu";
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
        <h1 class="display-3 text-white mb-3 animated slideInDown">Menu</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-center text-uppercase">
            <li class="breadcrumb-item"><a href="./">Beranda</a></li>
            <li class="breadcrumb-item text-white active" aria-current="page">Menu</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!-- Navbar & Hero End -->

  <!-- Menu Start -->
  <div class="container-xxl py-5">
    <div class="container">
      <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
        <h1 class="mb-5">Menu</h1>
      </div>
      <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
        <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
          <li class="nav-item">
            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
              <div class="ps-3">
                <h6 class="mt-n1 mb-0">Ditempat</h6>
              </div>
            </a>
          </li>
          <li class="nav-item">
            <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2">
              <div class="ps-3">
                <h6 class="mt-n1 mb-0">Pesan Antar</h6>
              </div>
            </a>
          </li>
        </ul>
        <div class="tab-content">
          <div id="tab-1" class="tab-pane fade show p-0 active">
            <div class="row g-4">
              <?php if (mysqli_num_rows($menu_makanStay) > 0) {
                while ($row_menuStay = mysqli_fetch_assoc($menu_makanStay)) { ?>
                  <div class="col-lg-6">
                    <div class="d-flex align-items-center">
                      <img class="flex-shrink-0 img-fluid rounded" src="<?= $row_menuStay['image'] ?>" alt="" style="width: 80px;">
                      <div class="w-100 d-flex flex-column text-start ps-4">
                        <h5 class="d-flex justify-content-between border-bottom pb-2">
                          <span><?= $row_menuStay['nama_menu'] ?></span>
                        </h5>
                        <a href="#" class="nav-link p-0 m-0" data-bs-toggle="modal" data-bs-target="#detail<?= $row_menuStay['id_menu_ditempat'] ?>">
                          Detail makanan
                        </a>
                        <div class="modal fade shadow" id="detail<?= $row_menuStay['id_menu_ditempat'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header bg-transparent border-bottom-0">
                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <img class="img-fluid" src="<?= $row_menuStay['image'] ?>" alt="" style="width: 100%;">
                                <h2 class="mt-3"><?= $row_menuStay['nama_menu'] ?></h2>
                                <p class="txt-dark" style="font-size: 16px;"><?= $row_menuStay['deskripsi'] ?></p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              <?php }
              } ?>
            </div>
          </div>
          <div id="tab-2" class="tab-pane fade show p-0">
            <div class="row g-4">
              <?php if (mysqli_num_rows($menu_makanSend) > 0) {
                while ($row_menuSend = mysqli_fetch_assoc($menu_makanSend)) { ?>
                  <div class="col-lg-6">
                    <div class="d-flex align-items-center">
                      <img class="flex-shrink-0 img-fluid rounded" src="<?= $row_menuSend['image'] ?>" alt="" style="width: 80px;">
                      <div class="w-100 d-flex flex-column text-start ps-4">
                        <h5 class="d-flex justify-content-between border-bottom pb-2">
                          <span><?= $row_menuSend['nama_makanan'] ?></span>
                          <span class="text-primary">Rp. <?= number_format($row_menuSend['harga']) ?></span>
                        </h5>
                        <div class="row">
                          <div class="col-lg-6">
                            <small class="fst-italic">Stok <?= $row_menuSend['stok'] ?> Kg</small>
                          </div>
                          <div class="col-lg-6">
                            <?php if (!isset($_SESSION['data-user'])) { ?>
                              <form action="" method="post">
                                <input type="hidden" name="id-menu" value="<?= $row_menuSend['id_menu'] ?>">
                                <button type="submit" name="pesan-sekarang" class="btn btn-primary">Pesan</button>
                              </form>
                              <?php } else {
                              if ($_SESSION['data-user']['role'] == 3) { ?>
                                <form action="" method="post">
                                  <div class="d-flex justify-content-end">
                                    <div class="inputBox">
                                      <input type="number" class="form-control" name="jumlah" value="1" placeholder="Jumlah" min="1" max="<?= $row_menuSend['stok'] ?>" style="width: 100px;" required>
                                    </div>
                                    <input type="hidden" name="id-menu" value="<?= $row_menuSend['id_menu'] ?>">
                                    <input type="hidden" name="image_url" value="<?= $row_menuSend['image'] ?>">
                                    <input type="hidden" name="harga" value="<?= $row_menuSend['harga'] ?>">
                                    <button type="submit" name="pesan-sekarang" class="btn btn-primary">Pesan</button>
                                  </div>
                                </form>
                            <?php }
                            } ?>
                          </div>
                        </div>
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
  <!-- Menu End -->

  <div style="margin-bottom: 100px;"></div>

  <!--Footer-->
  <?php require_once("resources/footer.php") ?>

</body>

</html>