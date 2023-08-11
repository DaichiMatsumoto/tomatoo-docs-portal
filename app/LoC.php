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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="file-explorer">
    <div class="row">
      <div class="col-6 col-sm-3">
        <button class="btn btn-outline-light" onclick="toggleAllDirectories()">
          <img id="toggleIcon" src="https://img.icons8.com/office/16/double-up.png" alt="Toggle Icon">
        </button>
      </div>
    </div>
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

    let allDirectoriesExpanded = true; // 初期状態では全トグルは展開されている

    function toggleAllDirectories() {
      const directories = document.querySelectorAll('.directory');
      const toggleIcon = document.getElementById('toggleIcon');
      if (allDirectoriesExpanded) {
        directories.forEach(directory => {
          if (directory.nextElementSibling) {
            directory.nextElementSibling.style.display = 'none';
          }
        });
        toggleIcon.src = "https://img.icons8.com/office/16/double-down.png";
      } else {
        directories.forEach(directory => {
          if (directory.nextElementSibling) {
            directory.nextElementSibling.style.display = 'block';
          }
        });
        toggleIcon.src = "https://img.icons8.com/office/16/double-up.png";
      }
      allDirectoriesExpanded = !allDirectoriesExpanded;
    }
  </script>
</body>

</html>