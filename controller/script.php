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
$blogs = mysqli_query($conn, "SELECT * FROM blog");
$videos = mysqli_query($conn, "SELECT * FROM video");
$gallery = mysqli_query($conn, "SELECT * FROM gallery");
$menu_makanStay = mysqli_query($conn, "SELECT * FROM menu_ditempat");
$menu_makanSend = mysqli_query($conn, "SELECT * FROM menu WHERE id_status='2' ORDER BY id_menu DESC");

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
    $count_pemesanan = mysqli_query($conn, "SELECT pemesanan.*, ongkir.*, users.username, users.email, users.telp, menu.nama_makanan, menu.harga, menu.image, pemesanan_status.status_pemesanan 
    FROM pemesanan JOIN ongkir ON pemesanan.id_pemesanan=ongkir.id_pemesanan 
    LEFT JOIN users ON pemesanan.id_user=users.id_user 
    LEFT JOIN menu ON pemesanan.id_menu=menu.id_menu 
    LEFT JOIN pemesanan_status ON pemesanan.id_status=pemesanan_status.id_status 
    ORDER BY pemesanan.id_pemesanan DESC");
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
    $pemesananDash = mysqli_query($conn, "SELECT pemesanan.*, ongkir.*, users.username, users.email, users.telp, menu.nama_makanan, menu.harga, menu.image, pemesanan_status.status_pemesanan FROM pemesanan JOIN ongkir ON pemesanan.id_pemesanan=ongkir.id_pemesanan JOIN users ON pemesanan.id_user=users.id_user JOIN menu ON pemesanan.id_menu=menu.id_menu JOIN pemesanan_status ON pemesanan.id_status=pemesanan_status.id_status ORDER BY pemesanan.id_pemesanan DESC LIMIT 5");

    $users_role = mysqli_query($conn, "SELECT * FROM users_role");
    $users = mysqli_query($conn, "SELECT * FROM users JOIN users_role ON users.id_role=users_role.id_role WHERE users.id_user!='$idUser' ORDER BY users.id_user DESC");
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

    $menu_ditempat = mysqli_query($conn, "SELECT * FROM menu_ditempat");
    if (isset($_POST["tambah-menu-ditempat"])) {
      if (add_menu_ditempat($_POST) > 0) {
        $_SESSION["message-success"] = "Menu " . $_POST["nama"] . " berhasil ditambahkan.";
        $_SESSION["time-message"] = time();
        header("Location: " . $_SESSION["page-url"]);
        exit();
      }
    }
    if (isset($_POST["ubah-menu-ditempat"])) {
      if (edit_menu_ditempat($_POST) > 0) {
        $_SESSION["message-success"] = "Menu " . $_POST["namaOld"] . " berhasil diubah.";
        $_SESSION["time-message"] = time();
        header("Location: " . $_SESSION["page-url"]);
        exit();
      }
    }
    if (isset($_POST["hapus-menu-ditempat"])) {
      if (delete_menu_ditempat($_POST) > 0) {
        $_SESSION["message-success"] = "Menu " . $_POST["nama"] . " berhasil dihapus.";
        $_SESSION["time-message"] = time();
        header("Location: " . $_SESSION["page-url"]);
        exit();
      }
    }

    $pemesanan = mysqli_query($conn, "SELECT pemesanan.*, ongkir.*, users.username, users.email, users.telp, menu.nama_makanan, menu.harga, menu.image, pemesanan_status.status_pemesanan 
      FROM pemesanan JOIN ongkir ON pemesanan.id_pemesanan=ongkir.id_pemesanan 
      LEFT JOIN users ON pemesanan.id_user=users.id_user 
      LEFT JOIN menu ON pemesanan.id_menu=menu.id_menu 
      LEFT JOIN pemesanan_status ON pemesanan.id_status=pemesanan_status.id_status 
      ORDER BY pemesanan.id_pemesanan DESC
    ");

    if (isset($_POST["ubah-tentang"])) {
      if (edit_tentang($_POST) > 0) {
        $_SESSION["message-success"] = "Tentang Sei Babi Om Ba'i berhasil diubah.";
        $_SESSION["time-message"] = time();
        header("Location: " . $_SESSION["page-url"]);
        exit();
      }
    }

    $galeri = mysqli_query($conn, "SELECT * FROM gallery");
    if (isset($_POST["tambah-galeri"])) {
      if (add_galeri($_POST) > 0) {
        $_SESSION["message-success"] = "Gambar berhasil ditambah ke galeri.";
        $_SESSION["time-message"] = time();
        header("Location: " . $_SESSION["page-url"]);
        exit();
      }
    }
    if (isset($_POST["hapus-galeri"])) {
      if (delete_galeri($_POST) > 0) {
        $_SESSION["message-success"] = "Gambar berhasil dihapus ke galeri.";
        $_SESSION["time-message"] = time();
        header("Location: " . $_SESSION["page-url"]);
        exit();
      }
    }

    $blog = mysqli_query($conn, "SELECT * FROM blog");
    if (isset($_POST["tambah-blog"])) {
      if (add_blog($_POST) > 0) {
        $_SESSION["message-success"] = "Konten berhasil ditambah ke blog.";
        $_SESSION["time-message"] = time();
        header("Location: " . $_SESSION["page-url"]);
        exit();
      }
    }
    if (isset($_POST["ubah-blog"])) {
      if (edit_blog($_POST) > 0) {
        $_SESSION["message-success"] = "Konten berhasil diubah dari blog.";
        $_SESSION["time-message"] = time();
        header("Location: " . $_SESSION["page-url"]);
        exit();
      }
    }
    if (isset($_POST["hapus-blog"])) {
      if (delete_blog($_POST) > 0) {
        $_SESSION["message-success"] = "Konten berhasil dihapus dari blog.";
        $_SESSION["time-message"] = time();
        header("Location: " . $_SESSION["page-url"]);
        exit();
      }
    }

    $video = mysqli_query($conn, "SELECT * FROM video");
    if (isset($_POST["tambah-video"])) {
      if (add_video($_POST) > 0) {
        $_SESSION["message-success"] = "Video berhasil ditambahkan.";
        $_SESSION["time-message"] = time();
        header("Location: " . $_SESSION["page-url"]);
        exit();
      }
    }
    if (isset($_POST["hapus-video"])) {
      if (delete_video($_POST) > 0) {
        $_SESSION["message-success"] = "Video berhasil dihapus.";
        $_SESSION["time-message"] = time();
        header("Location: " . $_SESSION["page-url"]);
        exit();
      }
    }

    $kontak = mysqli_query($conn, "SELECT * FROM contact");

    if (isset($_POST['cetak-laporan'])) {
      $tanggal = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['tanggal']))));
      $_SESSION['data-cetak'] = ['tanggal' => $tanggal];
      header("Location: cetak-laporan");
      exit();
    }
  }

  if ($_SESSION['data-user']['role'] == 3) {

    if (isset($_POST['pesan-sekarang'])) {
      $id_menu = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['id-menu']))));
      $jumlah = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['jumlah']))));
      $harga = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['harga']))));
      $orderID = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
      $image_url = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['image_url']))));
      $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-user']['username']))));
      $telp = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-user']['telp']))));

      $checkID_pemesanan = mysqli_query($conn, "SELECT * FROM pemesanan ORDER BY id_pemesanan DESC LIMIT 1");
      if (mysqli_num_rows($checkID_pemesanan) > 0) {
        $row = mysqli_fetch_assoc($checkID_pemesanan);
        $id_pemesanan = $row['id_pemesanan'] + 1;
      } else {
        $id_pemesanan = 1;
      }

      mysqli_query($conn, "INSERT INTO pemesanan(id_pemesanan,id_order,id_menu,id_user,nama,jumlah,harga) VALUES('$id_pemesanan','$orderID','$id_menu','$idUser','$username','$jumlah','$harga')");
      if (isset($_POST['id-keranjang'])) {
        $id_keranjang = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['id-keranjang']))));
        mysqli_query($conn, "DELETE FROM keranjang WHERE id_keranjang='$id_keranjang'");
      }
      $_SESSION['data-pesan'] = [
        'pemesananID' => $id_pemesanan,
        'orderID' => $orderID,
        'menuID' => $id_menu,
        'image_url' => $image_url,
        'jumlah' => $jumlah,
        'harga' => $harga,
        'username' => $username,
        'telp' => $telp,
      ];
      header("Location: pay/transaksi/snap/");
      exit();
    }
    if (isset($_POST['checkout'])) {
      $pemesananID = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['pemesananID']))));
      $menuID = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['menuID']))));
      $jumlah = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['jumlah']))));
      $harga = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['harga']))));
      $orderID = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['orderID']))));
      $image_url = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['image_url']))));
      $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['username']))));
      $telp = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['telp']))));
      $alamat = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['alamat']))));
      $totalberat = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['totalberat']))));
      $provinsi = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['provinsi']))));
      $distrik = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['distrik']))));
      $tipe = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['tipe']))));
      $kodepos = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['kodepos']))));
      $ekspedisi = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['ekspedisi']))));
      $paket = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['paket']))));
      $ongkir = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['ongkir']))));
      $estimasi = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['estimasi']))));
      $totalharga = $jumlah * $harga + ($jumlah * $ongkir);
      mysqli_query($conn, "UPDATE pemesanan SET alamat='$alamat', total_harga='$totalharga' WHERE id_order='$orderID'");
      mysqli_query($conn, "INSERT INTO ongkir(id_pemesanan,alamat_pengirim,totalberat,provinsi,distrik,tipe,kodepos,ekspedisi,paket,ongkir,estimasi) VALUES('$pemesananID','$alamat','$totalberat','$provinsi','$distrik','$tipe','$kodepos','$ekspedisi','$paket','$ongkir','$estimasi')");
      $_SESSION['data-pesan'] = [
        'orderID' => $orderID,
        'menuID' => $id_menu,
        'image_url' => $image_url,
        'jumlah' => $jumlah,
        'total' => $totalharga,
        'username' => $username,
        'telp' => $telp,
      ];
      header("Location: checkout");
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

    $pemesanan = mysqli_query($conn, "SELECT pemesanan.*, ongkir.*, pemesanan_status.status_pemesanan, menu.nama_makanan, menu.harga, menu.image FROM pemesanan JOIN ongkir ON pemesanan.id_pemesanan=ongkir.id_pemesanan JOIN pemesanan_status ON pemesanan.id_status=pemesanan_status.id_status JOIN menu ON pemesanan.id_menu=menu.id_menu WHERE pemesanan.id_user='$idUser' ORDER BY pemesanan.id_pemesanan DESC");
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
      $id_menu = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['id-menu']))));
      $image_url = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['image_url']))));
      $jumlah = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['jumlah']))));
      $total = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['total']))));
      $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-user']['username']))));
      $telp = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-user']['telp']))));

      $_SESSION['data-pesan'] = [
        'orderID' => $id_order,
        'menuID' => $id_menu,
        'image_url' => $image_url,
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
