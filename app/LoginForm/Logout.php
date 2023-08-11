<?php
session_start();

if (isset($_SESSION['access_token'])) {
    $errorMessage = "ログアウトしました。";
} else {
    $errorMessage = "セッションが切れています。";
}

// セッションの変数のクリア
$_SESSION = array();

// セッションクリア
@session_destroy();
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
    <link rel="icon" type="image/x-icon" href="../img/favicons/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/favicons/apple-touch-icon-180x180.png">
    <title>Tomatoo docs portal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="form.css">
</head>

<body class="text-center">
    <div class="container">
        <div class="row">
            <div class="col">
                <img class="mb-4" src="../img/logo.png" alt="" width="200px">

                <div>
                    <h3 class="mb-3 font-weight-normal">ログアウト</h3>
                </div>
                <div>
                    <?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?>
                </div>
                <div>
                    <input type="button" class="btn btn-lg btn-link" value="ログインページへ" onclick="location.href='Login.php'">
                </div>
            </div>
        </div>
    </div>
</body>

</html>