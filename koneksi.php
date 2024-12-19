<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "db_tamu";

    $koneksi = mysqli_connect($server, $user, $password, $database) or die("Connection failed: ". mysqli_connect_error());
    ($koneksi); 
?>