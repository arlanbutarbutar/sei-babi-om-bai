<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Dashboard";
$_SESSION["page-url"] = "./";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once("../resources/dash-header.php") ?>
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
  <div class="container-scroller">
    <?php require_once("../resources/dash-topbar.php") ?>
    <div class="container-fluid page-body-wrapper">
      <?php require_once("../resources/dash-sidebar.php") ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link action active ps-0" id="overview" data-bs-toggle="tab" role="tab" style="cursor: pointer;" aria-controls="overview" aria-selected="true">Ringkasan</a>
                    </li>
                  </ul>
                  <div>
                    <div class="btn-wrapper">
                      <a href="#" class="btn btn-primary text-white me-0 rounded-0" data-bs-toggle="modal" data-bs-target="#tambah"><i class="mdi mdi-download"></i> Export</a>
                    </div>
                  </div>
                </div>
                <?php if ($_SESSION['data-user']['role'] <= 2) { ?>
                  <div class="data-main"></div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header border-bottom-0 shadow">
                <h5 class="modal-title" id="exampleModalLabel">Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="" method="post">
                <div class="modal-body text-center">
                  <div class="mb-3">
                    <label for="tanggal" class="form-label">Pilih Bulan & Tahun</label>
                    <input type="month" name="tanggal" value="<?= date('Y-m')?>" class="form-control" id="tanggal" placeholder="Pilih Bulan & Tahun" required>
                  </div>
                </div>
                <div class="modal-footer border-top-0 justify-content-center">
                  <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" name="cetak-laporan" class="btn btn-primary btn-sm rounded-0 border-0">Cetak</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
        <script>
          $(document).ready(function() {
            $(".action").click(function() {
              var menu = $(this).attr("id");
              if (menu == "overview") {
                $(".data-main").load("overview.php");
              }
              if (menu == "maps") {
                $(".data-main").load("maps.php");
              }
            });
            $(".data-main").load("overview.php");
          });
        </script>
</body>

</html>