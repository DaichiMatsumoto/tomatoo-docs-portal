<?php
require 'functions.php';
session_start();

$base_url = $_SERVER['DOCUMENT_ROOT'] . '/tomatoo/docs-portal/app/';
$dir = 'docs';
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tomatoo docs portal</title>
  <link href="assets/css/LoCstyle.css" rel="stylesheet">
</head>

<body>
  <div class="file-explorer">
    <?php displayDirectoryTree($base_url . $dir, $dir); ?>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const directories = document.querySelectorAll('.directory');
      directories.forEach(function(directory) {
        directory.addEventListener('click', function(event) {
          event.stopPropagation();
          const children = this.nextElementSibling;
          if (children) {
            children.style.display = children.style.display === 'none' ? 'block' : 'none';
          }
        });
      });
    });
  </script>
</body>

</html>