<?php
    $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    if (!file_exists(".$path")){
      include "index.php";
    } else {
      return false;
    }
?>