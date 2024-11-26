<?php
function connection(){
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "happyteethbd";

    $conn = mysqli_connect($host, $username,$password) ;

    mysqli_select_db($conn, $dbname);

    return $conn;

}



?>