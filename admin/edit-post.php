<?php
ob_start();
session_start();
require_once '../inc/env.php';
require_once '../inc/conn.php';
if (empty($_SESSION['username'])) {
    header('Location: login.php');
}
$session_username = $_SESSION['username'];
$session_role = $_SESSION['role'];
$session_author_image = $_SESSION['author_image'];
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    if ($session_role == 'admin') {
        $get_query = "SELECT * FROM posts WHERE id = $edit_id";
        $get_run = mysqli_query($con, $get_query);
    } else if ($session_role == 'author') {
        $get_query = "SELECT * FROM posts WHERE id = $edit_id and author = '$session_role'";
        $get_run = mysqli_query($con, $get_query);
    }

    if (mysqli_num_rows($get_run) > 0) {
        $get_row = mysqli_fetch_array($get_run);
        $title = $get_row['title'];
        $post_data = $get_row['post_data'];
        $tags = $get_row['tags'];
        $status = $get_row['image'];
        $categories = $get_row['categories'];
    } else {
        header('location: posts.php');
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
                <h1><i class="fa fa-pencil"></i> Edit Post
                    <small>Edit Post Details</small>
                </h1>
                <hr>
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                    <li class="active"><i class="fa fa-pencil"></i> Edit Post</li>
                </ol>
                <?php
                if (isset($_POST['update'])) {
                    $up_title = mysqli_real_escape_string($con, $_POST['title']);
                    $up_tags = mysqli_real_escape_string($con, $_POST['tags']);
                    $up_post_data = mysqli_real_escape_string($con, $_POST['post-data']);
                    $up_status = $_POST['status'];
                    $up_categories = $_POST['categories'];
                    $up_image = $_FILES['image'] ['name'];
                    $up_image_tmp = $_FILES['image'] ['tmp_name'];

                    if (empty($up_image)) {
                        $up_image = $up_image;
                    }

                    if (empty($title) or empty($tags) or empty($post_data) or empty($up_image)) {
                        $error = "(*)fields are required";
                    } else {
                        $update_query = "UPDATE posts SET title = '$up_title', tags = '$up_tags', post_data = '$up_post_data', status = '$up_status', categories = '$up_categories', image = '$up_image',  WHERE  id = '$edit_id'";
                        //echo $update_query;
                        //exit();
                        if (mysqli_query($con, $update_query)) {
                            $path = "img/$up_image";
                            if (!empty($up_image)) {
                                if (move_uploaded_file($up_image_tmp, $path)) {
                                    copy($path, "../$path");
                                    header("location : edit-post.php?edit=$edit_id");
                                }
                            }
                            $msg = "Post Has Been Updated";
                            $title = "";
                            $tags = "";

                        } else {
                            $error = "Post Has Not Been Updated";
                        }
                    }
                }
                ?>
                <div class="row">
                    <div class="col-xs-12">
                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="title">Title:</label>
                                <?php
                                if (isset($msg)) {
                                    echo "<span class='pull-right' style='color: green'>$msg</span>";
                                } elseif (isset($error)) {
                                    echo "<span class='pull-right' style='color: red'>$error</span>";
                                }
                                ?>
                                <input type="text" value="<?php if (isset($title)) {
                                    echo $title;
                                } ?>" name="title" placeholder="Type Post Title Here" class="form-control">
                            </div>

                            <div class="form-group">
                                <textarea name="post-data" id="textarea" cols="30" rows="16"
                                          class="form-control tinymce"><?php if (isset($post_data)) {
                                        echo $post_data;
                                    } ?></textarea>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="file">Post Image:</label>
                                        <input type="file" name="image">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="categories">Categories:</label>
                                        <select class="form-control" name="categories">
                                            <?php
                                            $cat_query = "SELECT * FROM categories ORDER BY id DESC";
                                            $cat_run = mysqli_query($con, $cat_query);
                                            if (mysqli_num_rows($cat_run) > 0) {
                                                while ($row = mysqli_fetch_array($cat_run)) {
                                                    $cat_name = $row['categories'];
                                                    echo "<option value='" . $cat_name . "'>" . ucfirst($cat_name) . "</option>";
                                                }
                                            } else {
                                                echo "<center><h5>No Category Available</h5></center>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="tags">Tags:</label>
                                        <input type="text" value="<?php if (isset($tags)) {
                                            echo $tags;
                                        } ?>" name="tags" placeholder="Your Tags Here"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="status">Status:</label>
                                        <select class="form-control" name="status">
                                            <option value="publish">Publish</option>
                                            <option value="draft">Draft</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" name="update" value="Update Post" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once 'inc/footer.php' ?>
</div>
<script src="assets/jquery/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/tinymce/tinymce.min.js"></script>
<script src="assets/js/tinymce/init-tinymce.js"></script>
</body>
</html>