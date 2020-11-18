<?php
ob_start();
session_start();
require_once 'inc/env.php';
require_once 'inc/conn.php';
if (maintenance == 'development') {
    //redirect to specific page
    header('Location: maintenance.php');
}
$query = "SELECT * FROM posts WHERE status = 'publish'";
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $query .= " and id = '$post_id'";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/jpg" href="img/faveicon.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link rel="stylesheet" href="assets/bootstrap-3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Blog post</title>
</head>
<body>
<?php require_once 'inc/nav.php' ?>
<div class="jumbotron">
    <div class="container">
        <div id="details" class="animated bounceInDown">
            <h1>Custom<span> Post</span></h1>
            <p>How you can put your own tag Line to make it more Assttractive</p>
        </div>
    </div>
    <img src="img/nav.jpg">
</div><!--Jumbotron-->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php
                $query = "SELECT * FROM `slider` ORDER BY id DESC LIMIT 5";
                $run = mysqli_query($con, $query);
                if ($count = mysqli_num_rows($run)) {

                ?>
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php
                        for ($i = 0; $i < $count; $i++) {
                            if ($i == 0) {
                                echo "<li data-target='#carousel-example-generic' data-slide-to='" . $i . "' class='active'></li>";
                            } else {
                                echo "<li data-target='#carousel-example-generic' data-slide-to='" . $i . "'></li>";
                            }
                        }
                        ?>
                    </ol>
                    <!--Wrapper for slide-->
                    <div class="carousel-inner" role="listbox">
                        <?php
                        $check = 0;
                        while ($row = mysqli_fetch_array($run)) {
                        $id = $row ['id'];
                        $image = $row ['image'];
                        $title = $row ['title'];
                        $post_data = $row['discription'];
                        $check = $check + 1;
                        if ($check == 1) {
                            echo "<div class='item active'>";
                        } else {
                            echo "<div class='item'>";
                        }
                        ?>
                        <a class="img" href="post.php?post_id=<?php echo $id; ?>">
                            <img src="img/<?php echo $image; ?>" style="height: 400px !important; width: 100%">
                        </a>
                        <div class="carousel-caption">
                            <h2><?php echo $title; ?></h2>
                            <div class="desc">
                                <?php echo $post_data; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <!--Control-->
                <a class="left carousel-control" href="#carousel-example-generic" role="button"
                   data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button"
                   data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <?php
            }
            $query = "SELECT * FROM `posts` WHERE status = 'publish'";
            if (isset($post_id)) {
                $query .= "and id = '$post_id'";
            } else {
                $query .= " ORDER BY id DESC LIMIT 5";
            }
            $run = mysqli_query($con, $query);
            while ($row = mysqli_fetch_array($run)) {
                $id = $row['id'];
                $date = getdate($row['date']);
                $day = $date['mday'];
                $month = $date['month'];
                $year = $date['year'];
                $title = $row['title'];
                $image = $row['image'];
                $author_image = $row['author_image'];
                $tags = $row['tags'];
                $author = $row['author'];
                $categories = $row['categories'];
                $post_data = $row['post_data'];

                ?>
                <div class="post">
                    <div class="row">
                        <div class="col-md-2 post-date">
                            <div class="day"><?= $day; ?></div>
                            <div class="month"><?= $month; ?></div>
                            <div class="year"><?= $year; ?></div>
                        </div>
                        <div class="col-md-8 post-title">
                            <a href="post.php?post_id=<?= $id; ?>"><h2><?= $title; ?></h2></a>
                            <p>Written by:<span><?= ucfirst($author); ?></span></p>
                        </div>
                        <div class="col-md-2 profile-picture">
                            <img src="img/<?= $author_image; ?>" alt="profile picture" class="img-circle">
                        </div>
                    </div>
                    <a href="img/<?= $image; ?>"><img src="img/<?= $image; ?>" alt="post slider"></a>
                    <div class="desc">
                        <?= $post_data; ?>
                    </div>
                    <div class="bottom">
                        <span class="first"><i class="fa fa-folder"></i>
                            <a href="#"><?= ucfirst($categories); ?></a>
                        </span> |
                        <span class="sec"><i class="fa fa-comment"></i>
                                <a href="#">Comment</a>
                        </span>
                    </div>
                </div><!--close post area-->
                <?php
            }
            $c_query = "SELECT * FROM comments WHERE status = 'approve' ORDER BY id DESC";
            $c_run = mysqli_query($con, $c_query);
            if (mysqli_num_rows($c_run)) {
                $c_row = mysqli_fetch_array($c_run);
                ?>
                <div class="comment">
                    <h3>Comments</h3>
                    <?php
                    while ($c_row = mysqli_fetch_array($c_run)) {
                        $c_id = $c_row['id'];
                        $c_name = $c_row['name'];
                        $c_username = $c_row['username'];
                        $c_image = $c_row['image'];
                        $c_comment = $c_row['comment'];

                        ?>
                        <hr>
                        <div class="row single-comment">
                            <div class="col-sm-2">
                                <img src="img/<?= $author_image; ?>" alt="profile picture"
                                     class="img-circle">
                            </div>
                            <div class="col-sm-10 details">
                                <h4><?= ucfirst($c_name); ?></h4>
                                <p><?= $c_comment; ?></p>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            if (isset($_POST['submit'])) {
                $s_name = $row['name'];
                $s_email = $row['email'];
                $s_comment = $row['comment'];
                $s_image = $row['image'];
                $s_username = $row['username'];
                $s_date = time();
                if (empty($s_name) or empty($s_email) or empty($s_comment)) {
                    $error_msg = "(*) fields are required";
                } else {
                    $s_query = "INSERT INTO `comments`(`date`, `name`, `username`, `post_id`, `email`, `image`, `comment`, `status`)
                         VALUES ('$s_date', '$s_name', '$s_username', '$post_id', '$s_email', '$s_image', '$s_comment', 'pending')";
                    if (mysqli_query($con, $c_query)) {
                        $msg = "Comment Submitted and Waiting for Approval";
                        $s_name = "";
                        $s_email = "";
                        $s_comment = "";
                    } else {
                        $error_msg = "Comment Has Not Be Submitted";
                    }
                }
            }
            ?>
            <div class="comment-box">
                <div class="row">
                    <div class="col-xs-12">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="name">Name*:</label>
                                <input type="text" name="name" value="<?php if (isset($s_name)) {
                                    echo $s_name;
                                } ?>" id="name" class="form-control" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email*:</label>
                                <input type="text" id="emil" name="email"
                                       value="<?php if (isset($s_email)) {
                                           echo $s_email;
                                       } ?>" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="message">Message:</label>
                                <textarea id="message" name="comment" <?php if (isset($s_comment)) {
                                    echo $s_comment;
                                } ?> cols="30" rows="10" class="form-control"
                                          placeholder="Your Message"></textarea>
                            </div>
                            <input type="submit" name="submit" value="Submit Comment"
                                   class="btn btn-primary"><?php
                            if (isset($error_msg)) {
                                echo "<span style='color: red' class='pull-right'>$error_msg</span>";

                            } else if (isset($msg)) {
                                echo "<span style='color: green' class='pull-right'>$msg</span>";
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--close col 8-->
        <div class="col-md-4">
            <?php require_once 'inc/sidebar.php' ?>
        </div><!--close col 4-->
    </div>
    </div>
</section>
<?php require_once 'inc/footer.php' ?>
<script src="assets/jquery/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>