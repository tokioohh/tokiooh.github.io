<?php
session_start();  
    include ('conexion.php');
    $conn = connection();

    
    if (isset($_SESSION["IdPaciente"])) {
        // Si la sesión está activa y la variable existe
        $idPaciente = $_SESSION["IdPaciente"];
    }
    
    

    $tratamiento = $_GET['tratamiento'];
    $puntos = $_GET['puntos'];

    $query = "select puntos from pacientes where IdPaciente = $idPaciente";
    $resultado = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($resultado);
    $points = $row['puntos'];
   
    $updateResult = false;

    if($points>=$puntos){
    $NuevosPuntos = $points - $puntos;
    $updateQuery = "UPDATE pacientes SET Puntos = $NuevosPuntos WHERE IdPaciente = $idPaciente"; // Cambiar 'id' si es necesario
    $updateResult = mysqli_query($conn, $updateQuery);
    }
    
    if ($updateResult) {

         
          $nombreTratamiento = $tratamiento;  
          $fecha = date('Y-m-d');       
          $costo = $puntos;        
  
          // Insertar los datos en la tabla 
          $insertQuery = "INSERT INTO Canjeables (IdPaciente, Nombre, Costo, Fecha) 
                          VALUES ($idPaciente,'$nombreTratamiento', $costo, '$fecha')";
          mysqli_query($conn, $insertQuery);

        header("Location: Canjeables.php?canje=success");  // Redirigir con éxito
    } else {
        header("Location: Canjeables.php?canje=error");  // Redirigir con error
    }
    exit;
?>
