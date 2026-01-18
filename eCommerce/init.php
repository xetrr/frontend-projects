<?php

// Error reporting - off in production, on in development
if ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '127.0.0.1' || strpos($_SERVER['HTTP_HOST'], 'localhost:') !== false) {
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 'Off');
    error_reporting(0);
}


include 'admin/connect.php';
$session_user = '';
if (isset($_SESSION["user"])) {
    $session_user = $_SESSION["user"];
}

//Routes
$tpl = 'includes/templates/';
$lang = 'includes/languages/';
$func = 'includes/functions/';

include $func . 'functions.php';
include $lang . 'english.php';
include $tpl . 'header.php';

if (!isset($noNavbar)) {
    include $tpl . 'navbar.php';
}
// NOTE: Footer should be included at the end of each page file, not here!

