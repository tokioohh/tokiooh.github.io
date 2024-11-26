<?php
// Asegúrate de que se reciba el ID de la cita
if (isset($_POST['idCita'])) {
    $idCita = $_POST['idCita'];
    
    // Conexión a la base de datos (asegúrate de tener tus credenciales)
    include('conexion.php');
    $conn = connection();
    // Consulta para actualizar el estado de la cita
    $sql = "UPDATE citas SET Estado = 'Completada' WHERE idCita = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idCita);

    if ($stmt->execute()) {
     header("Location:REPORTES.php");
    } else {
        echo "Error al actualizar el estado de la cita.";
    }
    exit;
}
?>
