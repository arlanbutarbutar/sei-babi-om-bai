<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  <ul class="nav navbar-nav navbar-right">
    <li><a href="<?= $baseURL ?>/">Beranda</a></li>
    <li><a href="<?= $baseURL ?>/#tentang">Tentang</a></li>
    <li><a href="<?= $baseURL ?>/#menu">Menu</a></li>
    <?php if (isset($_SESSION['data-user'])) {
      if ($_SESSION['data-user']['role'] == 3) { ?>
        <li><a href="<?= $baseURL?>/keranjang"><i class="bi bi-cart2" style="font-size: 18px;"></i></a></li>
        <li class="dropdown">
          <button class="btn btn-default dropdown-toggle" style="border: 0px;outline: none;" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <img class="img-xs rounded-circle" src="<?= $baseURL ?>/assets/images/user.png" style="width: 30px;" alt="Profile image"> <?= $_SESSION["data-user"]["username"] ?>
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li>
              <a style="cursor: pointer;" onclick="window.location.href='<?= $baseURL ?>/profil'" class="dropdown-item p-3">
                <i class="bi bi-person text-primary me-2"></i> Profil Saya</a>
            </li>
            <li>
              <a style="cursor: pointer;" onclick="window.location.href='<?= $baseURL ?>/pemesanan'" class="dropdown-item p-3">
                <i class="bi bi-bag-check text-primary me-2"></i> Pemesanan</a>
            </li>
            <li role="separator" class="divider"></li>
            <li>
              <a style="cursor: pointer;" onclick="window.location.href='<?= $baseURL ?>/auth/signout'" class="dropdown-item border-bottom-0 p-3">
                <i class="bi bi-box-arrow-right text-primary me-2"></i> Keluar</a>
            </li>
          </ul>
        </li>
      <?php } else { ?>
        <li><a href="<?= $baseURL ?>/auth/signout" class="booking">Keluar</a></li>
      <?php }
    } else { ?>
      <li><a href="<?= $baseURL ?>/auth/" class="booking">Masuk</a></li>
    <?php } ?>
  </ul>
</div>