<?php
ob_start();
session_start();
require_once '../inc/env.php';
require_once '../inc/conn.php';

if (isset($_POST['sign-in'])) {
    $username = mysqli_real_escape_string($con, strtolower($_POST['username']));
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "SELECT * FROM users WHERE username = '$username'";
    $run = mysqli_query($con, $query);
    if ($row = mysqli_fetch_array($run)) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['role'] = $row ['role'];
        $_SESSION['author_image'] = $row['image'];
        header('Location: index.php');

    } else {
        $error = "Wrong Username or Password";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Xaim | Blog Admin</title>
    <link rel="icon" href="../img/faveicon.jpg">
    <link rel="stylesheet" href="assets/bootstrap-3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style1.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
<div class="login-form">
    <form action="login.php" method="post">
        <div class="form-header">
            <h2>Login</h2>
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="username" placeholder="Username" required="required">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" id="input-username" class="form-control" name="password" placeholder="password"
                   required="required">
        </div>
        <div class="form-group">
            <button type="submit" id="input-password" name="sign-in" class="btn btn-primary btn-block btn-lg">Sign in
            </button>
        </div>
        <?php
        if (isset($error)) {
            echo "<center>$error</center>";
        }
        ?>
    </form>
</div>
<script src="assets/jquery/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>