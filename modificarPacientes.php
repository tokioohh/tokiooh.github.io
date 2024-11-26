<?php
session_start();


include ('conexion.php');
$conn = connection();


if (!isset($_SESSION["IdPaciente"])) {
    header("Location: login.php");
    exit;
}

$IdPaciente = $_SESSION["IdPaciente"];

// Consulta para obtener los datos del paciente
$sql = "SELECT * FROM pacientes WHERE IdPaciente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $IdPaciente);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $paciente = $result->fetch_assoc();
} else {
    echo "Error: No se encontraron datos para este paciente.";
    exit;
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modificar Datos</title>
        <link rel="icon" type="image/x-icon" href="/img/favicon.svg">
        <link rel="stylesheet" href="style.css">
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous">
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </head>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

            <img src="img/happy_teeth_transparent.png" alt="logotipo" width="120" height="120">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://g.co/kgs/TnHuV9C">Ubicación</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#Nosotros">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="MiCuenta.php">Mi Cuenta</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<body class="registro">




    <div class="centrar-form">
        <form action="AltaUsuario1.php" method="post">
            <h1 class="form">Datos Personales</h1>
            <label for="nombre">Nombre completo:</label>
        <input type="text" id="nombre" name="nombre" class="text-center" required>

        <label for="fechaNacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fechaNacimiento" name="fechaNacimiento" class="text-center" required>

        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo" class="text-center" required>
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
           
        </select>

        <label for="tipoSangre">Tipo de Sangre:</label>
        <select id="tipoSangre" name="tipoSangre" class="text-center" required>
            <option value="A-">A-</option>
            <option value="A+">A+</option>
            <option value="B-">B-</option>
            <option value="B+">B+</option>
            <option value="AB-">AB-</option>
            <option value="AB+">AB+</option>
            <option value="O-">O-</option>
            <option value="O+">O+</option>
            
           
        </select>

        <label for="peso">Peso (kg):</label>
        <input type="number" id="peso" name="peso" class="text-center" required>

        <label for="estatura">Estatura (cm):</label>
        <input type="number" id="estatura" name="estatura" class="text-center" required>

        <h1 class="form">Datos De Contacto</h1>

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" class="text-center" required>
        <label for="telefonoCasa">Teléfono de casa:</label>
        <input type="number" id="telefonoCasa" name="telefonoCasa" class="text-center">

        <label for="telefonoMovil">Teléfono móvil:</label>
        <input type="number" id="telefonoMovil" name="telefonoMovil" class="text-center" required>


        <h1 class="form">Otros</h1>
        <label for="enfermedades">Enfermedades:</label>
        <textarea id="enfermedades" name="enfermedades" class="text-center"></textarea>

        <label for="alergias">Alergias:</label>
        <textarea id="alergias" name="alergias" class="text-center"></textarea>

        <label for="cirugiasAccidentes">Cirugías y/o Accidentes:</label>
        <textarea id="cirugiasAccidentes" name="cirugiasAccidentes" class="text-center"></textarea>
        

            <input class="ola" type="submit" value="Registrar">
        </form>


    </div>
    </body>



</html>