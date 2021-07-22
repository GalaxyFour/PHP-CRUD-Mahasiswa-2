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
<?php
// include database connection file
include_once("conn.php");

// Check if form is submitted for user update, then redirect to homepage after update
if (isset($_POST['update'])) {
    $nim = $_POST['nim'];

    $nama_depan = $_POST['nama_depan'];
    $nama_tengah = $_POST['nama_tengah'];
    $nama_belakang = $_POST['nama_belakang'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $update_date = date("Y-m-d H:i:s");
    $update_by = $id;

    // update user data
    $result = mysqli_query($conn, "UPDATE mahasiswa SET nama_depan='$nama_depan', nama_tengah='$nama_tengah', nama_belakang='$nama_belakang', alamat='$alamat', no_telp='$no_telp', update_date='$update_date', update_by='$update_by' WHERE nim=$nim");

    // Redirect to homepage to display updated user in list
    header("Location: dashboard.php");
}
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
                <div class="col-9">
                    <?php
                    include('conn.php');
                    $nim = $_GET['nim'];

                    // Fetech user data based on id
                    $result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim=$nim");

                    while ($data = mysqli_fetch_array($result)) {
                        $nim = $data['nim'];
                        $nama_depan = $data['nama_depan'];
                        $nama_tengah = $data['nama_tengah'];
                        $nama_belakang = $data['nama_belakang'];
                        $alamat = $data['alamat'];
                        $no_telp = $data['no_telp'];
                    }
                    ?>
                    <h2>EDIT Data mahasiswa</h2>
                    <form action="edit_mhs.php" method="post">

                        <input type="hidden" name="nim" value="<?php echo $nim; ?>">

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NAMA DEPAN</label>
                            <div class="col-sm-6">
                                <input type="text" name="nama_depan" class="form-control" value="<?php echo $nama_depan; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NAMA TENGAH</label>
                            <div class="col-sm-6">
                                <input type="text" name="nama_tengah" class="form-control" value="<?php echo $nama_tengah; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NAMA BELAKANG</label>
                            <div class="col-sm-6">
                                <input type="text" name="nama_belakang" class="form-control" value="<?php echo $nama_belakang; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">ALAMAT</label>
                            <div class="col-sm-6">
                                <input type="text" name="alamat" class="form-control" value="<?php echo $alamat; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NO. TLP</label>
                            <div class="col-sm-6">
                                <input type="text" name="no_telp" class="form-control" value="<?php echo $no_telp; ?>" required>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">&nbsp;</label>
                            <div class="col-sm-6">
                                <input type="submit" name="update" class="btn btn-primary" value="UPDATE">
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