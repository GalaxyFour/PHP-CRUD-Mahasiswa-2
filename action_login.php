<?php
session_start();

include "conn.php";


if (!(isset($_POST["username"]) && isset($_POST["password"]))) {
    echo "error! <br><a href='index.php'>Kembali</a>";
    return;
}

$user = $_POST["username"];
$pass = $_POST["password"];


$sql = "select * from admin where username='" . $user . "' and password='" . $pass . "' limit 1";
$hasil = mysqli_query($conn, $sql);
$jumlah = mysqli_num_rows($hasil);


if ($jumlah > 0) {
    $row = mysqli_fetch_assoc($hasil);
    $_SESSION["id"] = $row["id"];
    $_SESSION["username"] = $row["username"];
    $_SESSION["role"] = $row["role"];


    header("Location:dashboard.php");
} else {
    echo "LOGIN GAGAL! <br><a href='index.php'>Kembali</a>";
}
