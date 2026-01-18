<?php

$dsn = 'mysql:host=db.fr-pari1.bengt.wasmernet.com;port=10272;dbname=dbetXVTh4hPAU8w2uPzYkQb8';
$user = '9775a4df7b7f8000a2487c6b5333';
$pass = '06969775-a4e0-7b29-8000-1e7ac16e49c4';
$option = [
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
];

try {
    $con = new PDO($dsn, $user, $pass, $option);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'You Are Connected';
} catch (PDOException $e) {
    echo 'Failed To Connect' . $e->getMessage();
}
