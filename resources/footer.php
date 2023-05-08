<!-- footer section starts  -->
<section class="footer">
  <div class="share">
    <a href="#" class="fab fa-facebook-f"></a>
    <a href="#" class="fab fa-youtube"></a>
    <a href="#" class="fab fa-instagram"></a>
    <a href="#" class="fab fa-tiktok"></a>
  </div>
  <div class="links">
    <a href="<?= $baseURL?>/">home</a>
    <a href="<?= $baseURL?>/tentang">about</a>
    <a href="<?= $baseURL?>/menu">menu</a>
    <a href="<?= $baseURL?>/kontak">kontak</a>
  </div>
  <div class="credit">Copyright © <?= date("Y") ?> <a style="cursor: pointer;" onclick="window.open('https://netmedia-framecode.com', '_blank')">Netmedia Framecode</a> . All rights reserved. Powered By Erin Paulander Otemusu</div>
</section>
<!-- footer section ends -->

<script src="<?= $baseURL ?>/assets/js/vendor/jquery-1.11.2.min.js"></script>
<!-- <script src="<?= $baseURL?>/assets/js/vendor/bootstrap.min.js"></script> -->

<!-- <script src="<?= $baseURL?>/assets/js/jquery-easing/jquery.easing.1.3.js"></script> -->
<!-- <script src="<?= $baseURL?>/assets/js/wow/wow.min.js"></script> -->
<!-- <script src="<?= $baseURL?>/assets/js/plugins.js"></script> -->
<!-- <script src="<?= $baseURL?>/assets/js/main.js"></script> -->
<script src="<?= $baseURL ?>/assets/js/script.js"></script>
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