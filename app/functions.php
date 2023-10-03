<script>
    function toggleDirectory(event, element) {
        event.stopPropagation(); // Prevent event from bubbling up to parent elements

        // Toggle the 'collapsed' class for the clicked directory
        element.classList.toggle('collapsed');

    }
</script>

<?php

function call_bradi_api_infoMe()
{
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
    return $response;
}

function call_bradi_api_login($user_id, $raw_pswd)
{
    // API縺ｫ繝ｪ繧ｯ繧ｨ繧ｹ繝医ｒ騾∽ｿ｡
    $url = 'https://api.crimson.forgot.his.name/brd/ply/user/login';
    $data = array('user_id' => $user_id, 'raw_pswd' => $raw_pswd);
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
            'ignore_errors' => true
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result, true);
    return $response;
}

function displayDirectoryTree($dir, $relativePath = '')
{
    $items = scandir($dir);

    echo "<ul>";
    foreach ($items as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        $path = $dir . '/' . $item;
        $newRelativePath = $relativePath . '/' . $item;
        if (is_dir($path)) {
            echo "<li class='directory collapsed' onclick='toggleDirectory(event, this)'>{$item}</li>";
            displayDirectoryTree($path, $newRelativePath);
        } elseif (pathinfo($path, PATHINFO_EXTENSION) == 'html' || pathinfo($path, PATHINFO_EXTENSION) == 'php') {
            $encodedPath = urlencode(mb_convert_encoding($newRelativePath, 'UTF-8', 'auto'));
            $decodedPath = str_replace('%2F', '/', $encodedPath);
            echo "<li class='file'><a href='{$decodedPath}'>{$item}</a></li>";
        }
    }
    echo "</ul>";
}
?>