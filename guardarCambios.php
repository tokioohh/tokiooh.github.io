<?php
session_start();
include ('conexion.php');
$conn = connection();

if (!isset($_SESSION["IdPaciente"])) {
    header("Location: login.php");
    exit;
}

$IdPaciente = $_SESSION["IdPaciente"];

// Verifica que los datos hayan sido enviados desde el formulario
if (isset($_POST['submit'])) {
    // Recupera los datos del formulario
    $Nombre = $_POST['Nombre'];
    $FechaDeNacimiento = $_POST['FechaDeNacimiento'];
    $Sexo = $_POST['Sexo'];
    $TipoDeSangre = $_POST['TipoDeSangre'];
    $Peso = $_POST['Peso'];
    $Estatura = $_POST['Estatura'];
    $Direccion = $_POST['Direccion'];
    $CorreoElectronico = $_POST['CorreoElectronico'];
    $TelefonoCasa = $_POST['TelefonoCasa'];
    $TelefonoCelular = $_POST['TelefonoCelular'];
    $Enfermedades = $_POST['Enfermedades'];
    $Alergias = $_POST['Alergias'];
    $Cirugias = $_POST['Cirugias'];

    // Prepara la llamada al procedimiento almacenado
    $sql = "CALL sp_updatepacientes(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param(
        "issssdisssssss",  // Tipos: i = integer, s = string, d = float
        $IdPaciente,      // Agregamos el IdPaciente como primer parámetro
        $Nombre,
        $FechaDeNacimiento,
        $Sexo,
        $TipoDeSangre,
        $Peso,
        $Estatura,
        $Direccion,
        $CorreoElectronico,
        $TelefonoCasa,
        $TelefonoCelular,
        $Enfermedades,
        $Alergias,
        $Cirugias
    );
    

    // Ejecuta la consulta
    if ($stmt->execute()) {
        echo "Datos actualizados correctamente.";
        header("Location: PerfilUsuario.php");
    } else {
        echo "Error al actualizar los datos: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
