<?php
session_start();

$errorMessage = "";  // Inicializamos la variable de error

if (!empty($_POST["botonlogin"])) {
    if (!empty($_POST["CorreoElectronico"]) && !empty($_POST["Contrasena"])) {
        $CorreoElectronico = $_POST['CorreoElectronico'];
        $Contrasena = $_POST['Contrasena'];

        // Validar si es un paciente
        $sqlPaciente = $conn->query("CALL sp_validarpacientes('{$CorreoElectronico}', '{$Contrasena}')");

        if ($datosPaciente = $sqlPaciente->fetch_object()) {
            // Guardar datos en la sesión
            $_SESSION["IdPaciente"] = $datosPaciente->IdPaciente;
            $_SESSION["CorreoElectronico"] = $datosPaciente->CorreoElectronico;
            $_SESSION["Contrasena"] = $datosPaciente->Contrasena;
            $sqlPaciente->close(); // Libera los resultados
            $conn->next_result(); // Asegura que la conexión esté lista para una nueva consulta
            header("Location: PerfilUsuario.php");
            exit;
        }
        $sqlPaciente->close();
        $conn->next_result(); // Libera resultados pendientes de la consulta del paciente

        // Validar si es un médico
        $sqlMedico = $conn->query("CALL sp_validarmedico('{$CorreoElectronico}', '{$Contrasena}')");

        if ($datosMedico = $sqlMedico->fetch_object()) {
            // Guardar datos en la sesión
            $_SESSION["IdMedico"] = $datosMedico->IdMedico;
            $_SESSION["Correo"] = $datosMedico->Correo;
            $_SESSION["Contrasena"] = $datosMedico->Contrasena;
            $sqlMedico->close(); // Libera los resultados
            $conn->next_result(); // Asegura que la conexión esté lista para una nueva consulta
            header("Location: REPORTES.php");
            exit;
        }
        $sqlMedico->close();
        $conn->next_result(); // Libera resultados pendientes de la consulta del médico

        // Si no es ni paciente ni médico
        $errorMessage = "Usuario incorrecto o credenciales no válidas.";
    } else {
        // Si los campos están vacíos
        $errorMessage = "Por favor, complete todos los campos.";
    }
}
?>
