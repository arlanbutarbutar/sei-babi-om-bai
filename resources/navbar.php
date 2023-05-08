<header class="header">
  <a href="<?= $baseURL?>/" class="logo">
    <img src="<?= $baseURL?>/assets/images/logo.png" alt="">
  </a>
  <nav class="navbar">
    <a href="<?= $baseURL?>/">.home</a>
    <a href="<?= $baseURL?>/about">.about</a>
    <a href="<?= $baseURL?>/menu">.menu</a>
    <a href="<?= $baseURL?>/kontak">.kontak</a>
    <?php if (!isset($_SESSION['data-user'])) { ?>
      <a href="<?= $baseURL?>/auth/" class="btn" style="color: #000;">.masuk</a>
    <?php } else { ?>
      <a href="<?= $baseURL?>/auth/signout" class="btn">Keluar</a>
    <?php } ?>
  </nav>
  <div class="icons">
    <?php if (isset($_SESSION['data-user'])) { ?>
      <div class="fas fa-shopping-cart" id="cart-btn" style="cursor: pointer;" onclick="window.location.href='<?= $baseURL?>/pemesanan'"></div>
    <?php } ?>
    <div class="fas fa-bars" id="menu-btn"></div>
  </div>
</header>