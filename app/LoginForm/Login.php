<?php
require '../functions.php';
// セッション開始
session_start();

// エラーメッセージの初期化
$errorMessage = "";
// ログインボタンが押された場合
if (isset($_POST["login"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["userid"])) {  // emptyは値が空のとき
        $errorMessage = 'ユーザーIDが未入力です。';
    } elseif (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    $user_id = $_POST['userid'];
    $raw_pswd = $_POST['password'];

    // login
    $response = call_bradi_api_login($user_id, $raw_pswd);

    // ログイン成功時
    if (isset($response['access_token'])) {
        header("Location: ../index.php");
        $_SESSION['access_token'] = $response['access_token'];
        exit;
    }
    // ログイン失敗時
    elseif (isset($response['error'])) {
        $errorMessage = 'ログインに失敗しました。正しいパスワードを入力してください。';
    }
}
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
    <link rel="icon" type="image/x-icon" href="../img/favicons/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/favicons/apple-touch-icon-180x180.png">
    <title>Tomatoo docs portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="form.css">
</head>

<body class="text-center">
    <div class="container">
        <div class="row">
            <div class="col">
                <img class="mb-4" src="../img/logo_typo.png" alt="" width="400px">

                <form class="form-signin" id="loginForm" name="loginForm" action="" method="POST">
                    <h3 class="mb-3 font-weight-normal">docs portalへサインイン</h3>
                    <div>
                        <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?>
                        </font>
                    </div>
                    <label for="userid" class="sr-only">ユーザーID</label>
                    <input type="text" id="userid" class="form-control" name="userid" placeholder="UserID" required autofocus value="<?php if (!empty($_POST["userid"])) {
                                                                                                                                            echo htmlspecialchars($_POST["userid"], ENT_QUOTES);
                                                                                                                                        } ?>">
                    <label for="password" class="sr-only">パスワード</label>
                    <input type="password" id="password" class="form-control" name="password" value="" placeholder="Password">
                    <br>
                    <input class="btn btn-lg btn-primary btn-block" type="submit" id="login" name="login" value="Sign in">
                </form>

                <form class="form-signin" action="SignUp.php">
                    <h1 class="h3 mb-3 font-weight-normal">アカウントをお持ちでない？</h1>
                    <input type="submit" class="btn btn-lg btn-link" value="Sign up">
                </form>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous">
    </script>
</body>

</html>