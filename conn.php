<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "web2";

$conn = new mysqli($server, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Koneksi gagal:" . mysqli_connect_error());
}
