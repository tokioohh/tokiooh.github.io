<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "happyteethbd";


$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verificar si la contraseña coincide con la confirmación
if ($_POST['password'] != $_POST['confirmPass']) {
    print('La contraseña no coincide!');
    die();
} else {
    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $fechaNacimiento = $_POST['fechaNacimiento']; // Fecha en formato yyyy-mm-dd
    $sexo = $_POST['sexo'];
    $tipoSangre = $_POST['tipoSangre'];
    $peso = floatval($_POST['peso']); // Convertir a float
    $estatura = intval($_POST['estatura']); // Convertir a int
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $telCasa = intval($_POST['telefonoCasa']);
    $telCelular = intval($_POST['telefonoMovil']); 
    $enfermedades = $_POST['enfermedades'];
    $alergias = $_POST['alergias'];
    $cirugias = $_POST['cirugiasAccidentes'];

    // Formatear la fecha a SQL
    $fechaSQL = date('Y-m-d', strtotime($fechaNacimiento));

    // preparar procedimiento almacenado
    $query = "CALL sp_AgregarPaciente(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar STMT para mandar al sql
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die('Error en la preparación de la consulta: ' . $conn->error);
    }

    //Emparejar datos
    $stmt->bind_param(
        'ssssdisssiisss',
        $nombre,
        $fechaSQL,
        $sexo,
        $tipoSangre,
        $peso,
        $estatura,
        $direccion,
        $email,
        $pass,
        $telCasa,
        $telCelular,
        $enfermedades,
        $alergias,
        $cirugias
    );

    // Ejecutar la consulta
    if ($stmt->execute()) {
        print('Usuario añadido con éxito');
    } else {
        print('Error al añadir el usuario: ' . $stmt->error);
    }

    // Cerrar la declaración
    $stmt->close();
}

// Cerrar la conexión
$conn->close();
?>