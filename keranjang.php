<?php require_once("controller/script.php");
$_SESSION["page-name"] = "Keranjang";
$_SESSION["page-url"] = "keranjang";
?>

<!DOCTYPE html>
<html class="no-js" lang="">

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
                <a class="navbar-brand" href="./" style="color: #fff;font-weight: bold;font-size: 24px;">Sei Babi Om Ba'i</a>
              </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
              <?php require_once("resources/navbar.php"); ?>
              <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- End Header Section -->

  <section id="slider" class="slider">
    <div class="slider_overlay">
      <div class="container">
        <div class="row">
          <div class="main_slider text-center">
            <div class="col-md-12">
              <div class="main_slider_content wow zoomIn" data-wow-duration="1s">
                <h1>Keranjang</h1>
                <div class="panel panel-default">
                  <!-- Default panel contents -->
                  <div class="panel-heading">Daftar Keranjang</div>

                  <!-- Table -->
                  <table class="table table-striped table-hover table-borderless table-sm display" style="color: #000;" id="datatable">
                    <thead>
                      <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Menu</th>
                        <th scope="col" class="text-center">Jumlah</th>
                        <th scope="col" class="text-center">Harga</th>
                        <th scope="col" class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (mysqli_num_rows($keranjang) > 0) {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($keranjang)) { ?>
                          <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $row["nama_makanan"] ?></td>
                            <td><?= $row["jumlah"] ?>Kg</td>
                            <td>Rp.<?= number_format($row["harga"]) ?>/Kg</td>
                            <td>
                              <form action="" method="post">
                                <input type="hidden" name="id-keranjang" value="<?= $row['id_keranjang'] ?>">
                                <input type="hidden" name="id-menu" value="<?= $row['id_menu'] ?>">
                                <input type="hidden" name="harga" value="<?= $row['harga'] ?>">
                                <input type="hidden" name="jumlah" value="<?= $row['jumlah'] ?>">
                                <button type="submit" name="pesan-sekarang" class="btn btn-primary">Pesan Sekarang</button>
                                <button type="submit" name="hapus-keranjang" class="btn btn-danger"><i class="bi bi-trash3"></i></button>
                              </form>
                            </td>
                          </tr>
                      <?php $no++;
                        }
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--Footer-->
  <?php require_once("resources/footer.php") ?>
</body>

</html>