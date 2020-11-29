<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'bdd_tiw';

    $connection = mysqli_connect($servername, $username, $password, $dbname);

    if (!$connection) {
        die("Connection failed : " . mysqli_connect_error());
    }

    mysqli_set_charset($connection, "utf8");

?>