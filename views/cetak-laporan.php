<?php require_once("../controller/script.php");
require_once("redirect.php");
if (!isset($_SESSION['data-cetak'])) {
  header("Location: ./");
  exit();
}
$_SESSION['page-name'] = "Cetak Laporan";
$_SESSION['page-url'] = "cetak-laporan";

$tanggal = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-cetak']['tanggal']))));
$tanggal_arr = explode("-", $tanggal);
$tahun = $tanggal_arr[0];
$bulan = $tanggal_arr[1];
$pemesanan = mysqli_query($conn, "SELECT pemesanan.*, ongkir.*, users.username, users.email, users.telp, menu.nama_makanan, menu.harga, menu.image, pemesanan_status.status_pemesanan 
  FROM pemesanan 
  JOIN ongkir ON pemesanan.id_pemesanan=ongkir.id_pemesanan 
  JOIN users ON pemesanan.id_user=users.id_user 
  JOIN menu ON pemesanan.id_menu=menu.id_menu 
  JOIN pemesanan_status ON pemesanan.id_status=pemesanan_status.id_status 
  WHERE YEAR(pemesanan.created_at) = $tahun AND MONTH(pemesanan.created_at) = $bulan
  ORDER BY pemesanan.id_pemesanan DESC
");

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan-pemesanan-" . $tanggal . ".xls");
?>

<center>
  <h3>Laporan Pembelian Sei Babi Om Ba'i</h3>
</center>
<table border="1">
  <thead>
    <tr align="center">
      <th>#Order ID</th>
      <th>Tgl Beli</th>
      <th>Status</th>
      <th>Nama Pembeli</th>
      <th>Menu</th>
      <th>Alamat</th>
      <th>Ekspedisi</th>
      <th>Estimasi</th>
      <th>Total Berat</th>
      <th>Harga</th>
      <th>Ongkos Kirim</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>
    <?php if (mysqli_num_rows($pemesanan) == 0) { ?>
      <tr>
        <th colspan="12">Belum ada data pemesanan</th>
      </tr>
      <?php } else if (mysqli_num_rows($pemesanan) > 0) {
      $no = 1;
      while ($row = mysqli_fetch_assoc($pemesanan)) { ?>
        <tr align="center">
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
    <?php $no++;
      }
    } ?>
  </tbody>
</table>