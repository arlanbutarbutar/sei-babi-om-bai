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

  $putData = mysqli_query($conn, "SELECT * FROM pemesanan JOIN users ON pemesanan.id_user=users.id_user JOIN menu ON pemesanan.id_menu=menu.id_menu WHERE pemesanan.id_order='$orderID'");
  $row = mysqli_fetch_assoc($putData);
  $gross_amount = ($row['ongkir'] * $row['jumlah']) + $row['total_harga'];
}

Config::$serverKey = 'SB-Mid-server-ZYGeFl_4dueZejnTldp3KNRY';
Config::$clientKey = 'SB-Mid-client-GiTG0dW6tP1d6Ygd';
printExampleWarningMessage();
Config::$isSanitized = Config::$is3ds = true;

// Required
$transaction_details = array(
  'order_id' => $orderID,
  'gross_amount' => $gross_amount,
);
// Optional
$item_details = array(
  array(
    'id' => $row['id_menu'],
    'price' => $row['harga'] + $row['ongkir'],
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
<html>

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
                <a class="navbar-brand" href="<?= $baseURL ?>/" style="color: #fff;font-weight: bold;font-size: 24px;">Sei Babi Om Ba'i</a>
              </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
              <?php require_once("../../../resources/navbar.php"); ?>
              <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- End Header Section -->

  <section class="abouts">
    <div class="container">
      <div class="row">
        <div class="abouts_content">
          <div class="col-md-6">
            <div class="single_abouts_text text-center wow slideInLeft" data-wow-duration="1s">
              <img src="<?= $baseURL ?>/assets/images/photo.jpg" alt="" />
            </div>
          </div>

          <div class="col-md-6">
            <div class="single_abouts_text wow slideInRight" data-wow-duration="1s">
              <h3><?= $row['nama_makanan'] ?></h3>
              <button id="pay-button" class="btn btn-success" style="padding: 20px;font-size: 18px;">Lakukan Pembayaran Sekarang</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
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