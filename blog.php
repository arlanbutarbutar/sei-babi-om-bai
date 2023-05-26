<?php require_once("controller/script.php");
$_SESSION["page-name"] = "Blog";
$_SESSION["page-url"] = "blog";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once("resources/header.php"); ?>
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

  <div class="container-xxl bg-white p-0">
    <?php require_once("resources/navbar.php"); ?>
    <div class="container-xxl py-5 bg-dark hero-header mb-5">
      <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Blog</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-center text-uppercase">
            <li class="breadcrumb-item"><a href="./">Beranda</a></li>
            <li class="breadcrumb-item text-white active" aria-current="page">Blog</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!-- Navbar & Hero End -->

  <!-- BLog Start -->
  <div class="container-xxl py-5">
    <div class="container">
      <div class="row g-4">
        <?php if (mysqli_num_rows($blogs) > 0) {
          while ($row = mysqli_fetch_assoc($blogs)) { ?>
            <div class="col-sm-12">
              <div class="card mb-3">
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="<?= $row['image'] ?>" class="img-fluid rounded-start" alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h3 class="card-title"><?= $row['judul'] ?></h3>
                      <?= $row['konten'] ?>
                      <p class="card-text mt-3"><small class="text-muted">Terakhir diperbarui
                          <?php $dateCreate = date_create($row["tanggal_publikasi"]);
                          echo date_format($dateCreate, "d M Y"); ?> oleh penulis <strong><?= $row['penulis']?></strong></small></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        <?php }
        } ?>
      </div>
    </div>
  </div>
  <!-- Blog End -->

  <div style="margin-bottom: 100px;"></div>

  <!--Footer-->
  <?php require_once("resources/footer.php") ?>

</body>

</html>