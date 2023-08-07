<?php
require_once 'functions.php';
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: LoginForm/Logout.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="./img/favicons/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="./img/favicons/apple-touch-icon-180x180.png">
    <title>Tomatoo dosc portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>
  <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid d-flex justify-content-between">
            <a href="index.php" class="navbar-brand"><img src="./img/logo.png" width="50px"></a>
            <h4><?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES); ?></h4>
            <button type="button" class="btn btn-outline-primary" onclick="location.href='LoginForm/Logout.php'">Logout</button>
        </div>
    </header><!-- End Header -->

    <div class="container-fluid mt-5">
    <iframe src="viewer.php" width="100%" onload="resizeIframe(this);" frameborder="0" scrolling="no"></iframe>
    </div>
<script src="assets/js/main.js"></script>
</body>
</html>