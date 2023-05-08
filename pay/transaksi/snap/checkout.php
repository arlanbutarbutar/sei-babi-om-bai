<?php

namespace Midtrans;

require_once dirname(__FILE__) . '/../../Midtrans.php';
require_once("../../../controller/script.php");

if (!isset($_SESSION['data-pesan']['orderID'])) {
  header("Location: $baseURL/pemesanan");
  exit();
} else {
  $orderID = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-pesan']['orderID']))));
  $jumlah = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-pesan']['jumlah']))));
  $total_harga = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-pesan']['total']))));
  $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-pesan']['username']))));
  $telp = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-pesan']['telp']))));

  $putData = mysqli_query($conn, "SELECT * FROM pemesanan JOIN ongkir ON pemesanan.id_pemesanan=ongkir.id_pemesanan JOIN users ON pemesanan.id_user=users.id_user JOIN menu ON pemesanan.id_menu=menu.id_menu WHERE pemesanan.id_order='$orderID'");
  $row = mysqli_fetch_assoc($putData);
  $harga = $row['harga'] + $row['ongkir'];
}

Config::$serverKey = 'SB-Mid-server-ZYGeFl_4dueZejnTldp3KNRY';
Config::$clientKey = 'SB-Mid-client-GiTG0dW6tP1d6Ygd';
printExampleWarningMessage();
Config::$isSanitized = Config::$is3ds = true;

// Required
$transaction_details = array(
  'order_id' => $orderID,
  'gross_amount' => $total_harga,
);
// Optional
$item_details = array(
  array(
    'id' => $row['id_menu'],
    'price' => $harga,
    'quantity' => $jumlah,
    'name' => $row['nama_makanan']
  ),
);
// Optional
$customer_details = array(
  'first_name'    => $username,
  'email'         => $row['email'],
  'phone'         => $row['telp'],
  'billing_address'  => $row['alamat'],
  'shipping_address' => $row['alamat']
);
// Fill transaction details
$transaction = array(
  'transaction_details' => $transaction_details,
  'customer_details' => $customer_details,
  'item_details' => $item_details,
);

$snap_token = '';
try {
  $snap_token = Snap::getSnapToken($transaction);
} catch (\Exception $e) {
  echo $e->getMessage();
}

function printExampleWarningMessage()
{
  if (strpos(Config::$serverKey, 'your ') != false) {
    echo "<code>";
    echo "<h4>Please set your server key from sandbox</h4>";
    echo "In file: " . __FILE__;
    echo "<br>";
    echo "<br>";
    echo htmlspecialchars('Config::$serverKey = \'SB-Mid-server-ZYGeFl_4dueZejnTldp3KNRY\';');
    die();
  }
}

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
    <h1 class="heading"> <span>Checkout</h1>
    <img src="<?= $_SESSION['data-pesan']['image_url'] ?>" style="width: 100%;height: 500px;object-fit: cover;margin-bottom: 10px;" alt="Gambar Tidak Ditemukan">
    <div>
      <h3 style="color: #fff;font-size: 32px;"><?= $row['nama_makanan'] ?></h3><br><br>
    </div>
    <div>
      <button id="pay-button" class="btn" style="color: #000;padding: 15px;font-size: 18px;">Bayar</button>
    </div>
  </section>
  <!-- contact section ends -->

  <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
  <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey; ?>"></script>
  <script type="text/javascript">
    document.getElementById('pay-button').onclick = function() {
      // SnapToken acquired from previous step
      snap.pay('<?= $snap_token ?>');
    };
  </script>

  <!--Footer-->
  <?php require_once("../../../resources/footer.php") ?>
</body>

</html>