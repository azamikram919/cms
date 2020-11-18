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
    <?php
    if (isset($_GET['del'])) {
        $del_id = $_GET['del'];
        $del_query = "DELETE FROM `slider` WHERE `slider`.`id` = $del_id";
        $run = mysqli_query($con, $del_query);
    }
    if (isset($_POST['checkboxes'])) {
        foreach ($_POST['checkboxes'] as $user_id) {
            $bulk_option = $_POST ['bulk-options'];
            if ($bulk_option == 'delete') {
                $bulk_del_query = "DELETE FROM `slider` WHERE `slider`.`id` = $user_id";
                mysqli_query($con, $bulk_del_query);

            } else if ($bulk_option == 'author') {
                $bulk_author_query = "UPDATE `slider` SET `role` = 'author' WHERE `slider`.`id` = $user_id";
                mysqli_query($con, $bulk_author_query);

            } else if ($bulk_option == 'admin') {
                $bulk_admin_query = "UPDATE `slider` SET `role` = 'admin' WHERE `slider`.`id` = $user_id";
                mysqli_query($con, $bulk_admin_query);
            }
        }
    }
    ?>
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
                <h1><i class="fa fa-sliders"></i> Slider Table
                    <small>View Slider Data</small>
                </h1>
                <hr>
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="active"><i class="fa fa-sliders"></i> Slider</li>
                </ol>
                <?php
                $query = "SELECT * FROM slider ORDER BY id DESC";
                $run = mysqli_query($con, $query);
                if (mysqli_num_rows($run) > 0) {

                ?>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <select name="bulk-options" id="" class="form-control">
                                            <option value="delete">Delete</option>
                                            <option value="author">Change to Author</option>
                                            <option value="admin">Change to Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <input type="submit" value="Apply" class="btn btn-success">
                                    <a href="add-slider.php" class="btn btn-primary">Add Slider</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($msg)) {
                        echo "<span style='color: green;' class='pull-right'>$msg</span>";
                    } else if (isset($error)) {
                        echo "<span style='color: red;' class='pull-right'>$error</span>";
                    }
                    ?>
                    <br>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="selectallboxes"></th>
                            <th>Sr #</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Images</th>
                            <th>Edit</th>
                            <th>Del</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP
                        while ($row = mysqli_fetch_array($run)) {
                            $id = $row['id'];
                            $title = ucfirst($row['title']);
                            $post_data = $row['discription'];
                            $image = $row['image'];
                            ?>
                            <tr>
                                <td><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?= $id; ?>">
                                </td>
                                <td><?= $id; ?></td>
                                <td><?= "$title"; ?></td>
                                <td><?= "$post_data" ?></td>
                                <td><img src="../img/<?= $image; ?>" width="30px"></td>
                                <td><a href="#"><i class="fa fa-pencil"></i></a></td>
                                <td><a href="sliders.php?del=<?= $id; ?>"><i class="fa fa-times"></i></a></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                    } else {
                        echo "<center><h2>No Users Available Now</h2></center>";
                    }
                    ?>
                </form>
            </div><!--close col-md-9-->
        </div><!--close row-->
    </div><!--close container-fluid-->
</section>
<script src="../assets/jquery/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>