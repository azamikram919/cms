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
if (isset($_POST['submit'])) {
    $cat_name = mysqli_real_escape_string($con, strtolower($_POST['cat-name']));
    $query = "SELECT * FROM categories WHERE categories = $cat_name";
    $run = mysqli_query($con, $query);
    if (mysqli_num_rows($run) > 0) ;
    $error = "Category already exist";
} else {
    $insert_query = "INSERT INTO categories (`categories`) VALUES ('$cat_name')";
    //echo $insert_query;
    //exit();
    if (mysqli_num_rows($con, $insert_query)) {
        $msg = "Category Has Been Added";
    } else {
        $error = "Category Has Not Been Added";
    }
}
?><!doctype html>
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
                <h1><i class="fa fa-folder-open"></i> Categories
                    <small>Different Categories</small>
                </h1>
                <hr>
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="active"><i class="fa fa-folder-open"></i> Categories</li>
                </ol>
                <div class="row">
                    <div class="col-md-6">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="category">Category Name:</label>
                                <?php
                                if (isset($msg)) {
                                    echo "<span class='pull-right' style='color: green;'>$msg</span>";
                                } elseif (isset($error)) {
                                    echo "<span class='pull-right' style='color: red;'>$error</span>";
                                }
                                ?>
                                <input type="text" placeholder="Category Name" class="form-control" name="cat-name">
                            </div>
                            <input type="submit" name="submit" value="Add Category" class="btn btn-primary">
                        </form>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Sr #</th>
                                <th>Category Name</th>
                                <th>Posts</th>
                                <th>Edit</th>
                                <th>Del</th>
                            </tr>
                            </thead>
                            <tbady>
                                <tr>
                                    <td>1</td>
                                    <td>CMS</td>
                                    <td>13</td>
                                    <td><a href="#"><i class="fa fa-pencil"></i></a></td>
                                    <td><a href="#"><i class="fa fa-times"></i></a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>CMS</td>
                                    <td>13</td>
                                    <td><a href="#"><i class="fa fa-pencil"></i></a></td>
                                    <td><a href="#"><i class="fa fa-times"></i></a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>CMS</td>
                                    <td>13</td>
                                    <td><a href="#"><i class="fa fa-pencil"></i></a></td>
                                    <td><a href="#"><i class="fa fa-times"></i></a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>CMS</td>
                                    <td>13</td>
                                    <td><a href="#"><i class="fa fa-pencil"></i></a></td>
                                    <td><a href="#"><i class="fa fa-times"></i></a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>CMS</td>
                                    <td>13</td>
                                    <td><a href="#"><i class="fa fa-pencil"></i></a></td>
                                    <td><a href="#"><i class="fa fa-times"></i></a></td>
                                </tr>
                            </tbady>
                        </table>
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