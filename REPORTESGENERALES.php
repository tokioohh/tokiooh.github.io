<?php
include ('conexion.php');
$conn = connection();
include ('validar.php');

function reportarEnfermedadesSimilares($enfermedad, $conn) {
    $stmt = $conn->prepare("CALL sp_ReportarEnfermedadesSimilares(?)");
    $stmt->bind_param("s", $enfermedad);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mi Perfil</title>
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
<section id="reportes-generales">
        <div id="reporte-01">
            <h3 class="headergenerales">Reporte 01: Pacientes con similitudes en las enfermedades</h3>
            <form action="" method="POST" class="reportesgenerales">
                <label for="enfermedad">Ingrese enfermedad:</label>
                <input type="text" id="enfermedad" name="enfermedad" required>
                <button type="submit" name="reporte_01">Generar Reporte</button>
            </form>
            <div id="resultados-reporte-01">
                <table class="tabla-reporte">
                    <thead>
                        <tr>
                            <th>Nombre del Paciente</th>
                            <th>Enfermedad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_POST['reporte_01'])) {
                            $enfermedad = $_POST['enfermedad'];
                            $resultados = reportarEnfermedadesSimilares($enfermedad, $conn);
                            foreach ($resultados as $resultado) {
                                echo "<tr>
                                        <td>{$resultado['Nombre']}</td>
                                        <td>{$resultado['Enfermedades']}</td>
                                      </tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table><br>
            </div>
        </div>
</div>
</body>
</html>

<?php $conn->close(); ?>
