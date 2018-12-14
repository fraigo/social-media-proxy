<?php

$PATH = @$_SERVER["PATH_INFO"];

if ($PATH=="/instagram.js"){
    include("scripts/instagram-posts.php");
    return;
}

header("HTTP 400 Bad Request");
