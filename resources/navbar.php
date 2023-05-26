<!-- Spinner Start -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
  <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>
<!-- Spinner End -->

<!-- Navbar & Hero Start -->
<div class="container-xxl position-relative p-0">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
    <a href="<?= $baseURL ?>/" class="navbar-brand p-0">
      <img src="<?= $baseURL ?>/assets/images/logo.png" alt="">
      <!-- <img src="img/logo.png" alt="Logo"> -->
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <div class="navbar-nav ms-auto py-0 pe-4">
        <a href="<?= $baseURL ?>/" class="nav-item nav-link active">Beranda</a>
        <a href="<?= $baseURL ?>/tentang" class="nav-item nav-link">Tentang</a>
        <a href="<?= $baseURL ?>/menu" class="nav-item nav-link">Menu</a>
        <a href="<?= $baseURL ?>/blog" class="nav-item nav-link">Blog</a>
        <a href="<?= $baseURL ?>/video" class="nav-item nav-link">Video</a>
        <a href="<?= $baseURL ?>/kontak" class="nav-item nav-link">Kontak</a>
      </div>
      <?php if (!isset($_SESSION['data-user'])) { ?>
        <a href="<?= $baseURL ?>/auth/" class="btn btn-primary py-2 px-4">Masuk</a>
      <?php } else { ?>
        <div class="fas fa-shopping-cart text-white" id="cart-btn" style="cursor: pointer;" onclick="window.location.href='<?= $baseURL ?>/pemesanan'"></div>
        <style>
          .btn:focus,
          .btn:active {
            outline: none;
            box-shadow: none;
          }
        </style>

        <div class="btn-group dropstart">
          <button type="button" class="btn btn-link dropdown-toggle-no-caret rounded-circle" data-bs-toggle="dropdown">
            <img style="width: 40px;" src="<?= $baseURL ?>/assets/images/user.png" alt="">
          </button>
          <ul class="dropdown-menu">
            <a href="<?= $baseURL ?>/profil" class="nav-item nav-link">Profil Saya</a>
            <a href="<?= $baseURL ?>/auth/signout" class="nav-item nav-link">Keluar</a>
          </ul>
        </div>
      <?php } ?>
    </div>
  </nav>