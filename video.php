<?php require_once("controller/script.php");
$_SESSION["page-name"] = "Video";
$_SESSION["page-url"] = "video";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once("resources/header.php"); ?>
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

  <div class="container-xxl bg-white p-0">
    <?php require_once("resources/navbar.php"); ?>
    <div class="container-xxl py-5 bg-dark hero-header mb-5">
      <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Video</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-center text-uppercase">
            <li class="breadcrumb-item"><a href="./">Beranda</a></li>
            <li class="breadcrumb-item text-white active" aria-current="page">Video</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!-- Navbar & Hero End -->

  <!-- BLog Start -->
  <div class="container-xxl py-5">
    <div class="container">
      <div class="row g-4">
        <?php if (mysqli_num_rows($videos) > 0) {
          while ($row = mysqli_fetch_assoc($videos)) { ?>
            <div class="col-lg-6">
              <div class="card mb-3">
                <iframe style="width: 100%;height: 300px;" src="https://www.youtube.com/embed/<?php $youtube_link = $row["link_yt"];
                                                                                              $url_parts = parse_url($youtube_link);
                                                                                              parse_str($url_parts["query"], $query_params);
                                                                                              $video_id = $query_params["v"];
                                                                                              echo $video_id; ?>" frameborder="0" allowfullscreen></iframe>
              </div>
            </div>
        <?php }
        } ?>
      </div>
    </div>
  </div>
  <!-- Blog End -->

  <div style="margin-bottom: 100px;"></div>

  <!--Footer-->
  <?php require_once("resources/footer.php") ?>

</body>

</html>