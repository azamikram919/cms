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
$session_username = $_SESSION['username'];
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
    <?php
    if (isset($_GET['del'])) {
        $del_id = $_GET['del'];
        $query = "SELECT * FROM comments WHERE id = $del_id";
        $run = mysqli_query($con, $query);
        if (mysqli_num_rows($run) > 0) {
            $del_query = "DELETE FROM `comments` WHERE `comments`.`id` = $del_id";
            if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') {
                if (mysqli_query($con, $del_query)) {
                    $msg = "Comment Has been Deleted";
                } else {
                    $error = "Comment Has Not been Deleted";
                }
            }
        } else {
            header('location: index.php');
        }
    }

    if (isset($_GET['approve'])) {
        $approve_id = $_GET['approve'];
        $query = "SELECT * FROM comments WHERE id = $approve_id";
        $run = mysqli_query($con, $query);
        if (mysqli_num_rows($run) > 0) {
            $approve_query = "UPDATE `comments` SET `status` = 'approve' WHERE `comments`.`id` = $approve_id";
            if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') {
                if (mysqli_query($con, $approve_query)) {
                    $msg = "Comment Has Been Approved";
                } else {
                    $error = "Comment Has Not Been Approved";
                }
            }
        } else {
            header('location: index.php');
        }
    }

    if (isset($_GET['unapprove'])) {
        $unapprove_id = $_GET['unapprove'];
        $query = "SELECT * FROM comments WHERE id = $unapprove_id";
        $run = mysqli_query($con, $query);
        if (mysqli_num_rows($run) > 0) {
            $unapprove_query = "UPDATE `comments` SET `status` = 'pending' WHERE `comments`.`id` = $unapprove_id";
            if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') {
                if (mysqli_query($con, $unapprove_query)) {
                    $msg = "Comment Has Been Approved";
                } else {
                    $error = "Comment Has Not Been Approved";
                }
            }
        } else {
            header('location: index.php');
        }
    }

    if (isset($_POST['checkboxes'])) {
        foreach ($_POST['checkboxes'] as $user_id) {
            $bulk_option = $_POST ['bulk-options'];
            if ($bulk_option == 'delete') {
                $bulk_del_query = "DELETE FROM `comments` WHERE `commments`.`id` = $user_id";
                mysqli_query($con, $bulk_del_query);

            } else if ($bulk_option == 'approve') {
                $bulk_approve_query = "UPDATE `comments` SET `status` = 'approve' WHERE `comments`.`id` = $user_id";
                mysqli_query($con, $bulk_approve_query);

            } else if ($bulk_option == 'pending') {
                $bulk_pending_query = "UPDATE `comments` SET `status` = 'pending' WHERE `comments`.`id` = $user_id";
                mysqli_query($con, $bulk_pending_query);
            }
        }
    }
    ?>
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
                <h1><i class="fa fa-comments"></i> Comments
                    <small>View All Comments</small>
                </h1>
                <hr>
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="active"><i class="fa fa-comments"></i> Comments</li>
                </ol>
                <?php
                if (isset($_GET['reply'])) {
                    $reply_id = $_GET['reply'];
                    $reply_query = "SELECT * FROM comments WHERE post_id = $reply_id";
                    $run = mysqli_query($con, $reply_query);
                    if (mysqli_num_rows($run) > 0) {
                        if (isset($_pOST['reply'])) {
                            $comment_data = $_POST['comment'];
                            if (empty($comment_data)){
                                $comment_error = "Must Fill This Field";
                            }else{
                                $get_user_data = "SELECT * FROM users WHERE username = '$session_username'";
                                $get_user_run = mysqli_query($con, $get_user_data);
                                $get_user_row = mysqli_fetch_array($get_user_run);
                                $date = time();
                                $first_name = $get_user_row['first_name'];
                                $last_rname = $get_user_row['first_rname'];
                                $full_name = "$first_name $last_rname";
                                $email = $get_user_row['email'];
                                $image = $get_user_row['image'];

                                $insert_query = "INSERT INTO `comments`(`date`, `name`, `username`, `post_id`, `email`, `image`, `comment`, `status`) 
                                VALUES ('$date', '$full_name', '$session_username', '$reply_id', '$email', '$image', '$comment_data' 'approve')";

                                if (mysqli_query($con, $insert_query)){
                                   $comment_msg = "Comment Has Been Submitted";
                               }else{
                                   $comment_error = "Comment Has Not Been Submitted";
                               }
                            }
                        }

                        ?>
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="comment">Comment:</label>
                                        <?php
                                        if (isset($comment_error)){
                                            echo "<span class='pull-right' style='color: red;'>$comment_error</span>";
                                        }
                                        elseif (isset($comment_msg)){
                                            echo "<span class='pull-right' style='color: green;'>$comment_msg</span>";
                                        }
                                        ?>
                                        <textarea name="comment" id="comment" col="30" rows="10"
                                                  placeholder="Your Comment Here" class="form-control"></textarea>
                                    </div>
                                    <input type="submit" name="submit" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                        <hr>
                        <?php
                    }
                }
                $query = "SELECT * FROM comments ORDER BY id DESC";
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
                                            <option value="approve">Approve</option>
                                            <option value="pendin">Unapprove</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <input type="submit" value="Apply" class="btn btn-success">
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
                    <hr>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="selectallboxes"></th>
                            <th>Sr #</th>
                            <th>Date</th>
                            <th>Username</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th>Approve</th>
                            <th>Unapprove</th>
                            <th>Reply</th>
                            <th>Del</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP
                        while ($row = mysqli_fetch_array($run)) {
                            $id = $row['id'];
                            $date = getdate($row['date']);
                            $day = $date['mday'];
                            $month = substr($date['month'], 0, 3);
                            $year = $date['year'];
                            $username = $row['username'];
                            $status = $row['status'];
                            $comment = $row['comment'];
                            $post_id = $row['post_id'];
                            ?>
                            <tr>
                                <td><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?= $id; ?>">
                                </td>
                                <td><?= $id; ?></td>
                                <td><?= "$day $month $year"; ?></td>
                                <td><?= $username; ?></td>
                                <td><?= $comment ?></td>
                                <td><?= ucfirst($status) ?></td>
                                <td><a href="comments.php?approve=<?= $id; ?>">Approve</a></td>
                                <td><a href="comments.php?unapprove=<?= $id; ?>">Unapprove</a></td>
                                <td><a href="comments.php?reply=<?= $post_id; ?>"><i class="fa fa-reply"></i></a></td>
                                <td><a href="comments.php?del=<?= $id; ?>"><i class="fa fa-times"></i></a></td>
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
            </div>
        </div>
    </div>
    <?php require_once 'inc/footer.php' ?>
</div>
<script src="assets/jquery/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/code.js"></script>
</body>
</html>