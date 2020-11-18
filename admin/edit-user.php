<?php
ob_start();
session_start();
require_once '../inc/env.php';
require_once '../inc/conn.php';
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
} elseif (isset($_SESSION['username']) && $_SESSION['role'] == 'author') {
    header('location: index.php');
}
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $edit_query = "SELECT * FROM users WHERE id = $edit_id";
    $run = mysqli_query($con, $edit_query);
    if (mysqli_num_rows($run) > 0) {
        $edit_row = mysqli_fetch_array($run);
        $e_first_name = $edit_row['first_name'];
        $e_last_rname = $edit_row['last_rname'];
        $e_image = $edit_row['image'];
        $e_details = $edit_row['details'];
        $e_role = $edit_row['role'];
    } else {
        header('location: index.php');
    }
} else {
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
    <title>Xaim | Admin</title>
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
                <h1><i class="fa fa-user"></i> Edit User
                    <small>Edit User Details</small>
                </h1>
                <hr>
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="active"><i class="fa fa-user"></i>Edit User</li>
                </ol>
                <?php
                if (isset($_POST['submit'])) {

                    $first_name = mysqli_real_escape_string($con, $_POST['first-name']);
                    $last_name = mysqli_real_escape_string($con, $_POST['last-name']);
                    $password = mysqli_real_escape_string($con, $_POST['password']);

                    $role = $_POST['role'];
                    $image = $_FILES['image'] ['name'];
                    $image_tmp = $_FILES['image'] ['tmp_name'];
                    $details = mysqli_real_escape_string($con, $_POST['details']);

                    if (empty($image)){
                        $image = $e_image;
                    }

                    $salt_query = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
                    $salt_run = mysqli_query($con, $salt_query);
                    $salt_row = mysqli_fetch_array($salt_run);
                    $salt = $salt_row['salt'];
                    $insert_password = crypt($password, $salt);

                    if (empty($first_name) or empty($last_name) or empty($password) or empty($image)) {
                        $error = "(*) fields are Required";
                    } else {
                       $update_query = "UPDATE `users` SET `first_name` = '$first_name', `last_rname` = '$last_name',`image` = '$image', `role` = '$role', `details` = '$details'";
                       if (isset($password)){
                           $update_query .= ", `password` = '$insert_password'";
                       }
                       $update_query .= " WHERE `users`.`id` = $edit_id";
                       if (mysqli_query($con, $update_query)){
                           $msg = "User Has Been Updated";
                           header("refresh: 1; url=edit-user.php?edit=$edit_id");

                           if (empty($image)){
                               move_uploaded_file($image_tmp, "../img/$image");
                           }

                       }else{
                           $error = "User Has Not Been Updated";
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
                                       placeholder="First Name" value="<?= $e_first_name;?>">
                            </div>
                            <div class="form-group">
                                <lable for="last-name">Last Name:</lable>
                                <input type="text" id="last-name" name="last-name" class="form-control"
                                       placeholder="Last Name" value="<?= $e_last_rname;?>">
                            </div>
                            <div class="form-group">
                                <lable for="password">Password:</lable>
                                <input type="password" id="password" name="password" class="form-control"
                                       placeholder="Password">
                            </div>
                            <div class="form-group">
                                <lable for="role">Role:</lable>
                                <select name="role" id="role" class="form-control">
                                    <option value="author" <?php if ($e_role == 'author'){echo "selected";}?>>Author</option>
                                    <option value="admin" <?php if ($e_role == 'admin'){echo "selected";}?>>Admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <lable for="image">Profile Picture:</lable>
                                <input type="file" id="image" name="image">
                            </div>
                            <div class="form-group">
                                <lable for="details">Details:</lable>
                                <textarea name="details" id="details" cols="30" rows="10" class="form-control"><?= $e_details;?></textarea>
                            </div>
                            <input type="submit" name="submit" value="Update User" class="btn btn-primary">
                        </form>
                    </div>
                    <div class="col-md-4">
                        <?php
                            echo "<img src='img/$e_image' alt='' width='100%'>";
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