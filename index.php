<?php

@list($PATH, $QUERY) = explode("?",$_SERVER["REQUEST_URI"]);


if ($PATH=="/instagram.js"){
    include("scripts/instagram-posts.php");
    return;
}

header("HTTP 400 Bad Request");
