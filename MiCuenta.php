<?php
include ('conexion.php');
$conn = connection();

include 'validar.php';

if (isset($_SESSION["IdPaciente"])) {
    // Si la sesión está activa y la variable existe
    header("Location: PerfilUsuario.php"); 
    
} else if (isset($_SESSION["IdMedico"])) {
    // Si la sesión está activa y la variable existe
    header("Location: REPORTES.php"); 
    
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
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
                    <a class="nav-link" href="index.php#Nosotros">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="MiCuenta.php">Mi Cuenta</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
    <body>
  

<div class="centrar-form">
<form action="" method="post" >
    <h1 class="form">Inicie Sesion</h1>
    
  <label for="fname">Correo Electronico:</label><br>
  <input type="text" id="CorreoElectronico" name="CorreoElectronico" value="" placeholder="Correo Electronico"required ><br>

  <label for="lname">Contraseña:</label><br>
  <input type="password" id="Contrasena" name="Contrasena" value="" placeholder="Contraseña" required><br><br>
<p class="form">¿No tienes cuenta?<a href="registroUsuario.html"> Registrate aquí</a></p>
  <input type="submit" value="Iniciar Sesion" name="botonlogin">
</form> 
</div>


<!-- Mostrar el mensaje de error solo si hay un error -->
<div id="error-message" class="error-message">
    <?php echo $errorMessage; ?>
</div>

<script>
    window.onload = function() {
        const errorMessage = "<?php echo addslashes($errorMessage); ?>";
        const errorMessageDiv = document.getElementById('error-message');
        
        // Si hay un mensaje de error, mostrarlo
        if (errorMessage) {
            errorMessageDiv.classList.add('show');

            // Ocultar el mensaje después de 5 segundos
            setTimeout(function() {
                errorMessageDiv.classList.remove('show');
            }, 5000); // 5000ms = 5 segundos
        }
    };
</script>

    </body>
</html>