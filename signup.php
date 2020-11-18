<?php
require_once 'inc/env.php';
require_once 'inc/conn.php';
if (isset($_POST['sign-up'])) {
    $first_name = $_POST['first_name'];
    $last_rname = $_POST['last_rname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $image = $_FILES['image'] ['name'];
    $image_tmp = $_FILES['image'] ['tmp_name'];

    move_uploaded_file($image_tmp, "img/$image");

    //echo  $first_name. $last_rname. $username. $email. $password. $image. $image_tmp;
    //exit();
    $query = "INSERT INTO users (`first_name`, `last_rname`, `username`, `email`, `image`, `password`, `role`, `created_at`)
    VALUES ('$first_name', '$last_rname', '$username', '$email', '$image', '$password', '$role','')";

    if (mysqli_query($con, $query)) {
        echo "successful.";
        header('location:login.php');
    } else {
        echo "Not Successful";
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
    <title>Signup</title>
    <link rel="stylesheet" href="assets/bootstrap-3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome">
    <link rel="stylesheet" href="assets/css/styling.css">
</head>
<body>
<div class="signup-form">
    <form action="signup.php" method="post" enctype="multipart/form-data">
        <div class="form-header">
            <h2> Sign Up </h2>
        </div>
        <div class="form-group">
            <label> Firstname</label>
            <input type="text" class="form-control" name="first_name" placeholder="Firstname" required="required">
        </div>
        <div class="form-group">
            <label> Lastname</label>
            <input type="text" class="form-control" name="last_rname" placeholder="Lastname" required="required">
        </div>
        <div class="form-group">
            <label> Username</label>
            <input type="text" class="form-control" name="username" placeholder="username" required="required">
        </div>
        <div class="form-group">
            <label> Email Address </label>
            <input type="email" class="form-control" name="email" placeholder="email" required="required">
        </div>
        <div class="form-group">
            <lable for="role">Role:</lable>
            <select name="role" id="role" class="form-control">
                <option value="author">Author</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <br>
        <div class="form-group">
            <label> Password</label>
            <input type="password" class="form-control" name="password" placeholder="password" required="required">
        </div>
        <div class="form-group">
            <lable for="image">Profile Picture:</lable>
            <input type="file" id="image" name="image">
        </div>
        <div class="form-group">
            <button type="submit" name="sign-up" class="btn btn-primary btn-block btn-lg"> Sign Up</button>
        </div>
    </form>
    <div class="text-center small">Already have an account? <a href="login.php">Login here</a></div>
</div>
<script src="assets/jquery/jquery.js"></script>
<script src="assets/jquery/jquery.min.js"></script>
</body>
</html>
