<nav class="sidebar sidebar-offcanvas shadow-lg" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link text-dark" style="cursor: pointer;" onclick="window.location.href='./'">
        <i class="mdi mdi-grid-large menu-icon" style="color: #0d6efd;"></i>
        <span class="menu-title" style="color: #0d6efd;">Dashboard</span>
      </a>
    </li>
    <?php if ($_SESSION['data-user']['role'] == 1) { ?>
      <li class="nav-item nav-category text-dark" style="border-bottom: 1px solid #C2C2C2;">Kelola Pengguna</li>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='users'">
          <i class="mdi mdi-account-multiple-outline menu-icon" style="color: #0d6efd;"></i>
          <span class="menu-title" style="color: #0d6efd;">Users</span>
        </a>
      </li>
    <?php }
    if ($_SESSION['data-user']['role'] <= 2) { ?>
      <li class="nav-item nav-category text-dark" style="border-bottom: 1px solid #C2C2C2;">Kelola Penjualan</li>
    <?php } ?>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='menu'">
        <i class="mdi mdi-food-variant menu-icon" style="color: #0d6efd;"></i>
        <span class="menu-title" style="color: #0d6efd;">Menu</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='menu-ditempat'">
        <i class="mdi mdi-food-variant menu-icon" style="color: #0d6efd;"></i>
        <span class="menu-title" style="color: #0d6efd;">Menu Ditempat</span>
      </a>
    </li>
    <?php if ($_SESSION['data-user']['role'] == 3) { ?>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='keranjang'">
          <i class="mdi mdi-cart-outline menu-icon" style="color: #0d6efd;"></i>
          <span class="menu-title" style="color: #0d6efd;">Keranjang</span>
        </a>
      </li>
    <?php } ?>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='pemesanan'">
        <i class="mdi mdi-cart-plus menu-icon" style="color: #0d6efd;"></i>
        <span class="menu-title" style="color: #0d6efd;">Pemesanan</span>
      </a>
    </li>
    <li class="nav-item nav-category text-dark" style="border-bottom: 1px solid #C2C2C2;">Kelola Lainnya</li>
    <?php if ($_SESSION['data-user']['role'] <= 2) { ?>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='tentang'">
          <i class="mdi mdi-face menu-icon" style="color: #0d6efd;"></i>
          <span class="menu-title" style="color: #0d6efd;">Tentang</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='galeri'">
          <i class="mdi mdi-file-image menu-icon" style="color: #0d6efd;"></i>
          <span class="menu-title" style="color: #0d6efd;">Galeri</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='blog'">
          <i class="mdi mdi-blogger menu-icon" style="color: #0d6efd;"></i>
          <span class="menu-title" style="color: #0d6efd;">Blog</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='video'">
          <i class="mdi mdi-video menu-icon" style="color: #0d6efd;"></i>
          <span class="menu-title" style="color: #0d6efd;">Video</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='kontak'">
          <i class="mdi mdi-email-variant menu-icon" style="color: #0d6efd;"></i>
          <span class="menu-title" style="color: #0d6efd;">Kontak</span>
        </a>
      </li>
    <?php } ?>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='../auth/signout'">
        <i class="mdi mdi-logout-variant menu-icon" style="color: #0d6efd;"></i>
        <span class="menu-title" style="color: #0d6efd;">Keluar</span>
      </a>
    </li>
  </ul>
</nav>