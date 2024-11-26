<?php
    include ('conexion.php');
    $conn = connection();
    include ('validar.php');
    if (isset($_SESSION["IdPaciente"])) {
        // Si la sesión está activa y la variable existe
        $idPaciente = $_SESSION["IdPaciente"];
    }
    
    

    // Realizamos la consulta para obtener los puntos del paciente
    $query = "SELECT Nombre, Puntos FROM pacientes WHERE IdPaciente = $idPaciente";  // Asegúrate de filtrar por el paciente adecuado
    $result = mysqli_query($conn, $query);

    // Obtener el valor de los puntos
    if ($result) {
        // Asumimos que solo hay un paciente o solo quieres obtener los puntos de uno
        $row = mysqli_fetch_assoc($result); 
        $points = $row['Puntos'];
        $nombre = $row['Nombre'];  // Extraemos el valor de la columna 'Nombre'
    } else {
        $points = 0; // En caso de que no haya resultados o haya algún error
    }

    // Verificar si el canje fue exitoso o fallido
    $canje = isset($_GET['canje']) ? $_GET['canje'] : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canjeables</title>
    <link rel="stylesheet" href="style.css">
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mostrar la ventana emergente si el canje fue exitoso o fallido
        window.onload = function() {
            const canje = "<?php echo isset($_GET['canje']) ? $_GET['canje'] : ''; ?>";
            const toast = document.getElementById('toast');
            
            // Si el parámetro canje es "success" o "error"
            if (canje === 'success') {
                toast.textContent = "¡Canje realizado con éxito!";
                toast.style.backgroundColor = "#28a745"; // Verde para éxito
            } else if (canje === 'error') {
                toast.textContent = "No tienes suficientes puntos o hubo un error al realizar el canje.";
                toast.style.backgroundColor = "#dc3545"; // Rojo para error
            }

            // Si el toast tiene contenido, mostrarlo
            if (toast.textContent) {
                toast.classList.add('show');

                // Ocultar el toast después de 3 segundos
                setTimeout(() => {
                    toast.classList.remove('show');
                }, 3000);  // Tiempo en milisegundos (3000ms = 3 segundos)
            }
        };
    </script>
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
        <div class ="puntosbg">    
        </div>


    <div class="contenedorPuntos">
        <div class="seccion-puntos">
            <h1>Hola <?php echo $nombre?>, tienes <?php echo $points; ?> puntos disponibles</h1>
        </div>

        <h2>Tratamientos disponibles para canjear</h2>
        <div class="tratamientos">
            <div class="tratamiento">
                <h3>Limpieza Dental</h3>
                <p>150 puntos</p>
                <a href="canjear.php?tratamiento=limpieza&puntos=150">
                    <button class="canje-button">Canjear</button>
                </a>
            </div>

            <div class="tratamiento">
                <h3>Blanqueamiento Dental</h3>
                <p>200 puntos</p>
                <a href="canjear.php?tratamiento=Blanqueamiento&puntos=200">
                    <button class="canje-button">Canjear</button>
                </a>
            </div>

            <div class="tratamiento">
                <h3>Revisión Completa</h3>
                <p>100 puntos</p>
                <a href="canjear.php?tratamiento=Revision&puntos=100">
                    <button class="canje-button">Canjear</button>
                </a>
            </div>

            <div class="tratamiento">
                <h3>Implante Dental</h3>
                <p>500 puntos</p>
                <a href="canjear.php?tratamiento=Implante&puntos=500">
                    <button class="canje-button">Canjear</button>
                </a>
            </div>

        </div>
    </div>


    <div class="contenedorCanjesHechos">
        <div class="seccion-puntos">
            <h2>Historial de Canjeables</h2>
            <p>Estos son los canjes que has realizado:</p>
            <table class="tablaCanjeables">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Costo (Puntos)</th>
                        <th>Fecha de Canje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
        $MostrarCanjes = "Select * from Canjeables ORDER BY Fecha DESC"; 
        $resultadoCanjes =  mysqli_query($conn, $MostrarCanjes);

                    // Mostrar los datos de la tabla Canjeables
                    if (mysqli_num_rows($resultadoCanjes) > 0) {
                        while ($row = mysqli_fetch_assoc($resultadoCanjes)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['Nombre']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Costo']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Fecha']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No hay registros de canjes.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
        




    <!-- Toast (notificación emergente) -->
    <div id="toast" class="toast"></div>

</body>
</html>
