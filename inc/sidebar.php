<div class="widgets">
    <form action="index.php" method="post">
        <div class="input-group">
            <input type="text" class="form-control" name="search-title" placeholder="Search for...">
            <span class="input-group-btn">
                <input type="submit" value="Go" class="btn btn-default" name="search">
            </span>
        </div>
    </form>
</div><!--close widgets-->
<div class="widgets">
    <div class="popular">
        <h3>Popular Posts</h3>
        <?php
        require_once 'env.php';
        require_once 'conn.php';
        $R_query = "SELECT * FROM posts WHERE status = 'publish' ORDER BY id DESC LIMIT 5";
        $R_run = mysqli_query($con, $R_query);
        if (mysqli_num_rows($R_run) > 0) {
            while ($R_row = mysqli_fetch_array($R_run)) {
                $R_id = $R_row['id'];
                $R_date = getdate($R_row['date']);
                $R_day = $R_date['mday'];
                $R_month = $R_date['month'];
                $R_year = $R_date['year'];
                $R_title = $R_row['title'];
                $R_image = $R_row['image'];
                ?>
                <hr>
                <div class="row">
                    <div class="col-xs-4">
                        <a href="post.php?post_id=<?php echo $R_id; ?>"><img src="img/<?php echo $R_image; ?>"
                                                                             alt="image 1"></a>
                    </div>
                    <div class="col-xs-8 details">
                        <a href="post.php?post_id=<?php echo $R_id; ?>"><h5><?php echo $R_title; ?></h5></a>
                        <p><i class="fa fa-clock-o"></i><?php echo "$R_day $R_month $R_year" ?></p>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<h3>No Post Available</h3>";
        }
        ?>
    </div>
</div><!--close widgets-->
<div class="widgets">
    <div class="popular">
        <h3>Recent Posts</h3>
        <?php
        $R_query = "SELECT * FROM posts WHERE status = 'publish' ORDER BY id DESC LIMIT 5";
        $R_run = mysqli_query($con, $R_query);
        if (mysqli_num_rows($R_run) > 0) {
            while ($R_row = mysqli_fetch_array($R_run)) {
                $R_id = $R_row['id'];
                $R_date = getdate($R_row['date']);
                $R_day = $R_date['mday'];
                $R_month = $R_date['month'];
                $R_year = $R_date['year'];
                $R_title = $R_row['title'];
                $R_image = $R_row['image'];
                ?>
                <hr>
                <div class="row">
                    <div class="col-xs-4">
                        <a href="post.php?post_id=<?php echo $R_id; ?>"><img src="img/<?php echo $R_image; ?>"
                                                                             alt="image 1"></a>
                    </div>
                    <div class="col-xs-8 details">
                        <a href="post.php?post_id=<?php echo $R_id; ?>"><h5><?php echo $R_title; ?></h5></a>
                        <p><i class="fa fa-clock-o"></i><?php echo "$R_day $R_month $R_year" ?></p>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<h3>No Post Available</h3>";
        }
        ?>
    </div>
</div><!--close widgets-->
<div class="widgets">
    <div class="popular">
        <h4>categories</h4>
        <hr>
        <div class="row">
            <div class="col-xs-6">
                <ul>
                    <?php
                    $c_query = "SELECT * FROM categories";
                    $c_run = mysqli_query($con, $c_query);
                    if (mysqli_num_rows($c_run) > 0) {
                        while ($c_row = mysqli_fetch_array($c_run)) {
                            $c_id = $c_row['id'];
                            echo "<li><a href='index.php?cat=" . $c_id . "'></a></li>";
                        }
                    } else {
                        echo "<p>No Category</p>";
                    }
                    ?>
                </ul>
            </div>
            <div class="col-xs-6">
                <ul>
                    <li><a href="">categories</a></li>
                </ul>
            </div>
        </div>
    </div>
</div><!--close widgets-->
<div class="widgets">
    <div class="categories">
        <h4>social icons</h4>
        <hr>
        <div class="row">
            <div class="col-xs-4">
                <a href="#"><img src="img/twit.png"></a>
            </div>
            <div class="col-xs-4">
                <a href="#"><img src="img/youtube.png"></a>
            </div>
            <div class="col-xs-4">
                <a href="#"><img src="img/facebook.png"></a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xs-4">
                <a href="#"><img src="img/skype.png"></a>
            </div>
            <div class="col-xs-4">
                <a href="#"><img src="img/google-img.png"></a>
            </div>
            <div class="col-xs-4"><a href="#"><img src="img/networks.png"></a></div>
        </div>
    </div>
</div><!--close widgets-->