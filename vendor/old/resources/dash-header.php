<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title><?= $_SESSION["page-name"] ?> - Sei Babi Om Bai</title>
<link rel="stylesheet" href="<?= $baseURL ?>/assets/css/feather.css">
<link rel="stylesheet" href="<?= $baseURL ?>/assets/mdi/css/materialdesignicons.min.css">
<link rel="stylesheet" href="<?= $baseURL ?>/assets/ti-icons/css/themify-icons.css">
<link rel="stylesheet" href="<?= $baseURL ?>/assets/typicons/typicons.css">
<link rel="stylesheet" href="<?= $baseURL ?>/assets/css/simple-line-icons.css">
<link rel="stylesheet" href="<?= $baseURL ?>/assets/css/vendor.bundle.base.css">
<link rel="stylesheet" href="<?= $baseURL ?>/assets/css/select.dataTables.min.css">
<link rel="stylesheet" href="<?= $baseURL ?>/assets/css/styles-dash.css">
<link rel="stylesheet" href="<?= $baseURL ?>/assets/datatable/datatables.css">
<script src="<?= $baseURL ?>/assets/sweetalert/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="<?= $baseURL ?>/assets/node_modules/bootstrap-icons/font/bootstrap-icons.css">
<link rel="shortcut icon" href="<?= $baseURL ?>/assets/images/..." />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
<style>
  html {
    scroll-behavior: smooth;
  }

  .kategori-wisata {
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
  }

  ::-webkit-scrollbar {
    height: 10px;
    /* height of horizontal scrollbar ← You"re missing this */
    width: 10px;
    /* width of vertical scrollbar */
    border: 1px solid #d5d5d5;
  }

  ::-webkit-scrollbar-track {
    border-radius: 0;
    background: #eeeeee;
  }

  ::-webkit-scrollbar-thumb {
    border-radius: 0;
    background: rgb(3, 164, 237);
  }

  .btn-primary {
    background-color: rgb(3, 164, 237);
    border-radius: 0;
  }

  .btn-primary:hover {
    background-color: #0365FF;
  }

  .glass {
    background: linear-gradient(135deg, rgba(223, 223, 223, 0.1), rgba(223, 223, 223, 0));
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(223, 223, 223, 0.18);
    box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
  }
</style>