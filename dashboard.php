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
                <button class="nav-link active" id="mahasiswa-tab" data-bs-toggle="tab" data-bs-target="#mahasiswa" type="button" role="tab" aria-controls="mahasiswa" aria-selected="true">Data Mahasiswa</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button" role="tab" aria-controls="admin" aria-selected="false">Data Admin</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="mahasiswa" role="tabpanel" aria-labelledby="mahasiswa-tab">
                <br>
                <a href="tambah_mhs.php" class="btn btn-primary mb-2" role="button">Tambah Data Mahasiswa</a>
                <table class="table table-striped table-hover table-sm table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>NO</th>
                            <th>NIM</th>
                            <th>NAMA DEPAN</th>
                            <th>NAMA TENGAH</th>
                            <th>NAMA BELAKANG</th>
                            <th>ALAMAT</th>
                            <th>NO TLP</th>
                            <th>CREATE DATE</th>
                            <th>CREATE BY</th>
                            <th>UPDATE DATE</th>
                            <th>UPDATE BY</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "conn.php";
                        //query ke database SELECT tabel mahasiswa urut berdasarkan nim yang paling besar
                        $sql = mysqli_query($conn, "SELECT m.*, IFNULL(a.username,'-') as create_by_name, IFNULL(a2.username,'-') as update_by_name FROM mahasiswa m INNER JOIN admin a ON m.create_by=a.id LEFT JOIN admin a2 on m.update_by=a2.id ORDER BY nim DESC") or die(mysqli_error($conn));
                        //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
                        if (mysqli_num_rows($sql) > 0) {
                            //membuat variabel $no untuk menyimpan nomor urut
                            $no = 1;
                            //melakukan perulangan while dengan dari dari query $sql
                            while ($data = mysqli_fetch_assoc($sql)) {
                                //menampilkan data perulangan
                                echo '
						<tr>
							<td>' . $no . '</td>
							<td>' . $data['nim'] . '</td>
							<td>' . $data['nama_depan'] . '</td>
							<td>' . $data['nama_tengah'] . '</td>
							<td>' . $data['nama_belakang'] . '</td>
							<td>' . $data['alamat'] . '</td>
							<td>' . $data['no_telp'] . '</td>
							<td>' . $data['create_date'] . '</td>
							<td>' . $data['create_by_name'] . '</td>
							<td>' . $data['update_date'] . '</td>
							<td>' . $data['update_by_name'] . '</td>
							<td>
                            
								<a href="edit_mhs.php?nim=' . $data['nim'] . '" class="badge bg-warning text-dark">Edit</a>
								<a href="delete_mhs.php?nim=' . $data['nim'] . '" class="badge bg-danger" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
							</td>
						</tr>
						';
                                $no++;
                            }
                            //jika query menghasilkan nilai 0
                        } else {
                            echo '
					<tr>
						<td colspan="12">Tidak ada data.</td>
					</tr>
					';
                        }
                        ?>
                    <tbody>
                </table>
                <hr>
            </div>

            <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                <table class="table table-striped table-hover table-sm table-bordered">
                    <br>
                    <a href="tambah_adm.php" class="btn btn-primary mb-lg-2" role="button">Tambah Data Admin</a>
                    <thead class="thead-dark">
                        <tr>
                            <th>NO</th>
                            <th>USERNAME</th>
                            <th>PASSWORD</th>
                            <th>ROLE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "conn.php";
                        //query ke database SELECT tabel mahasiswa urut berdasarkan nim yang paling besar
                        $sql = mysqli_query($conn, "SELECT * FROM admin ORDER BY id DESC") or die(mysqli_error($conn));
                        //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
                        if (mysqli_num_rows($sql) > 0) {
                            //membuat variabel $no untuk menyimpan nomor urut
                            $no = 1;
                            //melakukan perulangan while dengan dari dari query $sql
                            while ($data = mysqli_fetch_assoc($sql)) {
                                //menampilkan data perulangan
                                echo '
						<tr>
							<td>' . $no . '</td>
							<td>' . $data['username'] . '</td>
							<td>' . $data['password'] . '</td>
							<td>' . $data['role'] . '</td>
							<td>
								<a href="edit_adm.php?id=' . $data['id'] . '" class="badge bg-warning text-dark">Edit</a>
								<a href="delete_adm.php?id=' . $data['id'] . '" class="badge bg-danger" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
							</td>
						</tr>
						';
                                $no++;
                            }
                            //jika query menghasilkan nilai 0
                        } else {
                            echo '
					<tr>
						<td colspan="12">Tidak ada data.</td>
					</tr>
					';
                        }
                        ?>
                    <tbody>
                </table>
            </div>
        </div>

    </div>
</body>
<script src="js/bootstrap.min.js"></script>

</html>