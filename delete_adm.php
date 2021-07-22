<?php
//include file config.php
include('conn.php');


if (isset($_GET['id'])) {

    $id = $_GET['id'];


    $cek = mysqli_query($conn, "SELECT * FROM admin WHERE id='$id'") or die(mysqli_error($conn));

    if (mysqli_num_rows($cek) > 0) {
        $del = mysqli_query($conn, "DELETE FROM admin WHERE id='$id'") or die(mysqli_error($conn));
        if ($del) {
            echo '<script>alert("Berhasil menghapus data."); document.location="dashboard.php";</script>';
        } else {
            echo '<script>alert("Gagal menghapus data."); document.location="dashboard.php";</script>';
        }
    } else {
        echo '<script>alert("ID tidak ditemukan di database."); document.location="dashboard.php";</script>';
    }
} else {
    echo '<script>alert("error!"); document.location="dashboard.php";</script>';
}
