<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">
                <div class="col-xs-3"><img class="img-rounded img-responsive" src="img/logo.jpg" alt="logo"
                                           width="50px">
                </div>
                <div class="col-xs-9">
                    Wpbeginner
                </div>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php"><i class="fa fa-home"> Home</i></a></li>
                <li><a href="Contact-us.php"><i class="fa fa-phone"> Contact</i></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><i class="fa fa-list-alt"> Categories</i><span class="caret"> </span></a>
                    <ul class="dropdown-menu">
                        <?php 
                            $query = "SELECT * FROM categories ORDER by id DESC";
                            $run = mysqli_query($con, $query);
                            if (mysqli_num_rows($run)> 0) {
                                while ($row= mysqli_fetch_array($run)){
                                    $categories = ucfirst($row ['categories']);
                                    $id = $row ['id'];
                                    echo "<li><a href='index.php?cat=".$id."'>$categories</a></li>";
                                }
                            }else{
                                echo "<li><a href='#'>No Category </a></li>";
                            }
                        ?>
                    </ul>
                </li>
                <li><a href="user_posts.php"><i class="fa fa-plus-square-o"> Add Post</i></a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav><!--close Navbar-->