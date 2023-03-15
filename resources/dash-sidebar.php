<nav class="sidebar sidebar-offcanvas shadow-lg" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='./'">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <?php if ($_SESSION['data-user']['role'] <= 2) { ?>
      <li class="nav-item nav-category" style="border-bottom: 1px solid #C2C2C2;">Kelola Pengguna</li>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='users'">
          <i class="mdi mdi-account-multiple-outline menu-icon"></i>
          <span class="menu-title">Users</span>
        </a>
      </li>
      <li class="nav-item nav-category" style="border-bottom: 1px solid #C2C2C2;">Kelola Penjualan</li>
    <?php } ?>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='menu'">
        <i class="mdi mdi-food-variant menu-icon"></i>
        <span class="menu-title">Menu</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='keranjang'">
        <i class="mdi mdi-cart-outline menu-icon"></i>
        <span class="menu-title">Keranjang</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='pemesanan'">
        <i class="mdi mdi-cart-plus menu-icon"></i>
        <span class="menu-title">Pemesanan</span>
      </a>
    </li>
    <li class="nav-item nav-category" style="border-bottom: 1px solid #C2C2C2;"></li>
    <?php if ($_SESSION['data-user']['role'] <= 2) { ?>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='tentang'">
          <i class="mdi mdi-face menu-icon"></i>
          <span class="menu-title">Tentang</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='kontak'">
          <i class="mdi mdi-email-variant menu-icon"></i>
          <span class="menu-title">Kontak</span>
        </a>
      </li>
    <?php } ?>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='../auth/signout'">
        <i class="mdi mdi-logout-variant menu-icon"></i>
        <span class="menu-title">Keluar</span>
      </a>
    </li>
  </ul>
</nav>