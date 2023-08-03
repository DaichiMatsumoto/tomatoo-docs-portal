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
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
    <link rel="icon" type="image/x-icon" href="./img/favicons/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="./img/favicons/apple-touch-icon-180x180.png">
    <title>Tomatoo dosc portal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css"
        integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
    <link rel="stylesheet" href="./form.css">
</head>

<body>
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid"
            <div class="navbar-brand">
                    <img src="./img/logo.png" width="200px">
            </div>
            <div class="d-flex flex-row-reverse">
                <div class="p-2"><button type="button" class="btn btn-outline-primary"
                        onclick="location.href='LoginForm/Logout.php'">Logout</button>
                </div>
            </div>
            <div class="p-2">
                <h4>
                    <?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES); ?>
                </h4>
            </div>
            </div>
        <div
        </nav>
    </header>
    <div class="container-fluid">
        <div class="row">
            <body>
            <?php
                $base_url = '/tomatoo/docs-portal/app/docs/BRADI/BRADI_HTML/';
                $file_path = $_SERVER['DOCUMENT_ROOT'] . '/tomatoo/docs-portal/app/docs/BRADI/BRADI_HTML/BRADI 92fc3990875849c5b53eec3601e12b54.html';
                $html_content = file_get_contents($file_path);
                $html_content = str_replace('href="', 'href="' . $base_url, $html_content);
                echo $html_content;
            ?>
            </body>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>