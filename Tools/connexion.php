<?php 
    $host = "localhost";
    $user = "root";
    $passwd = "";
    $bd = "banco_perla";
    $con = mysqli_connect($host,$user,$passwd,$bd);
    $conex = new mysqli($host,$user,$passwd,$bd);
    $conex -> set_charset("utf8");
    if(!$con){
        die("!MISTAKE! - The connection has not been established");
    }
    return $con;