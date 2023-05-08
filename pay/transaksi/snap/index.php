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

  <!-- header section starts -->
  <?php require_once("../../../resources/navbar.php"); ?>
  <!-- header section ends -->

  <!-- contact section starts  -->
  <section class="contact" id="contact">
    <h1 class="heading"> <span>Pengiriman</h1>
    <div class="row">
      <img src="<?= $_SESSION['data-pesan']['image_url'] ?>" style="width: 100%;height: 500px;object-fit: cover;margin-bottom: 10px;" alt="Gambar Tidak Ditemukan">
      <form action="" method="post">
        <h3>Masukan Alamat Penerima</h3>
        <div class="inputBox">
          <textarea name="alamat" cols="30" rows="3" style="padding: 10px;width: 100%;font-size: 18px;" placeholder="Masukkan alamat lengkap pengiriman" required></textarea>
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
        <input type="hidden" name="totalberat" value="<?= $_SESSION['data-pesan']['jumlah'] * 1; ?>">
        <input type="hidden" name="provinsi">
        <input type="hidden" name="distrik">
        <input type="hidden" name="tipe">
        <input type="hidden" name="kodepos">
        <input type="hidden" name="ekspedisi">
        <input type="hidden" name="paket">
        <input type="hidden" name="ongkir">
        <input type="hidden" name="estimasi">
        <button type="submit" name="checkout" class="btn">Checkout</button>
      </form>
    </div>
  </section>
  <!-- contact section ends -->

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