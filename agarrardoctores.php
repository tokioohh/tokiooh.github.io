<?php
include_once('conexion.php');
$conn = connection();

// Consulta para obtener los medicos
$sql = "SELECT IdMedico, Nombre FROM medicos"; 
$result = $conn->query($sql);

// Verifica si hay resultados
if ($result->num_rows > 0) {
    $medicos = [];
    while ($row = $result->fetch_assoc()) {
        $medicos[] = $row;
    }
    // Devuelve los datos en formato JSON
    echo json_encode($medicos);
} else {
    echo json_encode([]); // Devuelve un array vacío si no hay resultados
}

$conn->close();
?>
