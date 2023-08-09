<?php
session_start();

$url = 'https://api.crimson.forgot.his.name/brd/ply/user/info/me';
$options = array(
            'http' => array(
            'header'  => "Authorization: Bearer {$_SESSION['access_token']}\r\n",
            'method'  => 'GET',
            'ignore_errors' => true
        )
    );
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$response = json_decode($result, true);

// ログイン状態チェック
if (isset($response['error']) || !isset($_SESSION['access_token'])) {
    header("Location: LoginForm/Logout.php");
    exit;
}

$redirect_url = $_GET['url'] ?? 'BRADI/BRADI_HTML/BRADI 92fc3990875849c5b53eec3601e12b54.html';
$encoded_url = urldecode($redirect_url);

$base_url = '/tomatoo/docs-portal/app/docs/' . $encoded_url;
$file_path = $_SERVER['DOCUMENT_ROOT'] . $base_url;
$html_content = file_get_contents($file_path);

// Replace relative links considering the source URL
$html_content = str_replace('href="', 'href="./', $html_content);
$html_content = str_replace('src="', 'src="./', $html_content);
$html_content = preg_replace_callback(
    '/(href|src)="((\.{1,2}\/)+)([^"]*)"/',
    function ($matches) use ($base_url) {
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
?>