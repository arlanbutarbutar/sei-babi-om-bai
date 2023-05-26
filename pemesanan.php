<?php require_once("controller/script.php");
$_SESSION["page-name"] = "Pemesanan";
$_SESSION["page-url"] = "pemesanan";
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
        <h1 class="display-3 text-white mb-3 animated slideInDown">Pemesanan</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-center text-uppercase">
            <li class="breadcrumb-item"><a href="./">Beranda</a></li>
            <li class="breadcrumb-item text-white active" aria-current="page">Pemesanan</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!-- Navbar & Hero End -->

  <!-- Pemesanan starts  -->
  <div class="container-xxl py-5">
    <div class="container">
      <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
        <h1 class="mb-5">Daftar Pemesanan</h1>
      </div>
      <div class="row g-4 shadow">
        <table class="table table-striped display" id="datatable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Status</th>
              <th scope="col">Menu</th>
              <th scope="col">Alamat</th>
              <th scope="col">Ekspedisi</th>
              <th scope="col">Estimasi</th>
              <th scope="col">Total Berat</th>
              <th scope="col">Harga</th>
              <th scope="col">Ongkos Kirim</th>
              <th scope="col">Total</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (mysqli_num_rows($pemesanan) > 0) {
              $no = 1;
              while ($row = mysqli_fetch_assoc($pemesanan)) { ?>
                <tr>
                  <th scope="row"><?= $no; ?></th>
                  <td><?= $row["status_pemesanan"] ?></td>
                  <td><?= $row["nama_makanan"] ?></td>
                  <td><?= $row['alamat_pengirim'] . ", " . $row['tipe'] . ", " . $row['distrik'] . ", " . $row['provinsi'] . ", (" . $row['kodepos'] . ")" ?></td>
                  <td><?= strtoupper($row["ekspedisi"]) . " " . $row['paket'] . " - " . $row['ongkir'] ?></td>
                  <td><?= $row["estimasi"] ?> hari</td>
                  <td><?= $row["jumlah"] ?>Kg</td>
                  <td>Rp.<?= number_format($row["harga"]) ?>/Kg</td>
                  <td>Rp.<?= number_format($row["ongkir"]) ?>/Kg</td>
                  <td>Rp.<?= number_format($row["total_harga"]) ?></td>
                  <td>
                    <?php if ($row['id_status'] == 1) { ?>
                      <form action="" method="post">
                        <input type="hidden" name="id-pemesanan" value="<?= $row['id_pemesanan'] ?>">
                        <input type="hidden" name="id-menu" value="<?= $row['id_menu'] ?>">
                        <input type="hidden" name="id-order" value="<?= $row['id_order'] ?>">
                        <input type="hidden" name="image_url" value="<?= $row['image'] ?>">
                        <input type="hidden" name="jumlah" value="<?= $row['jumlah'] ?>">
                        <input type="hidden" name="total" value="<?= $row['total_harga'] ?>">
                        <div style="display: flex;justify-content: end;">
                          <button type="submit" name="bayar-sekarang" class="btn btn-primary">Bayar</button>
                          <button type="submit" name="hapus-pemesanan" class="btn btn-danger"><i class="bi bi-trash3"></i></button>
                        </div>
                      </form>
                    <?php } else if ($row['id_status'] == 2) { ?>
                      <form action="" method="post">
                        <input type="hidden" name="id-pemesanan" value="<?= $row['id_pemesanan'] ?>">
                        <input type="hidden" name="id-menu" value="<?= $row['id_menu'] ?>">
                        <input type="hidden" name="id-order" value="<?= $row['id_order'] ?>">
                        <input type="hidden" name="image_url" value="<?= $row['image'] ?>">
                        <input type="hidden" name="jumlah" value="<?= $row['jumlah'] ?>">
                        <input type="hidden" name="total" value="<?= $row['total_harga'] ?>">
                        <div style="display: flex;justify-content: end;">
                          <button type="button" class="btn" style="background-color: #ffca2c;"><i class="bi bi-clock-history"></i></button>
                          <button type="submit" name="bayar-sekarang" class="btn btn-primary">Bayar</button>
                          <button type="submit" name="hapus-pemesanan" class="btn btn-danger"><i class="bi bi-trash3"></i></button>
                        </div>
                      </form>
                    <?php } else if ($row['id_status'] == 3) { ?>
                      <div style="display: flex;justify-content: end;">
                        <button type="button" class="btn btn-success"><i class="bi bi-bag-check"></i></button>
                      </div>
                    <?php } ?>
                  </td>
                </tr>
            <?php $no++;
              }
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Pemesanan ends -->

  <div style="margin-bottom: 100px;"></div>

  <!--Footer-->
  <?php require_once("resources/footer.php") ?>
</body>

</html>