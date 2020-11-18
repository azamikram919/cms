<?php
require_once 'inc/env.php';
require_once 'inc/conn.php';
if (maintenance == 'development') {
    //redirect to specific page
    header('Location: maintenance.php');
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
            <h1>Contact<span> Us</span></h1>
            <p>Feel free to contact </p>
        </div>
    </div>
    <img src="img/nav.jpg">
</div><!--Jumbotron-->

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDXTlFelAbEV9cBqW8PTgLI79Hs63G7MPU'></script>
                        <div style='overflow:hidden;height:400px;width:100%px;'>
                            <div id='gmap_canvas' style='height:400px;width:100%px;'></div>
                            <style>#gmap_canvas img {
                                    max-width: none !important;
                                    background: none !important
                                }</style>
                        </div>
                        <a href='https://www.free-counters.org/'>free Hit Counter</a>
                        <script type='text/javascript'
                                src='https://embedmaps.com/google-maps-authorization/script.js?id=b43c56ee3f001ee3aab546be5fe0104238b9322d'></script>
                        <script type='text/javascript'>function init_map() {
                                var myOptions = {
                                    zoom: 12,
                                    center: new google.maps.LatLng(30, 70),
                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                };
                                map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
                                marker = new google.maps.Marker({map: map, position: new google.maps.LatLng(30, 70)});
                                infowindow = new google.maps.InfoWindow({content: '<strong>habib colony burewala</strong><br>street no5 habib colony<br>61010 burewala<br>'});
                                google.maps.event.addListener(marker, 'click', function () {
                                    infowindow.open(map, marker);
                                });
                                infowindow.open(map, marker);
                            }
                            google.maps.event.addDomListener(window, 'load', init_map);</script>
                    </div>
                    <div class="col-md-12 contact-from">
                        <h2>Contact Form</h2>
                        <hr>
                        <form action="">
                            <div class="form-group">
                                <label for="name">Name*:</label>
                                <input type="text" id="name" class="form-control" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email*:</label>
                                <input type="text" id="emil" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="message">Message:</label>
                                <textarea id="message" cols="30" rows="10" class="form-control"
                                          placeholder="Your Message"></textarea>
                            </div>
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div><!--close col 8-->
            <div class="col-md-4">
               <?php require_once 'inc/sidebar.php' ?>

            </div><!--close col 4-->
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <?= require_once 'inc/footer.php';?>
    </div>
</footer>
<script src="assets/jquery/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
