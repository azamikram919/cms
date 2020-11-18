<?php
require_once 'env.php';//env file is attached to the conn file
//connection database (host 'localhost' user 'root' db_name 'user' with no password)
$con = mysqli_connect(
    DB_HOST,
    DB_USER,
    DB_PASSWORD,
    DB_NAME);
?>