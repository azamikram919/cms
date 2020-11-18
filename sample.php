<div class="col-md-9">
    <h1><i class="fa fa-plus-square"></i> Add Slider
        <small>Add New Slider</small>
    </h1>
    <hr>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-tachometer"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-square"></i> Add Post</li>
    </ol>
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
                    copy($path, "../$path");
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
                <input type="submit" name="submit" value="Add Post" class="btn btn-primary">
            </form>
        </div>
    </div>
</div><!--close col-md-9-->