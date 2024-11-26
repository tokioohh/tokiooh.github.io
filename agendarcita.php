<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once('conexion.php');
    $conn = connection();

    // Datos enviados desde el formulario
    $IdMedico = $_POST['IdMedico'];
    $Fecha = $_POST['Fecha'];
    $Hora = $_POST['Hora'];

    // Suponiendo que tienes el ID del paciente en la sesión
    session_start();
    if (isset($_SESSION['IdPaciente'])) {
        $PacienteID = $_SESSION['IdPaciente'];

        // Llamada al procedimiento almacenado
        $stmt = $conn->prepare("CALL sp_nuevacita(?, ?, ?, ?)");
        $stmt->bind_param("siss", $IdMedico, $PacienteID, $Fecha, $Hora);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Cita agendada correctamente.');
                    window.location.href = 'PerfilUsuario.php'; // regresa a la pagina del perfil
                  </script>";
        } else {
            echo "<script>
                    alert('Error al agendar la cita.');
                    window.history.back(); // Regresa a la página anterior
                  </script>";
        }

        $stmt->close();
    } else {
        echo "<script>
                alert('No has iniciado sesión.');
                window.location.href = 'login.php'; // Redirige a la página de inicio de sesión
              </script>";
    }

    $conn->close();
}
?>