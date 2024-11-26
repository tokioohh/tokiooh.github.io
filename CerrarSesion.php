<?php
include ('conexion.php');
$conn = connection();
include ('validar.php');


session_destroy();
header("Location:index.php"); 
exit();

?>