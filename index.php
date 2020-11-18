<?php
ob_start();
session_start();
require_once 'inc/env.php';
require_once 'inc/conn.php';
if (maintenance == 'development') {
    //redirect to specific page
    header('Location: maintenance.php');
}
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/jpg" href="img/faveicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link rel="stylesheet" href="assets/bootstrap-3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Blog post</title>
</head>
<body>
<?php require_once 'inc/nav.php';

$numb_of_posts = 2;
if (isset($_GET['page'])) {
    $page_id = $_GET['page'];
} else {
    $page_id = 1;
}
if (isset($_GET['cat'])) {
    $cat_id = $_GET['cat'];
    $cat_query = "SELECT * FROM categories WHERE id = $cat_id";
    $cat_run = mysqli_query($con, $cat_query);
    $cat_row = mysqli_fetch_array($cat_run);
    $cat_name = $cat_row['categories'];
}
if (isset($_POST['search'])) {
    $search = $_POST['search-title'];
    $posts_query = "SELECT * FROM posts WHERE status = 'publish'";
    $posts_query .= " and tags LIKE '%$search%'";
    $posts_run = mysqli_query($con, $posts_query);
    $all_posts = mysqli_num_rows($posts_run);
    $pages = ceil($all_posts / $numb_of_posts);
    $posts_start_from = ($page_id - 1) * $numb_of_posts;
} else {
    $posts_query = "SELECT * FROM posts WHERE status = 'publish'";
    if (isset($cat_name)) {
        $posts_query .= " and categories = '$cat_name'";
    }
    $posts_run = mysqli_query($con, $posts_query);
    $all_posts = mysqli_num_rows($posts_run);
    $pages = ceil($all_posts / $numb_of_posts);
    $posts_start_from = ($page_id - 1) * $numb_of_posts;
}

?>
<div class="jumbotron">
    <div class="container">
        <div id="details" class="animated bounceInDown">
            <h1>Xaim<span> Blog</span></h1>
            <p>So now shine with Us</p>
        </div>
    </div>
    <img src="img/nav.jpg">
</div><!--Jumbotron-->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php

                if (isset($_POST['search'])) {
                    $search = $_POST['search-title'];
                    $query = "SELECT * FROM `posts` WHERE status = 'publish'";
                    $query .= "and tags LIKE '%$search%'";
                    $query .= " ORDER BY id DESC LIMIT $posts_start_from, $numb_of_posts";
                } else {
                    $query = "SELECT * FROM `posts` WHERE status = 'publish'";
                    if (isset($cat_name)) {
                        $query .= "and categories = '$cat_name'";
                    }
                    $query .= " ORDER BY id DESC LIMIT $posts_start_from, $numb_of_posts";
                }
                $run = mysqli_query($con, $query);
                if (mysqli_num_rows($run) > 0) {
                    while ($row = mysqli_fetch_array($run)) {
                        $id = $row['id'];
                        $date = getdate($row['date']);
                        $day = $date['mday'];
                        $month = $date['month'];
                        $year = $date['year'];
                        $title = $row['title'];
                        $author = $row['author'];
                        $author_image = $row['author_image'];
                        $image = $row['image'];
                        $categories = $row['categories'];
                        $tags = $row['tags'];
                        $post_date = $row['post_data'];
                        $views = $row['views'];
                        $status = $row['status'];

                        ?>
                        <div class="post">
                            <div class="row">
                                <div class="col-md-2 post-date">
                                    <div class="day"><?php echo $day; ?></div>
                                    <div class="month"><?php echo $month; ?></div>
                                    <div class="year"><?php echo $year; ?></div>
                                </div>
                                <div class="col-md-8 post-title">
                                    <a href="post.php?post_id=<?php echo $id; ?>"><h2><?php echo $title; ?></h2></a>
                                    <p>Written by:<span><?php echo ucfirst($author); ?></span></p>
                                </div>
                                <div class="col-md-2 profile-picture">
                                    <img src="img/<?php echo $author_image; ?>" alt="profile picture"
                                         class="img-circle">
                                </div>
                            </div>
                            <a href="post.php?post_id=<?php echo $id; ?>"><img src="img/<?php echo $image; ?>"
                                                                               alt="post Image"></a>
                            <div class="desc">
                                <?php echo substr($post_date, 0, 400) . "......"; ?>
                            </div>
                            <a href="post.php?post_id=<?php echo $id; ?>" class=" btn btn-primary">Read More...</a>
                            <div class="bottom">
                                <span class="first"><i class="fa fa-folder"></i><a
                                            href="#"><?php echo ucfirst($categories); ?></a></span> |
                                <span class="sec"><i class="fa fa-comment"></i><a href="#">Comment</a></span>
                            </div>
                        </div><!--close post area-->
                        <?php
                    }
                } else {
                    echo "<center><h2>No Posts Available</h2></center>";
                }
                ?>
                <nav id="pagination">
                    <ul class="pagination">
                        <?php
                        for ($i = 1; $i <= $pages; $i++) {
                            echo "<li class='" . ($page_id == $i ? 'active' : '') . "'>
                        <a href='index.php?page=" . $i . "&" . (isset($cat_name) ? "cat=$cat_id" : "") . "'>$i</a></li>";
                        }
                        ?>
                    </ul>
                </nav><!--close pagination-->
            </div><!--close col 8-->
            <div class="col-md-4">
                <?php require_once 'inc/sidebar.php' ?>
            </div><!--close col 4-->
        </div>
</section>
<footer>
    <div class="container">
        <?php require_once 'inc/footer.php'; ?>
    </div>
</footer>
<script src="assets/jquery/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>