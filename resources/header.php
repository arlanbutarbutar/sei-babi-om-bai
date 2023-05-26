<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title><?php if (isset($_SESSION['page-name'])) {
          if ($_SESSION['page-name'] != "") {
            echo $_SESSION['page-name'] . " - ";
          }
        } ?>Sei Babi Om Ba'i</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<link rel="apple-touch-icon" href="apple-touch-icon.png" />
<script src="<?= $baseURL ?>/assets/sweetalert/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="<?= $baseURL ?>/assets/datatable/datatables.css">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="<?= $baseURL ?>/assets/lib/animate/animate.min.css" rel="stylesheet">
<link href="<?= $baseURL ?>/assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="<?= $baseURL ?>/assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

<!-- Customized Bootstrap Stylesheet -->
<link href="<?= $baseURL ?>/assets/css/bootstrap.min.css" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="<?= $baseURL ?>/assets/css/style.css" rel="stylesheet">