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
        $del_query = "DELETE FROM `users` WHERE `users`.`id` = $del_id";
        if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') {
            if (mysqli_query($con, $del_query)) {
                $msg = "User Has been Deleted";
            } else {
                $error = "User Has Not been Deleted";
            }
        }
    }
    if (isset($_POST['checkboxes'])) {
        foreach ($_POST['checkboxes'] as $user_id) {
            $bulk_option = $_POST ['bulk-options'];
            if ($bulk_option == 'delete') {
                $bulk_del_query = "DELETE FROM `users` WHERE `users`.`id` = $user_id";
                mysqli_query($con, $bulk_del_query);

            } else if ($bulk_option == 'author') {
                $bulk_author_query = "UPDATE `users` SET `role` = 'author' WHERE `users`.`id` = $user_id";
                mysqli_query($con, $bulk_author_query);

            } else if ($bulk_option == 'admin') {
                $bulk_admin_query = "UPDATE `users` SET `role` = 'admin' WHERE `users`.`id` = $user_id";
                mysqli_query($con, $bulk_admin_query);
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
                <h1><i class="fa fa-users"></i> Users
                    <small>View All Users</small>
                </h1>
                <hr>
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="active"><i class="fa fa-users"></i> Users</li>
                </ol>
                <?php
                $query = "SELECT * FROM users ORDER BY id DESC";
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
                                    <a href="add_user.php" class="btn btn-primary">Add New</a>
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
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="selectallboxes"></th>
                            <th>Sr #</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Edit</th>
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
                            $first_name = ucfirst($row['first_name']);
                            $last_rname = ucfirst($row['last_rname']);
                            $username = $row['username'];
                            $email = $row['email'];
                            $image = $row['image'];
                            $password = $row['password'];
                            $role = $row['role'];

                            ?>
                            <tr>
                                <td><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?= $id; ?>">
                                </td>
                                <td><?= $id; ?></td>
                                <td><?= "$day $month $year"; ?></td>
                                <td><?= "$first_name $last_rname"; ?></td>
                                <td><?= $username; ?></td>
                                <td><?= $email; ?></td>
                                <td><img src="../img/<?= $image; ?>" width="30px"></td>
                                <td>****</td>
                                <td><?= ucfirst($role); ?></td>
                                <td><a href="edit-user.php?edit=<?= $id; ?>"><i class="fa fa-pencil"></i></a></td>
                                <td><a href="users.php?del=<?= $id; ?>"><i class="fa fa-times"></i></a></td>
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