<section id="footer_widget" class="footer_widget">
  <div class="container">
    <div class="row">
      <div class="footer_widget_content text-center">
        <div class="col-md-8">
          <div class="single_widget wow fadeIn" data-wow-duration="2s">
            <h3>Sei Babi Om Ba'i</h3>
            <div class="single_widget_info">
              <p>
                Rasakan sensasi pedas dan lezat dari Sei Babi Kupang, hidangan khas Nusa Tenggara Timur. Empuk, beraroma sedap, cocok untuk acara keluarga atau bisnis. Coba hari ini!
              </p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="single_widget wow fadeIn" data-wow-duration="5s">
            <h3>Kirim pesan kepada kami</h3>

            <div class="single_widget_form text-left">
              <form action="#" method="post" id="formid">
                <div class="form-group">
                  <input type="text" class="form-control" name="name" placeholder="first name" required />
                </div>

                <div class="form-group">
                  <input type="email" class="form-control" name="email" placeholder="Email" required />
                </div>

                <div class="form-group">
                  <input type="text" name="subject" class="form-control" placeholder="Subject" required />
                </div>
                <!-- end of form-group -->

                <div class="form-group">
                  <textarea class="form-control" name="message" rows="3" placeholder="Message" required></textarea>
                </div>

                <input type="submit" name="contact" value="Kirim" class="btn btn-primary" />
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<footer id="footer" class="footer">
  <div class="container text-center">
    <div class="row">
      <div class="col-sm-12">
        <div class="copyright wow zoomIn" data-wow-duration="3s">
          <p>
            Copyright © <?= date("Y") ?> <a style="cursor: pointer;" onclick="window.open('https://netmedia-framecode.com', '_blank')">Netmedia Framecode</a> . All rights reserved. Powered By Erin Paulander Otemusu
          </p>
        </div>
      </div>
    </div>
  </div>
</footer>

<div class="scrollup">
  <a href="#"><i class="fa fa-chevron-up"></i></a>
</div>

<script src="<?= $baseURL ?>/assets/js/vendor/jquery-1.11.2.min.js"></script>
<script src="<?= $baseURL ?>/assets/js/vendor/bootstrap.min.js"></script>

<script src="<?= $baseURL ?>/assets/js/jquery-easing/jquery.easing.1.3.js"></script>
<script src="<?= $baseURL ?>/assets/js/wow/wow.min.js"></script>
<script src="<?= $baseURL ?>/assets/js/plugins.js"></script>
<script src="<?= $baseURL ?>/assets/js/main.js"></script>
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