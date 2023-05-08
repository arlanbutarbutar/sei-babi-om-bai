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

  <!-- header section starts -->
  <?php require_once("resources/navbar.php"); ?>
  <!-- header section ends -->

  <!-- contact section starts  -->
  <section class="contact" id="contact">
    <h1 class="heading"> <span>Daftar Pemesanan</h1>
    <div style="overflow-x: auto;">
      <table class="display" style="color: #fff;width: 1000px;">
        <thead>
          <tr>
            <th scope="col" style="text-align: center;font-size: 14px;">#</th>
            <th scope="col" style="text-align: center;font-size: 14px;">Status</th>
            <th scope="col" style="text-align: center;font-size: 14px;">Menu</th>
            <th scope="col" style="text-align: center;font-size: 14px;">Alamat</th>
            <th scope="col" style="text-align: center;font-size: 14px;">Ekspedisi</th>
            <th scope="col" style="text-align: center;font-size: 14px;">Estimasi</th>
            <th scope="col" style="text-align: center;font-size: 14px;">Total Berat</th>
            <th scope="col" style="text-align: center;font-size: 14px;">Harga</th>
            <th scope="col" style="text-align: center;font-size: 14px;">Ongkos Kirim</th>
            <th scope="col" style="text-align: center;font-size: 14px;">Total</th>
            <th scope="col" style="text-align: center;font-size: 14px;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (mysqli_num_rows($pemesanan) > 0) {
            $no = 1;
            while ($row = mysqli_fetch_assoc($pemesanan)) { ?>
              <tr>
                <th scope="row" style="font-size: 14px;"><?= $no; ?></th>
                <td style="text-align: center;font-size: 14px;"><?= $row["status_pemesanan"] ?></td>
                <td style="font-size: 14px;"><?= $row["nama_makanan"] ?></td>
                <td style="font-size: 14px;"><?= $row['alamat_pengirim'] . ", " . $row['tipe'] . ", " . $row['distrik'] . ", " . $row['provinsi'] . ", (" . $row['kodepos'] . ")" ?></td>
                <td style="font-size: 14px;"><?= strtoupper($row["ekspedisi"]) . " " . $row['paket'] . " - " . $row['ongkir'] ?></td>
                <td style="font-size: 14px;"><?= $row["estimasi"] ?> hari</td>
                <td style="text-align: center;font-size: 14px;"><?= $row["jumlah"] ?>Kg</td>
                <td style="font-size: 14px;">Rp.<?= number_format($row["harga"]) ?>/Kg</td>
                <td style="font-size: 14px;">Rp.<?= number_format($row["ongkir"]) ?>/Kg</td>
                <td style="font-size: 14px;">Rp.<?= number_format($row["total_harga"]) ?></td>
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
                        <button type="submit" name="bayar-sekarang" class="btn" style="background-color: #157347;">Bayar</button>
                        <button type="submit" name="hapus-pemesanan" class="btn" style="background-color: #bb2d3b;"><i class="bi bi-trash3"></i></button>
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
                        <button type="submit" name="bayar-sekarang" class="btn" style="background-color: #157347;">Bayar</button>
                        <button type="submit" name="hapus-pemesanan" class="btn" style="background-color: #bb2d3b;"><i class="bi bi-trash3"></i></button>
                      </div>
                    </form>
                  <?php } else if ($row['id_status'] == 3) { ?>
                    <div style="display: flex;justify-content: end;">
                      <button type="button" class="btn" style="background-color: #157347;"><i class="bi bi-bag-check"></i></button>
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
  </section>
  <!-- contact section ends -->

  <!--Footer-->
  <?php require_once("resources/footer.php") ?>
</body>

</html>