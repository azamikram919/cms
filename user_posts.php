<?php
ob_start();
session_start();
require_once 'inc/env.php';
require_once 'inc/conn.php';
if (empty($_SESSION['username'])) {
    header('Location: admin/login.php');
}
$session_username = $_SESSION['username'];
$session_author_image = $_SESSION['author_image'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel</title>
    <link rel="icon" href="img/faveicon.jpg">
    <link rel="stylesheet" href="assets/bootstrap-3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div id="wrapper">
<?= require_once 'inc/nav.php';?>
    <div class="container body-section">
        <div class="row">
            <div class="col-md-8">

                <?php
                if (isset($_POST['submit'])) {
                    $date = time();
                    $title = mysqli_real_escape_string($con, $_POST['title']);
                    $tags = mysqli_real_escape_string($con, $_POST['tags']);
                    $post_data = mysqli_real_escape_string($con, $_POST['post-data']);
                    $status = $_POST['status'];
                    $categories = $_POST['categories'];
                    $image = $_FILES['image'] ['name'];
                    $image_tmp = $_FILES['image'] ['tmp_name'];
                    if (empty($title) or empty($tags) or empty($post_data) or empty($image)) {
                        $error = "(*)fields are required";
                    } else {
                        $insert_query = "INSERT INTO posts ( date, title, author, author_image,
                          image, categories, tags,post_data, views, status)
                         VALUES ('$date', '$title', '$session_username', '$session_author_image', '$image', '$categories', '$tags', '$post_data', '12', '$status')";
                        if (mysqli_query($con, $insert_query)) {
                            $path = "img/$image";
                            if (move_uploaded_file($image_tmp, $path)) {
                                copy($path, "$path");
                            }
                            $msg = "Post Has Been Added";
                            $title = "";
                            $tags = "";

                        } else {
                            $error = "Post Has Not Been Added";
                        }
                    }
                }
                ?>
                <div class="row">
                    <div class="col-xs-12">
                        <form action="" method="post" enctype="multipart/form-data">
                            <br><br><br><div class="form-group">
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
                                          class="form-control tinymce"></textarea>
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
                            <input type="submit" name="submit" value="User Post" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">

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