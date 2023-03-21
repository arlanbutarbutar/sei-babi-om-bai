<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Menu";
$_SESSION["page-url"] = "menu";
?>

<!DOCTYPE html>
<html lang="en">

<head><?php require_once("../resources/dash-header.php") ?></head>

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
                      <h3>Menu</h3>
                    </li>
                  </ul>
                  <div>
                    <div class="btn-wrapper">
                      <a href="#" class="btn btn-primary text-white me-0 btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</a>
                    </div>
                  </div>
                </div>
                <?php if ($_SESSION['data-user']['role'] <= 2) { ?>
                  <div class="card rounded-0 mt-3">
                    <div class="card-body table-responsive">
                      <table class="table table-striped table-hover table-borderless table-sm display" id="datatable">
                        <thead>
                          <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">Nama</th>
                            <th scope="col" class="text-center">Deskripsi</th>
                            <th scope="col" class="text-center">Harga</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Tgl Buat</th>
                            <th scope="col" class="text-center">Tgl Ubah</th>
                            <th scope="col" class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (mysqli_num_rows($menu) > 0) {
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($menu)) { ?>
                              <tr>
                                <th scope="row"><?= $no; ?></th>
                                <td><?= $row["nama_makanan"] ?></td>
                                <td><?= $row["deskripsi"] ?></td>
                                <td>Rp.<?= number_format($row["harga"]) ?></td>
                                <td><?= $row["status_menu"] ?></td>
                                <td>
                                  <div class="badge badge-opacity-success">
                                    <?php $dateCreate = date_create($row["created_at"]);
                                    echo date_format($dateCreate, "l, d M Y h:i a"); ?>
                                  </div>
                                </td>
                                <td>
                                  <div class="badge badge-opacity-warning">
                                    <?php $dateUpdate = date_create($row["updated_at"]);
                                    echo date_format($dateUpdate, "l, d M Y h:i a"); ?>
                                  </div>
                                </td>
                                <td class="d-flex justify-content-center">
                                  <div class="col">
                                    <button type="button" class="btn btn-warning btn-sm text-white rounded-0 border-0" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#ubah<?= $row["id_menu"] ?>">
                                      <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <div class="modal fade" id="ubah<?= $row["id_menu"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header border-bottom-0 shadow">
                                            <h5 class="modal-title" id="exampleModalLabel">Ubah menu <?= $row["nama_makanan"] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <form action="" method="POST">
                                            <div class="modal-body text-center">
                                              <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Makanan <small class="text-danger">*</small></label>
                                                <input type="text" name="nama" value="<?= $row['nama_makanan'] ?>" class="form-control text-center" id="nama" minlength="3" placeholder="Nama Makanan" required>
                                              </div>
                                              <div class="mb-3">
                                                <label for="deskripsi" class="form-label">Deskripsi <small class="text-danger">*</small></label>
                                                <textarea name="deskripsi" class="form-control" id="deskripsi" style="height: 100px;" placeholder="Deskripsi" maxlength="500" cols="30" rows="10" required><?= $row['deskripsi'] ?></textarea>
                                              </div>
                                              <div class="mb-3">
                                                <label for="harga" class="form-label">Harga <small class="text-danger">*</small></label>
                                                <input type="number" name="harga" value="<?= $row['harga'] ?>" class="form-control text-center" id="harga" min="0" placeholder="Harga" required>
                                              </div>
                                              <div class="mb-3">
                                                <label for="stok" class="form-label">Stok <span><small>(Dalam kg)</small></span><small class="text-danger">*</small></label>
                                                <input type="number" name="stok" value="<?= $row['stok'] ?>" class="form-control text-center" id="stok" min="0" placeholder="Stok" required>
                                              </div>
                                              <div class="mb-3">
                                                <label for="id-status" class="form-label">Status <small class="text-danger">*</small></label>
                                                <select name="id-status" class="form-select" required>
                                                  <?php foreach ($menu_status as $row_ms) : ?>
                                                    <option value="<?= $row_ms['id_status'] ?>"><?= $row_ms['status_menu'] ?></option>
                                                  <?php endforeach; ?>
                                                </select>
                                              </div>
                                            </div>
                                            <div class="modal-footer justify-content-center border-top-0">
                                              <input type="hidden" name="id-menu" value="<?= $row["id_menu"] ?>">
                                              <input type="hidden" name="namaOld" value="<?= $row["nama_makanan"] ?>">
                                              <button type="button" class="btn btn-secondary btn-sm rounded-0 border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                              <button type="submit" name="ubah-menu" class="btn btn-warning btn-sm rounded-0 border-0" style="height: 30px;">Ubah</button>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col">
                                    <button type="button" class="btn btn-danger btn-sm text-white rounded-0 border-0" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#hapus<?= $row["id_menu"] ?>">
                                      <i class="bi bi-trash3"></i>
                                    </button>
                                    <div class="modal fade" id="hapus<?= $row["id_menu"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header border-bottom-0 shadow">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus menu <?= $row["nama_makanan"] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body text-center">
                                            Anda yakin ingin menghapus <?= $row["nama_makanan"] ?> ini?
                                          </div>
                                          <div class="modal-footer justify-content-center border-top-0">
                                            <button type="button" class="btn btn-secondary btn-sm rounded-0 border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                            <form action="" method="POST">
                                              <input type="hidden" name="id-menu" value="<?= $row["id_menu"] ?>">
                                              <input type="hidden" name="namaOld" value="<?= $row["nama_makanan"] ?>">
                                              <button type="submit" name="hapus-menu" class="btn btn-danger btn-sm rounded-0 text-white border-0" style="height: 30px;">Hapus</button>
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
                <?php } ?>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header border-bottom-0 shadow">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="" method="post" name="random_form">
                <div class="modal-body text-center">
                  <div class="mb-3">
                    <label for="nama" class="form-label">Nama Makanan <small class="text-danger">*</small></label>
                    <input type="text" name="nama" class="form-control text-center" id="nama" minlength="3" placeholder="Nama Makanan" required>
                  </div>
                  <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi <small class="text-danger">*</small></label>
                    <textarea name="deskripsi" class="form-control" id="deskripsi" style="height: 100px;" placeholder="Deskripsi" maxlength="500" cols="30" rows="10" required></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="harga" class="form-label">Harga <small class="text-danger">*</small></label>
                    <input type="number" name="harga" class="form-control text-center" id="harga" min="0" placeholder="Harga" required>
                  </div>
                  <div class="mb-3">
                    <label for="stok" class="form-label">Stok <span><small>(Dalam kg)</small></span><small class="text-danger">*</small></label>
                    <input type="number" name="stok" class="form-control text-center" id="stok" min="0" placeholder="Stok" required>
                  </div>
                  <div class="mb-3">
                    <label for="id-status" class="form-label">Status <small class="text-danger">*</small></label>
                    <select name="id-status" class="form-select" required>
                      <?php foreach ($menu_status as $row_ms) : ?>
                        <option value="<?= $row_ms['id_status'] ?>"><?= $row_ms['status_menu'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="modal-footer border-top-0 justify-content-center">
                  <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" name="tambah-menu" class="btn btn-primary btn-sm rounded-0 border-0">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>