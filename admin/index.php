<?php
ob_start();
session_start();
require_once '../inc/env.php';
require_once '../inc/conn.php';
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
$activePage = basename($_SERVER['PHP_SELF'], "index.php");
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
                <h1><i class="fa fa-dashboard"></i> Dashboard
                    <small>Statics Overview</small>
                </h1>
                <hr>
                <ol class="breadcrumb">
                    <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
                </ol>

                <div class="row tag-boxes">
                    <div class="col-md-6 col-lg-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="text-right huge">11</div>
                                        <div class="text-right">All Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View All Comments</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="text-right huge">28</div>
                                        <div class="text-right">All Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View All Posts</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="text-right huge">14</div>
                                        <div class="text-right">All Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View All Users</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-folder-open fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="text-right huge">9</div>
                                        <div class="text-right">All Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View All Categories</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <hr>
                <h3>New Users</h3>
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Sr #</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Role</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>23 May 2020</td>
                        <td>Muhammad Azam</td>
                        <td>Xaim Blog</td>
                        <td>Admin</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>23 May 2020</td>
                        <td>Muhammad Azam</td>
                        <td>Xaim Blog</td>
                        <td>Admin</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>23 May 2020</td>
                        <td>Muhammad Azam</td>
                        <td>Xaim Blog</td>
                        <td>Admin</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>23 May 2020</td>
                        <td>Muhammad Azam</td>
                        <td>Xaim Blog</td>
                        <td>Admin</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>23 May 2020</td>
                        <td>Muhammad Azam</td>
                        <td>Xaim Blog</td>
                        <td>Admin</td>
                    </tr>
                    </tbody>
                </table>
                <a href="#" class="btn btn-primary">View All Users</a>
                <hr>
                <h3>New Posts</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Sr #</th>
                        <th>Date</th>
                        <th>Post Title</th>
                        <th>Category</th>
                        <th>Views</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>23 5 2020</td>
                        <td>PHP Project</td>
                        <td>CMS</td>
                        <td><i class="fa fa-eye"></i> 120</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>23 5 2020</td>
                        <td>PHP Project</td>
                        <td>CMS</td>
                        <td><i class="fa fa-eye"></i> 120</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>23 5 2020</td>
                        <td>PHP Project</td>
                        <td>CMS</td>
                        <td><i class="fa fa-eye"></i> 120</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>23 5 2020</td>
                        <td>PHP Project</td>
                        <td>CMS</td>
                        <td><i class="fa fa-eye"></i> 120</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>23 5 2020</td>
                        <td>PHP Project</td>
                        <td>CMS</td>
                        <td><i class="fa fa-eye"></i> 120</td>
                    </tr>
                    </tbody>
                </table>
                <a href="#" class="btn btn-primary">View All Posts</a>
            </div>
        </div>
    </div>
    <?php require_once 'inc/footer.php' ?>
</div>
<script src="assets/jquery/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>