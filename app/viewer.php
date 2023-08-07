<?php
require_once 'functions.php';
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: LoginForm/Logout.php");
    exit;
}

$base_url = '/tomatoo/docs-portal/app/docs/BRADI/BRADI_HTML/';
            $file_path = $_SERVER['DOCUMENT_ROOT'] . '/tomatoo/docs-portal/app/docs/BRADI/BRADI_HTML/BRADI 92fc3990875849c5b53eec3601e12b54.html';
            $html_content = file_get_contents($file_path);
            $html_content = str_replace('href="', 'href="' . $base_url, $html_content);
            echo $html_content;

?>