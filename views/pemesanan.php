<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Pemesanan";
$_SESSION["page-url"] = "pemesanan";
?>

<!DOCTYPE html>
<html lang="en">

<head><?php require_once("../resources/dash-header.php") ?></head>

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
                      <h3>Pemesanan</h3>
                    </li>
                  </ul>
                </div>
                <?php if ($_SESSION['data-user']['role'] <= 2) { ?>
                  <div class="card rounded-0 mt-3">
                    <div class="card-body table-responsive">
                      <table class="table table-striped table-hover table-borderless table-sm display" id="datatable">
                        <thead>
                          <tr>
                            <th scope="col" class="text-center">#Order ID</th>
                            <th scope="col" class="text-center">Tgl Beli</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Nama Pembeli</th>
                            <th scope="col" class="text-center">Menu</th>
                            <th scope="col" class="text-center">Alamat</th>
                            <th scope="col" class="text-center">Ekspedisi</th>
                            <th scope="col" class="text-center">Estimasi</th>
                            <th scope="col" class="text-center">Total Berat</th>
                            <th scope="col" class="text-center">Harga</th>
                            <th scope="col" class="text-center">Ongkos Kirim</th>
                            <th scope="col" class="text-center">Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (mysqli_num_rows($pemesanan) > 0) {
                            while ($row = mysqli_fetch_assoc($pemesanan)) { ?>
                              <tr>
                                <th scope="row"><?= $row['id_order']; ?></th>
                                <td><?php $dateCreate = date_create($row["created_at"]);
                                    echo date_format($dateCreate, "l, d M Y h:i a"); ?></td>
                                <td><?= $row["status_pemesanan"] ?></td>
                                <td><?= $row["username"] ?><br>Email: <?= $row["email"] ?><br>Telp: <?= $row["telp"] ?><br>Alamat: <?= $row["alamat"] ?></td>
                                <td><?= $row["nama_makanan"] ?></td>
                                <td><?= $row['alamat_pengirim'] . ", " . $row['tipe'] . ", " . $row['distrik'] . ", " . $row['provinsi'] . ", (" . $row['kodepos'] . ")" ?></td>
                                <td><?= strtoupper($row["ekspedisi"]) . " " . $row['paket'] . " - Rp. " . number_format($row['ongkir']) ?></td>
                                <td><?= $row["estimasi"] ?> hari</td>
                                <td><?= $row["jumlah"] ?>Kg</td>
                                <td>Rp.<?= number_format($row["harga"]) ?>/Kg</td>
                                <td>Rp.<?= number_format($row["ongkir"]) ?>/Kg</td>
                                <td>Rp.<?= number_format($row["total_harga"]) ?></td>
                              </tr>
                          <?php }
                          } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>