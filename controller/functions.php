<?php
function contact($data)
{
  global $conn;
  $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
  $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
  $subjects = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['subject']))));
  $messages = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['message']))));

  require("mail-visitor.php");
  // $to       = 'erinotemusu2506@gmail.com';
  $to       = 'arlan270899@gmail.com';
  $subject  = "Ada kontak dari Sei Babi Om Ba'i menunggumu!!";
  $message  = "<!doctype html>
  <html>
    <head>
      <meta name='viewport' content='width=device-width'>
      <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
      <title></title>
    </head>
    <body>
      <h2>" . $subjects . "</h2>
      <p>Dear admin,</p>
      <p>Saya menghubungi anda untuk mengatakan '" . $messages . "'</p><br><br>
      <p>Salam hangat,</p>
      <p>" . $nama . "</p>
      <p>" . $email . "</p>
    </body>
  </html>";
  smtp_mail($to, $subject, $message, '', '', 0, 0, true);

  mysqli_query($conn, "INSERT INTO contact(name,email,subject,message) VALUES('$nama','$email','$subjects','$messages')");
  return mysqli_affected_rows($conn);
}
if (!isset($_SESSION["data-user"])) {
  function masuk($data)
  {
    global $conn;
    $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["email"]))));
    $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["password"]))));

    // check account
    $checkAccount = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($checkAccount) == 0) {
      $_SESSION["message-danger"] = "Maaf, akun yang anda masukan belum terdaftar.";
      $_SESSION["time-message"] = time();
      return false;
    } else if (mysqli_num_rows($checkAccount) > 0) {
      $row = mysqli_fetch_assoc($checkAccount);
      if ($row['id_status'] == 1) {
        if (password_verify($password, $row["password"])) {
          $_SESSION["data-user"] = [
            "id" => $row["id_user"],
            "role" => $row["id_role"],
            "email" => $row["email"],
            "username" => $row["username"],
            "telp" => $row["telp"],
            "alamat" => $row["alamat"],
          ];
        } else {
          $_SESSION["message-danger"] = "Maaf, kata sandi yang anda masukan salah.";
          $_SESSION["time-message"] = time();
          return false;
        }
      } else {
        $_SESSION["message-danger"] = "Maaf, akun anda belum diverifikasi.";
        $_SESSION["time-message"] = time();
        return false;
      }
    }
  }
  function daftar($data)
  {
    global $conn;
    $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['username']))));
    $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
    $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));
    $telp = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['telp']))));
    $alamat = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['alamat']))));

    $password = password_hash($password, PASSWORD_DEFAULT);
    $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($checkEmail) > 0) {
      $_SESSION["message-danger"] = "Maaf, akun yang anda masukan sudah terdaftar.";
      $_SESSION["time-message"] = time();
      return false;
    } else {
      $auth = password_hash($email, PASSWORD_DEFAULT);
      $en_user = crc32($email);
      require("mail.php");
      $to       = $email;
      $subject  = "Verifikasi Akun di Sei Babi Om Ba'i kamu sekarang!!";
      $message  = "<!doctype html>
      <html>
        <head>
          <meta name='viewport' content='width=device-width'>
          <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
          <title>Verifikasi Akun</title>
        </head>
        <body>
          <p>Selamat akun anda sudah terdaftar, tinggal satu langkah lagi anda sudah bisa menggunakan akun anda. Silakan verifikasi sekarang dengan mengklik tautan di bawah ini.</p>
          <a href='https://erin.tugasakhir.my.id/auth/index?auth=" . $auth . "&crypt=" . $en_user . "' target='_blank' style='background-color: #ffffff; border: solid 1px #000; border-radius: 5px; box-sizing: border-box; cursor: pointer; display: inline-block; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-decoration: none; text-transform: capitalize; border-color: #000; color: #000;'>Verifikasi Sekarang</a>
        </body>
      </html>";
      smtp_mail($to, $subject, $message, '', '', 0, 0, true);

      mysqli_query($conn, "INSERT INTO users(en_user,username,email,password,telp,alamat) VALUES('$en_user','$username','$email','$password','$telp','$alamat')");
      return mysqli_affected_rows($conn);
    }
  }
}
if (isset($_SESSION["data-user"])) {
  function edit_profile($data)
  {
    global $conn, $idUser;
    $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["username"]))));
    $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["password"]))));
    $password = password_hash($password, PASSWORD_DEFAULT);
    $telp = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['telp']))));
    $alamat = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['alamat']))));
    mysqli_query($conn, "UPDATE users SET username='$username', password='$password', telp='$telp', alamat='$alamat', updated_at=CURRENT_TIMESTAMP WHERE id_user='$idUser'");
    return mysqli_affected_rows($conn);
  }
  if ($_SESSION['data-user']['role'] <= 2) {
    function edit_user($data)
    {
      global $conn;
      $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["id-user"]))));
      $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["username"]))));
      $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["email"]))));
      $emailOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["emailOld"]))));
      if ($email != $emailOld) {
        $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        if (mysqli_num_rows($checkEmail) > 0) {
          $_SESSION["message-danger"] = "Maaf, email yang anda masukan sudah terdaftar.";
          $_SESSION["time-message"] = time();
          return false;
        }
      }
      $id_role=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-role']))));
      mysqli_query($conn, "UPDATE users SET id_role='$id_role', username='$username', email='$email', updated_at=CURRENT_TIMESTAMP WHERE id_user='$id_user'");
      return mysqli_affected_rows($conn);
    }
    function delete_user($data)
    {
      global $conn;
      $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["id-user"]))));
      mysqli_query($conn, "DELETE FROM pemesanan WHERE id_user='$id_user'");
      mysqli_query($conn, "DELETE FROM keranjang WHERE id_user='$id_user'");
      mysqli_query($conn, "DELETE FROM users WHERE id_user='$id_user'");
      return mysqli_affected_rows($conn);
    }
    function add_menu($data)
    {
      global $conn;
      $id_status = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-status']))));
      $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
      $deskripsi = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['deskripsi']))));
      $harga = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['harga']))));
      $stok = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['stok']))));

      mysqli_query($conn, "INSERT INTO menu(id_status,nama_makanan,deskripsi,harga,stok) VALUES('$id_status','$nama','$deskripsi','$harga','$stok')");
      return mysqli_affected_rows($conn);
    }
    function edit_menu($data)
    {
      global $conn;
      $id_menu = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-menu']))));
      $id_status = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-status']))));
      $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
      $deskripsi = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['deskripsi']))));
      $harga = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['harga']))));
      $stok = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['stok']))));

      mysqli_query($conn, "UPDATE menu SET id_status='$id_status', nama_makanan='$nama', deskripsi='$deskripsi', harga='$harga', stok='$stok', updated_at=CURRENT_TIMESTAMP WHERE id_menu='$id_menu'");
      return mysqli_affected_rows($conn);
    }
    function delete_menu($data)
    {
      global $conn;
      $id_menu = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-menu']))));
      mysqli_query($conn, "DELETE FROM menu WHERE id_menu='$id_menu'");
      return mysqli_affected_rows($conn);
    }
    function edit_tentang($data)
    {
      global $conn;
      $about = $data['about'];
      mysqli_query($conn, "UPDATE ui_about SET about_us='$about'");
      return mysqli_affected_rows($conn);
    }
  } else if ($_SESSION['data-user']['role'] == 3) {
    function delete_keranjang($data)
    {
      global $conn;
      $id_keranjang = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-keranjang']))));
      mysqli_query($conn, "DELETE FROM keranjang WHERE id_keranjang='$id_keranjang'");
      return mysqli_affected_rows($conn);
    }
    function delete_pemesanan($data)
    {
      global $conn;
      $id_pemesanan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-pemesanan']))));
      mysqli_query($conn, "DELETE FROM pemesanan WHERE id_pemesanan='$id_pemesanan'");
      return mysqli_affected_rows($conn);
    }
  }
}
