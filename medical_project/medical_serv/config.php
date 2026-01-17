<?php
session_start();


define("BURL", "http://localhost/medical_project/medical/");
define("BURLA", "http://localhost/medical_project/medical_serv/admin/");

define("ASSETS", "http://localhost/medical_project/medical_serv/assets");


define("BL", __DIR__ . '/');
define("BLA", __DIR__ . '/admin/');


//connect to database


require_once(BL . "functions/db.php");
