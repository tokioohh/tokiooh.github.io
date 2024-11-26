<?php
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['IdCita'])) {
        $IdCita = $_POST['IdCita'];

        // Conexión a la base de datos
        $conn = connection();

        // Llamada al procedimiento almacenado
        $stmt = $conn->prepare("CALL sp_cancelarcita(?, 'Cancelada')");
        $stmt->bind_param("i", $IdCita);

        if ($stmt->execute()) {
          if ($stmt->execute()) {
            echo "La cita ha sido cancelada correctamente.";
        } else {
            echo "Error al cancelar la cita.";
        }

        $stmt->close();
        $conn->close();
}
   }
  }
?>