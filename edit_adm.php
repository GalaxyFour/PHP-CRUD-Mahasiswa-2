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
    $id_adm = $_POST['id'];

    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // update user data
    $result = mysqli_query($conn, "UPDATE admin SET username='$username', password='$password', role='$role' WHERE id=$id_adm");

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
    <title>Edit Admin</title>

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
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Data Admin</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <br>
                <div class="col-9">
                    <?php
                    include('conn.php');
                    $id_adm = $_GET['id'];

                    // Fetech user data based on id
                    $result = mysqli_query($conn, "SELECT * FROM admin WHERE id=$id_adm");

                    while ($data = mysqli_fetch_array($result)) {
                        $username = $data['username'];
                        $password = $data['password'];
                        $role = $data['role'];
                        $id_adm = $data['id'];
                    }
                    ?>
                    <h2 class="mb-4">Edit Data admin</h2>
                    <form action="edit_adm.php" method="post">

                        <input type="hidden" name="id" value="<?php echo $id_adm; ?>">

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">USERNAME</label>
                            <div class="col-sm-6">
                                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">PASSWORD</label>
                            <div class="col-sm-6">
                                <input type="text" name="password" class="form-control" value="<?php echo $password; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">ROLE</label>
                            <div class="col-sm-6">
                                <input type="text" name="role" class="form-control" value="<?php echo $role; ?>" required>
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