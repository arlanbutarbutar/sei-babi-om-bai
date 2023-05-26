<?php require_once("../../../controller/script.php");
$_SESSION["page-name"] = "Pengiriman";
$_SESSION["page-url"] = "./";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once("../../../resources/header.php"); ?>
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
    <?php require_once("../../../resources/navbar.php"); ?>
    <div class="container-xxl py-5 bg-dark hero-header mb-5">
      <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Pengiriman</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-center text-uppercase">
            <li class="breadcrumb-item"><a href="./">Beranda</a></li>
            <li class="breadcrumb-item"><a href="#">Pay</a></li>
            <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
            <li class="breadcrumb-item text-white active" aria-current="page">Pengiriman</li>
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
            <img src="<?= $_SESSION['data-pesan']['image_url'] ?>" style="width: 100%;object-fit: cover;" alt="Gambar Tidak Ditemukan">
          </div>
          <div class="col-md-6">
            <div class="wow fadeInUp" data-wow-delay="0.2s">
              <h3>Masukan Alamat Penerima</h3>
              <form action="" method="POST">
                <div class="row g-3">
                  <div class="col-12">
                    <div class="form-floating">
                      <input type="text" name="alamat" value="<?= $row['alamat'] ?>" class="form-control" id="subject" placeholder="Masukkan alamat lengkap pengiriman">
                      <label for="subject">Alamat</label>
                    </div>
                  </div>
                  <div class="inputBox">
                    <select name="nama_provinsi" style="padding: 10px;width: 100%;font-size: 18px;" required></select>
                  </div>
                  <div class="inputBox">
                    <select name="nama_distrik" style="padding: 10px;width: 100%;font-size: 18px;" required></select>
                  </div>
                  <div class="inputBox">
                    <select name="nama_ekspedisi" style="padding: 10px;width: 100%;font-size: 18px;" required></select>
                  </div>
                  <div class="inputBox">
                    <select name="nama_paket" style="padding: 10px;width: 100%;font-size: 18px;" required></select>
                  </div>
                  <input type="hidden" name="pemesananID" value="<?= $_SESSION['data-pesan']['pemesananID'] ?>">
                  <input type="hidden" name="orderID" value="<?= $_SESSION['data-pesan']['orderID'] ?>">
                  <input type="hidden" name="menuID" value="<?= $_SESSION['data-pesan']['menuID'] ?>">
                  <input type="hidden" name="image_url" value="<?= $_SESSION['data-pesan']['image_url'] ?>">
                  <input type="hidden" name="jumlah" value="<?= $_SESSION['data-pesan']['jumlah'] ?>">
                  <input type="hidden" name="harga" value="<?= $_SESSION['data-pesan']['harga'] ?>">
                  <input type="hidden" name="username" value="<?= $_SESSION['data-pesan']['username'] ?>">
                  <input type="hidden" name="telp" value="<?= $_SESSION['data-pesan']['telp'] ?>">
                  <input type="hidden" name="totalberat" value="<?= $_SESSION['data-pesan']['jumlah'] * 1000; ?>">
                  <input type="hidden" name="provinsi">
                  <input type="hidden" name="distrik">
                  <input type="hidden" name="tipe">
                  <input type="hidden" name="kodepos">
                  <input type="hidden" name="ekspedisi">
                  <input type="hidden" name="paket">
                  <input type="hidden" name="ongkir">
                  <input type="hidden" name="estimasi">
                  <div class="col-12">
                    <button name="checkout" class="btn btn-primary w-100 py-3" type="submit">Checkout</button>
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
  <?php require_once("../../../resources/footer.php") ?>

  <script>
    $(document).ready(function() {
      $.ajax({
        type: 'post',
        url: 'dataprovinsi.php',
        success: function(hasil_provinsi) {
          $("select[name=nama_provinsi]").html(hasil_provinsi);
        }
      });

      $("select[name=nama_provinsi]").on("change", function() {
        // Ambil id_provinsi ynag dipilih (dari atribut pribadi)
        var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
        $.ajax({
          type: 'post',
          url: 'datadistrik.php',
          data: 'id_provinsi=' + id_provinsi_terpilih,
          success: function(hasil_distrik) {
            $("select[name=nama_distrik]").html(hasil_distrik);
          }
        })
      });

      $.ajax({
        type: 'post',
        url: 'jasaekspedisi.php',
        success: function(hasil_ekspedisi) {
          $("select[name=nama_ekspedisi]").html(hasil_ekspedisi);
        }
      });

      $("select[name=nama_ekspedisi]").on("change", function() {
        // Mendapatkan data ongkos kirim

        // Mendapatkan ekspedisi yang dipilih
        var ekspedisi_terpilih = $("select[name=nama_ekspedisi]").val();
        // Mendapatkan id_distrik yang dipilih
        var distrik_terpilih = $("option:selected", "select[name=nama_distrik]").attr("id_distrik");
        // Mendapatkan toatal berat dari inputan
        $total_berat = $("input[name=totalberat]").val();
        $.ajax({
          type: 'post',
          url: 'datapaket.php',
          data: 'ekspedisi=' + ekspedisi_terpilih + '&distrik=' + distrik_terpilih + '&berat=' + $total_berat,
          success: function(hasil_paket) {
            // console.log(hasil_paket);
            $("select[name=nama_paket]").html(hasil_paket);

            // Meletakkan nama ekspedisi terpilih di input ekspedisi
            $("input[name=ekspedisi]").val(ekspedisi_terpilih);
          }
        })
      });

      $("select[name=nama_distrik]").on("change", function() {
        var prov = $("option:selected", this).attr('nama_provinsi');
        var dist = $("option:selected", this).attr('nama_distrik');
        var tipe = $("option:selected", this).attr('tipe_distrik');
        var kodepos = $("option:selected", this).attr('kodepos');

        $("input[name=provinsi]").val(prov);
        $("input[name=distrik]").val(dist);
        $("input[name=tipe]").val(tipe);
        $("input[name=kodepos]").val(kodepos);
      });

      $("select[name=nama_paket]").on("change", function() {
        var paket = $("option:selected", this).attr("paket");
        var ongkir = $("option:selected", this).attr("ongkir");
        var etd = $("option:selected", this).attr("etd");

        $("input[name=paket]").val(paket);
        $("input[name=ongkir]").val(ongkir);
        $("input[name=estimasi]").val(etd);
      })
    });
  </script>

</body>

</html>