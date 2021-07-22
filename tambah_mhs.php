<?php
session_start();

if (!isset($_SESSION["username"])) {
    echo "Anda harus login dulu <br><a href='index.php'>Klik disini</a>";
    exit;
}

$id = $_SESSION["id"];
$username = $_SESSION["username"];
$role = $_SESSION["role"];



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="jumbotron text-center">
            <h1>Selamat Datang, <?php echo $username; ?></h1>
            <p>Role : <?php echo $role; ?></p>
            <a href="logout.php" class="btn btn-warning" role="button">Logout</a>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Data Mahasiswa</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <br>
                <?php
                include "conn.php";
                if (isset($_POST['submit_mhs'])) {
                    $nim            = $_POST['nim'];
                    $nama_depan     = $_POST['nama_depan'];
                    $nama_tengah    = $_POST['nama_tengah'];
                    $nama_belakang  = $_POST['nama_belakang'];
                    $alamat         = $_POST['alamat'];
                    $no_telp         = $_POST['no_telp'];
                    $create_date    = date("Y-m-d H:i:s");
                    $create_by      = $id;
                    $update_date    = '0000-00-00 00:00:00';
                    $update_by      = '0';

                    $cek = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim='$nim'") or die(mysqli_error($conn));

                    if (mysqli_num_rows($cek) == 0) {
                        $sql = mysqli_query($conn, "INSERT INTO mahasiswa(nim, nama_depan, nama_tengah, nama_belakang, alamat, no_telp, create_date, create_by, update_date, update_by) VALUES('$nim', '$nama_depan', '$nama_tengah', '$nama_belakang', '$alamat', '$no_telp', '$create_date', '$create_by', '$update_date', '$update_by')") or die(mysqli_error($conn));

                        if ($sql) {
                            echo '<script>alert("Berhasil menambahkan data."); document.location="dashboard.php";</script>';
                        } else {
                            echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
                        }
                    } else {
                        echo '<div class="alert alert-warning">Gagal, NIM sudah terdaftar.</div>';
                    }
                }
                ?>
                <div class="col-9">
                    <h2>Tambah Data mahasiswa</h2>
                    <form action="tambah_mhs.php" method="post">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NIM</label>
                            <div class="col-sm-6">
                                <input type="text" name="nim" class="form-control" size="4" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NAMA DEPAN</label>
                            <div class="col-sm-6">
                                <input type="text" name="nama_depan" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NAMA TENGAH</label>
                            <div class="col-sm-6">
                                <input type="text" name="nama_tengah" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NAMA BELAKANG</label>
                            <div class="col-sm-6">
                                <input type="text" name="nama_belakang" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">ALAMAT</label>
                            <div class="col-sm-6">
                                <input type="text" name="alamat" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NO. TLP</label>
                            <div class="col-sm-6">
                                <input type="text" name="no_telp" class="form-control" required>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">&nbsp;</label>
                            <div class="col-sm-6">
                                <input type="submit" name="submit_mhs" class="btn btn-primary" value="SIMPAN">
                                <input type="submit" name="back_mhs" class="btn btn-primary" value="KEMBALI" onclick="history.go(-1); return false;">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <hr>
    </div>
</body>
<script src="js/bootstrap.min.js"></script>

</html>