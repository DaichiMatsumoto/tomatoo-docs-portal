<?php
require 'functions.php';

session_start();

$response = call_bradi_api_infoMe();

// ログイン状態チェック
if (isset($response['error']) || !isset($_SESSION['access_token'])) {
  header("Location: LoginForm/Logout.php");
  exit;
}
?>

<style>
  iframe {
    overflow-y: hidden;
    overflow-x: auto;
  }
</style>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="./img/favicons/favicon.ico">
  <link rel="apple-touch-icon" sizes="180x180" href="./img/favicons/apple-touch-icon-180x180.png">
  <title>Tomatoo docs portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid d-flex justify-content-between">
      <a href="index.php" class="navbar-brand"><img src="./img/logo_typo.png" width="150px"></a>
      <div class="d-flex align-items-center">
        <div class="row">
          <div class="col-6 col-sm-3">
            <h4><?php echo htmlspecialchars($response['user_name'], ENT_QUOTES); ?></h4>
          </div>
        </div>
        <div class="row">
          <div class="col-6 col-sm-3">
            <button type="button" class="btn btn-outline-light" onclick="location.href='LoginForm/Logout.php'">
              <img width="20" height="20" src="https://img.icons8.com/officel/16/exit.png" alt="exit" />
            </button>
          </div>
        </div>
      </div>
  </header><!-- End Header -->
  <div class="container-fluid mt-5">
    <iframe src="LoC.php" width="100%" onload="resizeIframe(this);" frameborder="0" scrolling="yes"></iframe>
  </div>
  <script src="assets/js/main.js"></script>
</body>

</html>