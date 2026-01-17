<?php


$server = "localhost";
$username = "root";
$password = "";
$dbname = "medical_serv";



$conn  = mysqli_connect($server, $username, $password, $dbname);
if (!$conn) {
    die("ERROR in COnnection" . mysqli_connect_error());
}


function db_insert($sql)
{
    global $conn;

    $result = mysqli_query($conn, $sql);
    if ($result) {
        return "add successfully";
    } else {
        return "faild to add";
    }
}


function getRow($table, $field, $value)
{
    global $conn;
    $sql  = "SELECT * FROM `$table` WHERE `$field`='$value'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }
        return false;
    } else {
        return false;
    }
}


function getRows($table)
{
    global $conn;
    $sql  = "SELECT * FROM `$table`";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $rows = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row  = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
        }
    }
    return $rows;
}
