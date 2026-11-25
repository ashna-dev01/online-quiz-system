<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "online_quiz_system";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Database Connection Failed");
}

?>