<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Blog";
$_SESSION["page-url"] = "blog";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once("../resources/dash-header.php") ?>
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
                      <h3>Blog</h3>
                    </li>
                  </ul>
                  <div>
                    <div class="btn-wrapper">
                      <a href="#" class="btn btn-primary text-white me-0 btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</a>
                    </div>
                  </div>
                </div>
                <div class="card rounded-0 mt-3">
                  <div class="card-body table-responsive">
                    <table class="table table-striped table-hover table-borderless table-sm display" id="datatable">
                      <thead>
                        <tr>
                          <th scope="col" class="text-center">#</th>
                          <th scope="col" class="text-center">Judul</th>
                          <th scope="col" class="text-center">Konten</th>
                          <th scope="col" class="text-center">Penulis</th>
                          <th scope="col" class="text-center">Tgl Publish</th>
                          <th scope="col" class="text-center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (mysqli_num_rows($blog) > 0) {
                          $no = 1;
                          while ($row = mysqli_fetch_assoc($blog)) { ?>
                            <tr>
                              <th scope="row"><?= $no; ?></th>
                              <td><img src="<?= $row['image'] ?>" style="width: 50px;height: 50px;margin-right: 10px;" class="rounded-circle" alt="Profile Menu"> <?= $row["judul"] ?></td>
                              <td>
                                <button type="button" class="btn btn-link m-auto border-0" data-bs-toggle="modal" data-bs-target="#konten<?= $row['id'] ?>">
                                  Lihat
                                </button>
                                <div class="modal fade" id="konten<?= $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><?= $row["judul"] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <textarea class="form-control border-0 bg-transparent p-0" style="height: 300px;"><?= strip_tags($row["konten"]); ?></textarea>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td><?= $row["penulis"] ?></td>
                              <td>
                                <div class="badge badge-opacity-success">
                                  <?php $dateCreate = date_create($row["tanggal_publikasi"]);
                                  echo date_format($dateCreate, "d M Y"); ?>
                                </div>
                              </td>
                              <td class="d-flex justify-content-center">
                                <div class="col">
                                  <button type="button" class="btn btn-warning btn-sm text-white rounded-0 border-0" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#ubah<?= $row["id"] ?>">
                                    <i class="bi bi-pencil-square"></i>
                                  </button>
                                  <div class="modal fade" id="ubah<?= $row["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header border-bottom-0 shadow">
                                          <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $row["judul"] ?></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                          <div class="modal-body text-center">
                                            <div class="mb-3">
                                              <label for="avatar" class="form-label">Upload Gambar</label>
                                              <input type="file" name="avatar" class="form-control" id="avatar" placeholder="Upload Gambar">
                                            </div>
                                            <div class="mb-3">
                                              <label for="judul" class="form-label">Judul <small class="text-danger">*</small></label>
                                              <input type="text" name="judul" value="<?= $row['judul'] ?>" class="form-control text-center" id="judul" minlength="3" placeholder="Judul" required>
                                            </div>
                                            <div class="mb-3">
                                              <label for="konten" class="form-label">Konten <small class="text-danger">*</small></label>
                                              <textarea name="konten" class="form-control" id="edit-konten<?= $row['id']?>" style="height: 100px;" placeholder="Konten" maxlength="500" cols="30" rows="10" required><?= $row['konten'] ?></textarea>
                                              <script>
                                                CKEDITOR.replace('edit-konten<?= $row['id']?>');
                                              </script>
                                            </div>
                                            <div class="mb-3">
                                              <label for="penulis" class="form-label">Penulis <small class="text-danger">*</small></label>
                                              <input type="text" name="penulis" value="<?= $row['penulis'] ?>" class="form-control text-center" id="penulis" minlength="3" placeholder="Penulis" required>
                                            </div>
                                          </div>
                                          <div class="modal-footer justify-content-center border-top-0">
                                            <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                            <input type="hidden" name="avatarOld" value="<?= $row["image"] ?>">
                                            <button type="button" class="btn btn-secondary btn-sm rounded-0 border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" name="ubah-blog" class="btn btn-warning btn-sm rounded-0 border-0" style="height: 30px;">Ubah</button>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col">
                                  <button type="button" class="btn btn-danger btn-sm text-white rounded-0 border-0" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#hapus<?= $row["id"] ?>">
                                    <i class="bi bi-trash3"></i>
                                  </button>
                                  <div class="modal fade" id="hapus<?= $row["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header border-bottom-0 shadow">
                                          <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $row["judul"] ?></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                          Anda yakin ingin menghapus data ini?
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <button type="button" class="btn btn-secondary btn-sm rounded-0 border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                          <form action="" method="POST">
                                            <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                            <input type="hidden" name="avatarOld" value="<?= $row["image"] ?>">
                                            <button type="submit" name="hapus-blog" class="btn btn-danger btn-sm rounded-0 text-white border-0" style="height: 30px;">Hapus</button>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
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

        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header border-bottom-0 shadow">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Blog</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="" method="post" name="random_form" enctype="multipart/form-data">
                <div class="modal-body text-center">
                  <div class="mb-3">
                    <label for="avatar" class="form-label">Upload Gambar</label>
                    <input type="file" name="avatar" class="form-control" id="avatar" placeholder="Upload Gambar" required>
                  </div>
                  <div class="mb-3">
                    <label for="judul" class="form-label">Judul <small class="text-danger">*</small></label>
                    <input type="text" name="judul" class="form-control text-center" id="judul" minlength="3" placeholder="Judul" required>
                  </div>
                  <div class="mb-3">
                    <label for="konten" class="form-label">Konten <small class="text-danger">*</small></label>
                    <textarea name="konten" class="form-control" id="add-konten" style="height: 100px;" placeholder="Konten" maxlength="500" cols="30" rows="10" required></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis <small class="text-danger">*</small></label>
                    <input type="text" name="penulis" value="<?= $_SESSION['data-user']['username'] ?>" class="form-control text-center" id="penulis" minlength="3" placeholder="Penulis" required>
                  </div>
                </div>
                <div class="modal-footer border-top-0 justify-content-center">
                  <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" name="tambah-blog" class="btn btn-primary btn-sm rounded-0 border-0">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
        <script>
          CKEDITOR.replace('add-konten');
        </script>
</body>

</html>