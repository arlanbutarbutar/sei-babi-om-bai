<?php if (isset($_SESSION["data-user"])) {
  if ($_SESSION['data-user']['role'] <= 2) {
    header("Location: ../views/");
    exit();
  }else if ($_SESSION['data-user']['role'] == 3) {
    header("Location: ../");
    exit();
  }
}