<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>


    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container ">
        <form action="action_login.php" method="post">
            <div class="imgcontainer">
                <img src="unpam.png" alt="Avatar" class="unpam">
            </div>
            <h2>Login Form</h2>
            <div class="container">
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</body>

</html>