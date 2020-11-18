<?php
ob_start();
session_start();
require_once '../inc/env.php';
require_once '../inc/conn.php';
if (!isset($_SESSION['username'])){
    header('Location: login.php');
}elseif (isset($_SESSION['username']) && $_SESSION['role'] == 'author'){
    header('location: index.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel</title>
    <link rel="icon" href="../img/faveicon.jpg">
    <link rel="stylesheet" href="assets/bootstrap-3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div id="wrapper">
    <?php require_once 'inc/nav.php' ?>

    <div class="container-fluid body-section">
        <div class="row">
            <div class="col-md-3">
                <?php require_once 'inc/sidebar.php' ?>
            </div>
            <div class="col-md-9">
                <h1><i class="fa fa-user-plus"></i> Add User
                    <small>Add New User</small>
                </h1>
                <hr>
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="active"><i class="fa fa-user-plus"></i>Add New User</li>
                </ol>
                <?php
                if (isset($_POST['submit'])) {
                    $date = time();
                    $first_name = mysqli_real_escape_string($con, $_POST['first-name']);
                    $last_name = mysqli_real_escape_string($con, $_POST['last-name']);
                    $username = mysqli_real_escape_string($con, strtolower($_POST['username']));
                    $username_trim = preg_replace('/\s+/', '', $username);
                    $email = mysqli_real_escape_string($con, strtolower($_POST['email']));
                    $password = mysqli_real_escape_string($con, $_POST['password']);
                    $role = $_POST['role'];
                    $image = $_FILES['image'] ['name'];
                    $image_tmp = $_FILES['image'] ['tmp_name'];

                    $check_query = "SELECT * FROM `users` WHERE `username` = '$username' or `email` = '$email'";
                    $check_run = mysqli_query($con, $check_query);

                    $salt_query = "SELECT * FROM `users` ORDER BY id DESC LIMIT 1";
                    $salt_run = mysqli_query($con, $salt_query);
                    $salt_row = mysqli_fetch_array($salt_run);
                    $salt = $salt_row['salt'];
                    $password = crypt($password, $salt);

                    if (empty($first_name) or empty($last_name) or empty($username) or empty($email) or empty($password) or empty($image)) {
                        $error = "(*) fields are Required";
                    } elseif ($username != $username_trim) {
                        $error = "Don't Use Space in Username";
                    } else if (mysqli_num_rows($check_run) > 0) {
                        $error = "Username or Email Already Exist";
                    } else {
                        $insert_query = "INSERT INTO `users`(`date`, `first_name`, `last_rname`, `username`, `email`, `image`, `password`, `role`)VALUES('$date', '$first_name', '$last_name', '$username', '$email', '$image', '$password', '$role')";
                        if (mysqli_query($con, $insert_query)) {
                            $msg = "User Has Been Added";
                            move_uploaded_file($image_tmp, "../img/$image");
                            $image_check = "SELECT * FROM `users` ORDER BY id DESC LIMIT 1";
                            $image_run = mysqli_query($con, $image_check);
                            $image_row = mysqli_fetch_array($image_run);
                            $check_image = $image_row['image'];

                            $first_name = "";
                            $last_name = "";
                            $username = "";
                            $email = "";

                        } else {
                            $error = "User Has Not Been Added";
                        }
                    }
                }
                ?>
                <div class="row">
                    <div class="col-md-8">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <lable for="first-name">First Name:</lable>
                                <?php
                                if (isset($error)) {
                                    echo "<span class='pull-right' style='color: red;'>$error</span>";
                                } else if (isset($msg)) {
                                    echo "<span class='pull-right' style='color: green;'>$msg</span>";
                                }
                                ?>
                                <input type="text" id="firs-name" name="first-name" class="form-control"
                                       placeholder="First Name" value="<?php if (isset($first_name)) {
                                    echo $first_name;
                                } ?>">
                            </div>
                            <div class="form-group">
                                <lable for="last-name">Last Name:</lable>
                                <input type="text" id="last-name" name="last-name" class="form-control"
                                       placeholder="Last Name" value="<?php if (isset($last_name)) {
                                    echo $last_name;
                                } ?>">
                            </div>
                            <div class="form-group">
                                <lable for="username">Username:</lable>
                                <input type="text" id="username" name="username" class="form-control"
                                       placeholder="username" value="<?php if (isset($username)) {
                                    echo $username;
                                } ?>">
                            </div>
                            <div class="form-group">
                                <lable for="email">Email:</lable>
                                <input type="text" id="email" name="email" class="form-control"
                                       placeholder="Email Address" value="<?php if (isset($email)) {
                                    echo $email;
                                } ?>">
                            </div>
                            <div class="form-group">
                                <lable for="password">Password:</lable>
                                <input type="password" id="password" name="password" class="form-control"
                                       placeholder="Password">
                            </div>
                            <div class="form-group">
                                <lable for="role">Role:</lable>
                                <select name="role" id="role" class="form-control">
                                    <option value="author">Author</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <lable for="image">Profile Picture:</lable>
                                <input type="file" id="image" name="image">
                            </div>
                            <input type="submit" name="submit" value="Add User" class="btn btn-primary">
                        </form>
                    </div>
                    <div class="col-md-4">
                        <?php
                        if (isset($check_image)) {
                            echo "<img src='../img/$check_image' width='100%'>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once 'inc/footer.php' ?>
</div>
<script src="assets/jquery/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>