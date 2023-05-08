<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title><?php if (isset($_SESSION['page-name'])) {
          if ($_SESSION['page-name'] != "") {
            echo $_SESSION['page-name'] . " - ";
          }
        } ?>Sei Babi Om Ba'i</title>
<meta name="description" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="apple-touch-icon" href="apple-touch-icon.png" />
<!-- font awesome cdn link  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="<?= $baseURL ?>/assets/css/stylex.css">

<!-- <link rel="stylesheet" href="<?= $baseURL ?>/assets/css/bootstrap.min.css" /> -->
<!-- <link rel="stylesheet" href="<?= $baseURL ?>/assets/css/font-awesome.min.css" /> -->
<!-- <link rel="stylesheet" href="<?= $baseURL ?>/assets/css/animate/animate.css" /> -->
<!-- <link rel="stylesheet" href="<?= $baseURL ?>/assets/css/plugins.css" /> -->
<!-- <link rel="stylesheet" href="<?= $baseURL ?>/assets/css/styles.css" /> -->
<!-- <link rel="stylesheet" href="<?= $baseURL ?>/assets/css/responsive.css" /> -->
<script src="<?= $baseURL ?>/assets/sweetalert/dist/sweetalert2.all.min.js"></script>
<!-- <script src="<?= $baseURL ?>/assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script> -->
<!-- <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css" /> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="<?= $baseURL ?>/assets/datatable/datatables.css">