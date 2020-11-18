<?php
ob_start();
session_start();
require_once '../inc/env.php';
require_once '../inc/conn.php';


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/jpg" href="../img/faveicon.jpg">
    <link rel="stylesheet" href="../assets/bootstrap-3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Blog post</title>
</head>
<body>
<?php require_once 'inc/nav.php'; ?>
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <?php require_once 'inc/sidebar.php'; ?>
            </div>
            <div class="col-md-9">
                <h1><i class="fa fa-plus-square"></i> Add Slider
                    <small>Add New Slider</small>
                </h1>
                <hr>
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                    <li class="active"><i class="fa fa-sliders"></i> Add Slider</li>
                </ol>
                <?php
                if (isset($_POST['submit'])) {
                    $title = mysqli_real_escape_string($con, $_POST['title']);
                    $post_data = mysqli_real_escape_string($con, $_POST['post-data']);

                    $image = $_FILES['image'] ['name'];
                    $image_tmp = $_FILES['image'] ['tmp_name'];
                    if (empty($title) or empty($post_data) or empty($image)) {
                        $error = "(*)fields are required";
                    } else {
                        $insert_query = "INSERT INTO `slider`(`title`, `discription`, `image`)
                         VALUES('$title',  '$post_data', '$image')";

                        if (mysqli_query($con, $insert_query)) {
                            $path = "img/$image";
                            if (move_uploaded_file($image_tmp, $path)) {
                                copy($path, "../$path");
                            }
                            $msg = "Slider Has Been Added";
                            $title = "";

                        } else {
                            $error = "Slider Has Not Been Added";
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
                                    } ?>
                                </textarea>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="file">Slider Image:</label>
                                        <input type="file" name="image">
                                    </div>
                                </div>
                                <div class="col-sm-6">

                                </div>
                            </div>
                            <input type="submit" name="submit" value="Add Post" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div><!--close col-md-9-->
        </div><!--close row-->
    </div><!--close container-fluid-->
</section>
<script src="../assets/jquery/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>