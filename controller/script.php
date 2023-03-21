<?php if (!isset($_SESSION[""])) {
  session_start();
}
error_reporting(~E_NOTICE & ~E_DEPRECATED);
require_once("db_connect.php");
require_once("functions.php");
if (isset($_SESSION["time-message"])) {
  if ((time() - $_SESSION["time-message"]) > 2) {
    if (isset($_SESSION["message-success"])) {
      unset($_SESSION["message-success"]);
    }
    if (isset($_SESSION["message-info"])) {
      unset($_SESSION["message-info"]);
    }
    if (isset($_SESSION["message-warning"])) {
      unset($_SESSION["message-warning"]);
    }
    if (isset($_SESSION["message-danger"])) {
      unset($_SESSION["message-danger"]);
    }
    if (isset($_SESSION["message-dark"])) {
      unset($_SESSION["message-dark"]);
    }
    unset($_SESSION["time-alert"]);
  }
}

$baseURL = "http://$_SERVER[HTTP_HOST]/apps/sei-babi-om-bai";

$tentang = mysqli_query($conn, "SELECT * FROM ui_about");
$menu_makanan = mysqli_query($conn, "SELECT * FROM menu WHERE id_status='2' ORDER BY id_menu DESC");

if (isset($_POST['contact'])) {
  if (contact($_POST) > 0) {
    $_SESSION["message-success"] = "Pesan kamu berhasil terkirim, kami akan menghubungi kamu melalui email.";
    $_SESSION["time-message"] = time();
    header("Location: " . $_SESSION["page-url"]);
    exit();
  }
}

if (!isset($_SESSION["data-user"])) {
  if (isset($_POST["masuk"])) {
    if (masuk($_POST) > 0) {
      if ($_SESSION['data-user']['role'] <= 2) {
        header("Location: ../views/");
        exit();
      }
      if ($_SESSION['data-user']['role'] == 3) {
        header("Location: ../");
        exit();
      }
    }
  }
  if (isset($_POST["daftar"])) {
    if (daftar($_POST) > 0) {
      $_SESSION["message-success"] = "Silakan cek email anda untuk verifikasi akun.";
      $_SESSION["time-message"] = time();
      header("Location: ./");
      exit();
    }
  }
  if (isset($_POST['pesan-sekarang'])) {
    $id_menu = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['id-menu']))));
    $_SESSION['data-pesan'] = [
      'menu' => $id_menu,
    ];
    header("Location: auth/");
    exit();
  }
}

