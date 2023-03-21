<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Tentang";
$_SESSION["page-url"] = "tentang";
?>

<!DOCTYPE html>
<html lang="en">

<head><?php require_once("../resources/dash-header.php") ?>
  <script src="../assets/ckeditor/ckeditor.js"></script>
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
  <div class="container-scroller">
    <?php require_once("../resources/dash-topbar.php") ?>
    <div class="container-fluid page-body-wrapper">
      <?php require_once("../resources/dash-sidebar.php") ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <h3>Tentang</h3>
                    </li>
                  </ul>
                </div>
                <div class="card rounded-0 mt-3">
                  <div class="card-body">
                    <?php if (mysqli_num_rows($tentang) > 0) {
                      $row = mysqli_fetch_assoc($tentang); ?>
                      <form action="" method="post">
                        <div class="mb-3">
                          <label for="about">Tentang Sei Babi Om Ba'i <small class="text-danger">*</small></label>
                          <textarea name="about" id="about" cols="30" rows="25" style="line-height: 20px;" class="form-control shadow" required><?= $row['about_us'] ?></textarea>
                        </div>
                        <button type="submit" name="ubah-tentang" class="btn btn-warning text-white me-0">Ubah</button>
                      </form>
                    <?php
                    } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
        <script>
          CKEDITOR.replace('about');
        </script>
</body>

</html>