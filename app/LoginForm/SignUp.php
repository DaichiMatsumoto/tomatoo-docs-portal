<?php
require 'password.php';   // password_hash()はphp 5.5.0以降の関数のため、バージョンが古くて使えない場合に使用
// セッション開始
session_start();

$db['user'] = "deltakid_root";  // ユーザー名
$db['pass'] = "FJmM5mTA";  // ユーザー名のパスワード
$param = 'mysql:dbname=deltakid_test2;host=82.163.176.103;charset=utf8';


// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";
$signUpMessage = "";

// ログインボタンが押された場合
if (isset($_POST["signUp"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["username"])) {  // 値が空のとき
        $errorMessage = 'ユーザーIDが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    } else if (empty($_POST["password2"])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) && $_POST["password"] === $_POST["password2"]) {
        // 入力したユーザIDとパスワードを格納
        $username = $_POST["username"];
        $password = $_POST["password"];

        // 2. ユーザIDとパスワードが入力されていたら認証する
        //$dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

        // 3. エラー処理
        try {
            //$pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
            $pdo = new PDO($param, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare("INSERT INTO userData(name, password) VALUES (?, ?)");

            $stmt->execute(array($username, password_hash($password, PASSWORD_DEFAULT)));  // パスワードのハッシュ化を行う（今回は文字列のみなのでbindValue(変数の内容が変わらない)を使用せず、直接excuteに渡しても問題ない）
            $userid = $pdo->lastinsertid();  // 登録した(DB側でauto_incrementした)IDを$useridに入れる

            $signUpMessage = '登録が完了しました。'."\n".'UserName：'.$username; 
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
             //$e->getMessage()でエラー内容を参照可能（デバッグ時のみ表示）
             echo $e->getMessage();
        }
    } else if($_POST["password"] != $_POST["password2"]) {
        $errorMessage = 'パスワードに誤りがあります。';
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
    <title>Inisienogram</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="form.css">
</head>

<body class="text-center">
    <div class="container">
        <div class="row">
            <div class="col">
                <img class="mb-4" src="../img/logo.png" alt="" width="200px">

                <form class="form-signin" id="loginForm" name="loginForm" action="" method="POST">
                    <h3 class="mb-3 font-weight-normal">アカウントを新規登録</h3>
                    <div>
                        <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?>
                        </font>
                    </div>
                    <div>
                        <font color="#0000ff"><?php echo nl2br(htmlspecialchars($signUpMessage, ENT_QUOTES)); ?>
                        </font>
                    </div>
                    <label for="username" class="sr-only">ユーザー名</label>
                    <input type="text" id="username" class="form-control" name="username" placeholder="UserName"
                        required autofocus
                        value="<?php if (!empty($_POST["username"])) {echo htmlspecialchars($_POST["username"], ENT_QUOTES);} ?>">
                    <br>
                    <label for="password" class="sr-only">パスワード</label>
                    <input type="password" id="password" class="form-control" name="password" value=""
                        placeholder="Password">
                    <label for="password2" class="sr-only">パスワード(確認用)</label>
                    <input type="password" id="password2" class="form-control" name="password2" value=""
                        placeholder="Confirm Password">
                    <br>
                    <input class="btn btn-lg btn-outline-primary btn-block" type="submit" id="signUp" name="signUp"
                        value="Sign up">
                </form>
                <br>
                <form class="form-signin" action="Login.php">
                    <input type="submit" class="btn btn-lg btn-link" value="ログインページへ">
                </form>
            </div>
        </div>
    </div>
</body>

</html>