<?php
// データベースに接続
function connectDB() {
    $param = 'mysql:dbname=deltakid_test2;host=82.163.176.103;charset=utf8';

    try {
        $pdo = new PDO($param, 'deltakid_root', 'FJmM5mTA');
        return $pdo;

    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
}
?>