if (isset($_SESSION["data-user"])) {
  $idUser = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION["data-user"]["id"]))));

  $profile = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$idUser'");
  if (isset($_POST["ubah-profile"])) {
    if (edit_profile($_POST) > 0) {
      $_SESSION["message-success"] = "Profil akun anda berhasil di ubah.";
      $_SESSION["time-message"] = time();
      header("Location: $baseURL/auth/signout");
      exit();
    }
  }

  if ($_SESSION['data-user']['role'] <= 2) {
    // Dasboard
    $count_users = mysqli_query($conn, "SELECT * FROM users WHERE id_role='3'");
    $count_users = mysqli_num_rows($count_users);
    $count_menu = mysqli_query($conn, "SELECT * FROM menu");
    $count_menu = mysqli_num_rows($count_menu);
    $count_pemesanan = mysqli_query($conn, "SELECT * FROM pemesanan");
    $count_pemesanan = mysqli_num_rows($count_pemesanan);
    $current_month = date('Y-m');
    $count_pendapatan = mysqli_query($conn, "SELECT SUM(total_harga) as total FROM pemesanan WHERE created_at LIKE '$current_month%'");
    if (mysqli_num_rows($count_pendapatan) == 0) {
      $total_pendapatan = "0";
    } else if (mysqli_num_rows($count_pendapatan) > 0) {
      $count_pendapatan = mysqli_fetch_assoc($count_pendapatan);
      $total_pendapatan = $count_pendapatan['total'];
    }
    $count_belum_bayar = mysqli_query($conn, "SELECT * FROM pemesanan WHERE id_status='1' OR id_status='2'");
    $count_belum_bayar = mysqli_num_rows($count_belum_bayar);
    $count_sudah_bayar = mysqli_query($conn, "SELECT * FROM pemesanan WHERE id_status='3'");
    $count_sudah_bayar = mysqli_num_rows($count_sudah_bayar);
    $count_kontak = mysqli_query($conn, "SELECT * FROM contact");
    $count_kontak = mysqli_num_rows($count_kontak);
    $pemesananDash = mysqli_query($conn, "SELECT pemesanan.*, users.username, users.email, users.telp, menu.*, pemesanan_status.status_pemesanan FROM pemesanan JOIN users ON pemesanan.id_user=users.id_user JOIN menu ON pemesanan.id_menu=menu.id_menu JOIN pemesanan_status ON pemesanan.id_status=pemesanan_status.id_status ORDER BY pemesanan.id_pemesanan DESC LIMIT 5");

    $users_role=mysqli_query($conn, "SELECT * FROM users_role");
    $users = mysqli_query($conn, "SELECT * FROM users JOIN users_role ON users.id_role=users_role.id_role WHERE users.id_user!='$idUser' ORDER BY users.id_user DESC");
    if (isset($_POST["tambah-user"])) {
      if (add_user($_POST) > 0) {
        $_SESSION["message-success"] = "Pengguna " . $_POST["username"] . " berhasil ditambahkan.";
        $_SESSION["time-message"] = time();
        header("Location: " . $_SESSION["page-url"]);
        exit();
      }
    }
    if (isset($_POST["ubah-user"])) {
      if (edit_user($_POST) > 0) {
        $_SESSION["message-success"] = "Pengguna " . $_POST["usernameOld"] . " berhasil diubah.";
        $_SESSION["time-message"] = time();
        header("Location: " . $_SESSION["page-url"]);
        exit();
      }
    }
    if (isset($_POST["hapus-user"])) {
      if (delete_user($_POST) > 0) {
        $_SESSION["message-success"] = "Pengguna " . $_POST["username"] . " berhasil dihapus.";
        $_SESSION["time-message"] = time();
        header("Location: " . $_SESSION["page-url"]);
        exit();
      }
    }

    $menu_status = mysqli_query($conn, "SELECT * FROM menu_status ORDER BY id_status DESC");
    $menu = mysqli_query($conn, "SELECT * FROM menu JOIN menu_status ON menu.id_status=menu_status.id_status");
    if (isset($_POST["tambah-menu"])) {
      if (add_menu($_POST) > 0) {
        $_SESSION["message-success"] = "Menu " . $_POST["nama"] . " berhasil ditambahkan.";
        $_SESSION["time-message"] = time();
        header("Location: " . $_SESSION["page-url"]);
        exit();
      }
    }
    if (isset($_POST["ubah-menu"])) {
      if (edit_menu($_POST) > 0) {
        $_SESSION["message-success"] = "Menu " . $_POST["namaOld"] . " berhasil diubah.";
        $_SESSION["time-message"] = time();
        header("Location: " . $_SESSION["page-url"]);
        exit();
      }
    }
    if (isset($_POST["hapus-menu"])) {
      if (delete_menu($_POST) > 0) {
        $_SESSION["message-success"] = "Menu " . $_POST["nama"] . " berhasil dihapus.";
        $_SESSION["time-message"] = time();
        header("Location: " . $_SESSION["page-url"]);
        exit();
      }
    }

    $pemesanan = mysqli_query($conn, "SELECT pemesanan.*, users.username, users.email, users.telp, menu.*, pemesanan_status.status_pemesanan FROM pemesanan JOIN users ON pemesanan.id_user=users.id_user JOIN menu ON pemesanan.id_menu=menu.id_menu JOIN pemesanan_status ON pemesanan.id_status=pemesanan_status.id_status ORDER BY pemesanan.id_pemesanan DESC");
    if (isset($_POST["ubah-pemesanan"])) {
      if (edit_pemesanan($_POST) > 0) {
        $_SESSION["message-success"] = "Pemesanan " . $_POST["nama"] . " berhasil diubah.";
        $_SESSION["time-message"] = time();
        header("Location: " . $_SESSION["page-url"]);
        exit();
      }
    }

    if (isset($_POST["ubah-tentang"])) {
      if (edit_tentang($_POST) > 0) {
        $_SESSION["message-success"] = "Tentang Sei Babi Om Ba'i berhasil diubah.";
        $_SESSION["time-message"] = time();
        header("Location: " . $_SESSION["page-url"]);
        exit();
      }
    }

    $kontak = mysqli_query($conn, "SELECT * FROM contact");
  }

  if ($_SESSION['data-user']['role'] == 3) {

    if (isset($_POST['pesan-sekarang'])) {
      $id_menu = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['id-menu']))));
      $jumlah = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['jumlah']))));
      $harga = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['harga']))));
      $orderID = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
      $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-user']['username']))));
      $telp = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-user']['telp']))));
      $alamat = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-user']['alamat']))));
      function hitungOngkir($jarak)
      {
        // Harga per kilometer
        $hargaPerKm = 1500;

        // Hitung ongkos kirim
        $ongkir = $jarak * $hargaPerKm;

        // Kembalikan hasil
        return $ongkir;
      }
      // latitude dan longitude dalam satu kalimat
      $latlon1 = "-10.2909434,123.7266022";

      // memisahkan nilai latitude1 dan longitude1
      list($lat1, $lon1) = explode(",", $latlon1);

      // Mengambil lokasi saat ini
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, 'https://ipinfo.io/' . $_SERVER["REMOTE_ADDR"] . '?token=7ac8e9c9be73ba');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $result = curl_exec($ch);
      if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
      }
      curl_close($ch);
      $geolocation_json = json_decode($result);
      $latlon2 = $geolocation_json->loc;

      // memisahkan nilai latitude2 dan longitude2
      list($lat2, $lon2) = explode(",", $latlon2);

      // jari-jari bumi dalam meter
      $R = 6371000;

      // menghitung perbedaan latitude dan longitude
      $dLat = deg2rad($lat2 - $lat1);
      $dLon = deg2rad($lon2 - $lon1);

      // menghitung jarak menggunakan formula Haversine
      $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
      $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
      $d = $R * $c;

      // hasil jarak dalam kilometer
      $d_km = $d / 1000;

      // Membulatkan hasil koma
      $num_rounded = round($d_km, 0);

      $jarak = $num_rounded; // Jarak dalam kilometer
      $ongkir = hitungOngkir($jarak);
      $total_harga = ($jumlah * $harga) + ($ongkir * $jumlah);

      mysqli_query($conn, "INSERT INTO pemesanan(id_order,id_menu,id_user,nama,alamat,jumlah,harga,ongkir,total_harga) VALUES('$orderID','$id_menu','$idUser','$username','$alamat','$jumlah','$harga','$ongkir','$total_harga')");
      if (isset($_POST['id-keranjang'])) {
        $id_keranjang = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['id-keranjang']))));
        mysqli_query($conn, "DELETE FROM keranjang WHERE id_keranjang='$id_keranjang'");
      }
      $_SESSION['data-pesan'] = [
        'orderID' => $orderID,
        'jumlah' => $jumlah,
        'total' => $total_harga,
        'username' => $username,
        'telp' => $telp,
      ];
      header("Location: pay/transaksi/snap/checkout");
      exit();
    }
    if (isset($_POST['tambah-keranjang'])) {
      $id_menu = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['id-menu']))));
      $jumlah = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['jumlah']))));
      $harga = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['harga']))));

      mysqli_query($conn, "INSERT INTO keranjang(id_user,id_menu,jumlah,harga) VALUES('$idUser','$id_menu','$jumlah','$harga')");
      $_SESSION["message-success"] = "Pesanan telah ditambahkan ke keranjang belanja.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }

    $keranjang = mysqli_query($conn, "SELECT * FROM keranjang JOIN menu ON keranjang.id_menu=menu.id_menu WHERE keranjang.id_user='$idUser' ORDER BY keranjang.id_keranjang DESC");
    if (isset($_POST['hapus-keranjang'])) {
      if (delete_keranjang($_POST) > 0) {
        $_SESSION["message-success"] = "Data keranjang berhasil dihapus.";
        $_SESSION["time-message"] = time();
        header("Location: " . $_SESSION["page-url"]);
        exit();
      }
    }

    $pemesanan = mysqli_query($conn, "SELECT pemesanan.*, pemesanan_status.status_pemesanan, menu.nama_makanan, menu.harga FROM pemesanan JOIN pemesanan_status ON pemesanan.id_status=pemesanan_status.id_status JOIN menu ON pemesanan.id_menu=menu.id_menu WHERE pemesanan.id_user='$idUser' ORDER BY pemesanan.id_pemesanan DESC");
    if (isset($_POST['hapus-pemesanan'])) {
      if (delete_pemesanan($_POST) > 0) {
        $_SESSION["message-success"] = "Data pemesanan berhasil dihapus.";
        $_SESSION["time-message"] = time();
        header("Location: " . $_SESSION["page-url"]);
        exit();
      }
    }
    if (isset($_POST['bayar-sekarang'])) {
      $id_order = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['id-order']))));
      $jumlah = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['jumlah']))));
      $total = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['total']))));
      $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-user']['username']))));
      $telp = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-user']['telp']))));

      $_SESSION['data-pesan'] = [
        'orderID' => $id_order,
        'jumlah' => $jumlah,
        'total' => $total,
        'username' => $username,
        'telp' => $telp,
      ];
      header("Location: pay/transaksi/snap/checkout");
      exit();
    }
  }
}
