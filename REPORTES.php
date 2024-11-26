<?php
include ('conexion.php');
$conn = connection();
include ('validar.php');
    


// Función para obtener los detalles del médico
function sp_ObtenerPerfilMedico($medicoID, $conn) {
    $stmt = $conn->prepare("SELECT Nombre, Cedula, Especialidad FROM medicos WHERE IdMedico = ?");
    $stmt->bind_param("i", $medicoID);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}


// Funciones para llamar a los procedimientos
function obtenerCitasHoy($medicoID, $conn) {
    $stmt = $conn->prepare("CALL ConsultarCitasHoy(?)");
    $stmt->bind_param("i", $medicoID);
    $stmt->execute();
    $result = $stmt->get_result();
     
    $citas = [];
    while ($row = $result->fetch_assoc()) {
        $citas[] = $row;  // Agrega cada cita al arreglo
    }
    
    return $citas;  // Devuelve todas las citas obtenidas
}


function reportarEnfermedadesSimilares($enfermedad, $conn) {
    $stmt = $conn->prepare("CALL sp_ReportarEnfermedadesSimilares(?)");
    $stmt->bind_param("s", $enfermedad);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function reportarPorGeneroONombre($nombre, $genero, $conn) {
    $stmt = $conn->prepare("CALL sp_ReportarPorGeneroONombre(?, ?)");
    $stmt->bind_param("ss", $nombre, $genero);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function obtenerTopCancelaciones($conn) {
    $stmt = $conn->prepare("CALL sp_TopPacientesCancelaciones()");
    $stmt->execute();
    $result = $stmt->get_result();
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

// Asignar ID del médico (cambiar según necesidad)
$medicoID = isset($_SESSION['IdMedico']) ? $_SESSION['IdMedico'] : 3;
$perfilMedico = sp_ObtenerPerfilMedico($medicoID, $conn);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Perfil Médico y Reportes Generales</title>
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
    </header><br><br>
<div class="container">
    <section class="perfil-medico">
        <h3>Perfil del Médico</h3>
        <?php if ($perfilMedico): ?>
            <img src="https://files.catbox.moe/295s1j.jpg" alt="Pachiko" height="240" width="240">
            
            <div class="ACOMODO">
            <p><strong>Nombre:</strong> <?= htmlspecialchars($perfilMedico['Nombre']); ?></p>
            <p><strong>Cédula:</strong> <?= htmlspecialchars($perfilMedico['Cedula']); ?></p>
            <p><strong>Especialidad:</strong> <?= htmlspecialchars($perfilMedico['Especialidad']); ?></p>  
        </div>
        
        <div>
    <a href="CerrarSesion.php"><button class = "LogoutMedico">Cerrar Sesion</button></a>
                </div>
        
        <div class="Reportes">
        <a href="REPORTESGENERO.php"><button class="reportesgenero">Reportes por Genero y Nombre</button></a> <br>
        <a href="REPORTESGENERALES.php"><button class="reportesgenerales">Reportes Generales</button></a> <br>
        <a href="REPORTESTOP.php"><button class="reportestop">Reportes por Cancelaciones</button></a>
        </div>


                <?php else: ?>
            <p>No se encontraron datos del médico.</p>
        <?php endif; ?>
    </section><br>
</div>
<div class="container">
    <section id="perfil-medico">
        <div id="citas-hoy">
            <h3 class="citas">
            Citas </h3><br>
            <table class="tabla-reporte">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Nombre del paciente</th>
                        <th>Numero telefonico del paciente</th>
                        <th>Estado</th>
                        <th>Canjeables</th>
                        <th>Acción</th>
                    </tr>
                </thead>



                <tbody>
    <?php
    $citasHoy = obtenerCitasHoy($medicoID, $conn);  // Función que ejecuta la consulta modificada
    if (!empty($citasHoy)): 
        foreach ($citasHoy as $cita): ?>
            <tr>
                <td><?= htmlspecialchars($cita['Fecha']); ?></td>
                <td><?= htmlspecialchars($cita['Hora']); ?></td>
                <td><?= htmlspecialchars($cita['NombrePaciente']); ?></td>
                <td><?= htmlspecialchars($cita['TelefonoPaciente']); ?></td>
                <td><?= htmlspecialchars($cita['Estado']); ?></td>
                <td><?= htmlspecialchars($cita['NombreCanjeable']); ?></td> <!-- Mostrar el nombre del canjeable -->
                <td>
                    <!-- Formulario con el botón de acción para cambiar el estado -->
                    <form class="CitasBotonEstado" action="cambiar_estado.php" method="POST">
                        <input type="hidden" name="idCita" value="<?= $cita['IdCita']; ?>">
                        <button type="submit" class="btnCompletada">
                            <i class="CitasBotonEstado"></i> Marcar como completada
                        </button>
                    </form>
                </td>
               
            </tr>
        <?php endforeach; 
    else: ?>
        <tr>
            <td colspan="7">No hay citas para hoy.</td> <!-- Cambié el colspan a 7 por la nueva columna -->
        </tr>
    <?php endif; ?>
</tbody>

            </table><br>
        </div>
    </section>
</div>

</body>
</html>

<?php $conn->close(); ?>