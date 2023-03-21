<?php require_once("../controller/script.php");

// ambil data penjualan dari database
$sql = "SELECT YEAR(created_at) AS tahun, MONTH(created_at) AS bulan, SUM(total_harga) AS total FROM pemesanan GROUP BY YEAR(created_at), MONTH(created_at)";
$result = mysqli_query($conn, $sql);

// proses data penjualan
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
	$tahun = $row['tahun'];
	$bulan = $row['bulan'];
	$total = $row['total'];
	$data[$tahun][$bulan] = $total;
}

// buat array untuk label bulan dan data penjualan
$labels = array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des');
$datasets = array();
foreach ($data as $tahun => $bulan_data) {
	$penjualan = array();
	for ($i = 1; $i <= 12; $i++) {
		if (isset($bulan_data[$i])) {
			$penjualan[] = $bulan_data[$i];
		} else {
			$penjualan[] = 0;
		}
	}
	$datasets[] = array(
		'label' => $tahun,
		'data' => $penjualan,
		'backgroundColor' => 'rgba(2, 80, 196, 0.2)',
		'borderColor' => 'rgba(2, 80, 196, 1)',
		'borderWidth' => 1
	);
}