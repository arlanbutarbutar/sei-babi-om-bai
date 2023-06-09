<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer pt-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: -50px;">
  <div class="container py-5">
    <div class="row g-5">
      <div class="col-lg-3 col-md-6">
        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Sei Babi</h4>
        <a class="btn btn-link" href="<?= $baseURL ?>/tentang">Tentang</a>
        <a class="btn btn-link" href="<?= $baseURL ?>/menu">Menu</a>
        <a class="btn btn-link" href="<?= $baseURL ?>/blog">Blog</a>
        <a class="btn btn-link" href="<?= $baseURL ?>/kontak">Kontak</a>
      </div>
      <div class="col-lg-5 col-md-8">
        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Contact</h4>
        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Teunbaun, Kec. Amarasi Bar., Kabupaten Kupang, Nusa Tenggara Tim.</p>
        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+62 813-3916-0513</p>
        <div class="d-flex pt-2">
          <a class="btn btn-outline-light btn-social" href="https://www.instagram.com/seibaunkupang/?hl=id" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Opening</h4>
        <h5 class="text-light fw-normal">Setiap Hari</h5>
        <p>08AM - 05PM</p>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="copyright">
      <div class="row">
        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">Copyright © <?= date("Y") ?> <a style="cursor: pointer;" onclick="window.open('https://netmedia-framecode.com', '_blank')">Netmedia Framecode</a> . All rights reserved. Powered By Erin Paulander Otemusu
        </div>
        <div class="col-md-6 text-center text-md-end">
          <div class="footer-menu">
            <a style="cursor: pointer;" onclick="window.open('https://netmedia-framecode.com', '_blank')">Beranda</a>
            <a style="cursor: pointer;" onclick="window.open('https://netmedia-framecode.com/tentang', '_blank')">Tentang</a>
            <a style="cursor: pointer;" onclick="window.open('https://netmedia-framecode.com/layanan', '_blank')">Layanan</a>
            <a style="cursor: pointer;" onclick="window.open('https://netmedia-framecode.com/kebijakan-privasi', '_blank')">Privacy Policy</a>
            <a style="cursor: pointer;" onclick="window.open('https://netmedia-framecode.com/ketentuan-layanan', '_blank')">Terms of Service</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= $baseURL ?>/assets/lib/wow/wow.min.js"></script>
<script src="<?= $baseURL ?>/assets/lib/easing/easing.min.js"></script>
<script src="<?= $baseURL ?>/assets/lib/waypoints/waypoints.min.js"></script>
<script src="<?= $baseURL ?>/assets/lib/counterup/counterup.min.js"></script>
<script src="<?= $baseURL ?>/assets/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="<?= $baseURL ?>/assets/lib/tempusdominus/js/moment.min.js"></script>
<script src="<?= $baseURL ?>/assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="<?= $baseURL ?>/assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Template Javascript -->
<script src="<?= $baseURL ?>/assets/js/main.js"></script>
<script src="<?= $baseURL ?>/assets/datatable/datatables.js"></script>
<script>
  const messageSuccess = $(".message-success").data("message-success");
  const messageInfo = $(".message-info").data("message-info");
  const messageWarning = $(".message-warning").data("message-warning");
  const messageDanger = $(".message-danger").data("message-danger");

  if (messageSuccess) {
    Swal.fire({
      icon: "success",
      title: "Berhasil Terkirim",
      text: messageSuccess,
    })
  }

  if (messageInfo) {
    Swal.fire({
      icon: "info",
      title: "For your information",
      text: messageInfo,
    })
  }
  if (messageWarning) {
    Swal.fire({
      icon: "warning",
      title: "Peringatan!!",
      text: messageWarning,
    })
  }
  if (messageDanger) {
    Swal.fire({
      icon: "error",
      title: "Kesalahan",
      text: messageDanger,
    })
  }
</script>
<script>
  $(document).ready(function() {
    $("#datatable").DataTable();
  });
</script>