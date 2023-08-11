<?php
require 'functions.php';

session_start();

$response = call_bradi_api_infoMe();

// ログイン状態チェック
if (isset($response['error']) || !isset($_SESSION['access_token'])) {
    header("Location: LoginForm/Logout.php");
    exit;
}

$redirect_url = $_GET['url'];
$encoded_url = urldecode($redirect_url);

$base_url = '/tomatoo/docs-portal/app/docs/' . $encoded_url;
$file_path = $_SERVER['DOCUMENT_ROOT'] . $base_url;
$html_content = file_get_contents($file_path);

// Replace relative links considering the source URL
$html_content = preg_replace_callback(
    '/(href|src)="((\.{1,2}\/)*)([^"]*)"/',
    function ($matches) use ($base_url) {
        if (preg_match('/^(http|https):\/\//', $matches[4])) {
            return $matches[0];
        }
        $parsed_url = parse_url($base_url);
        $base_path = dirname($parsed_url['path']);
        $num_periods = substr_count($matches[2], '../');
        for ($i = 0; $i < $num_periods; $i++) {
            $base_path = dirname($base_path);
        }
        $absolute_link = $base_path . '/' . urldecode($matches[4]);
        return $matches[1] . '="' . $absolute_link . '"';
    },
    $html_content
);

echo $html_content;
