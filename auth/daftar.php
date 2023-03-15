<?php require_once("../controller/script.php");
if (isset($_SESSION["data-user"])) {
  header("Location: ../views/");
  exit();
}
$_SESSION["page-name"] = "Daftar";
$_SESSION["page-url"] = "daftar";
?>
<!DOCTYPE html>
<html lang="en">

<head><?php require_once("../resources/auth-header.php") ?></head>

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
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-center py-5 px-4 px-sm-5 shadow">
              <h2>Se'i Babi Om Ba'i</h2>
              <h4>Daftar sekarang untuk mulai beli Se'i Babi.</h4>
              <p>Sudah punya akun? masuk <a href="./" class="text-decoration-none">disini</a></p>
              <form class="pt-3" action="" method="POST">
                <div class="form-group mt-3">
                  <label for="username">Username</label>
                  <input type="text" name="username" value="<?php if (isset($_POST['username'])) {
                                                              echo $_POST['username'];
                                                            } ?>" id="username" class="form-control text-center" placeholder="Username" required>
                </div>
                <div class="form-group mt-3">
                  <label for="email">Email</label>
                  <input type="email" name="email" value="<?php if (isset($_POST['email'])) {
                                                            echo $_POST['email'];
                                                          } ?>" id="email" class="form-control text-center" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <label for="password">Kata Sandi</label>
                  <input type="password" name="password" value="<?php if (isset($_POST['password'])) {
                                                                  echo $_POST['password'];
                                                                } ?>" id="password" class="form-control text-center" placeholder="Kata Sandi" min="8" required>
                </div>
                <div class="form-group">
                  <label for="telp">Telp</label>
                  <input type="number" name="telp" value="<?php if (isset($_POST['telp'])) {
                                                            echo $_POST['telp'];
                                                          } ?>" id="telp" class="form-control text-center" placeholder="Telp" maxlength="12" required>
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10" style="height: 100px;" placeholder="Alamat" maxlength="200" required><?php if (isset($_POST['alamat'])) {
                                                                                                                                                                              echo $_POST['alamat'];
                                                                                                                                                                            } ?></textarea>
                </div>
                <div class="mt-3">
                  <button type="submit" name="daftar" class="btn rounded-0 text-white" style="background-color: rgb(3, 164, 237);">Masuk</button>
                </div>
              </form>
              <p class="d-flex flex-nowrap justify-content-center mt-3">Kembali ke <a href="../" class="text-decoration-none" style="margin-left: 5px;">Beranda</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require_once("../resources/auth-footer.php") ?>
</body>

</html>