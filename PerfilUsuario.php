<?php

include ('conexion.php');
$conn = connection();
include ('validar.php');

if (!isset($_SESSION["IdPaciente"])) {
    // Si la sesión está activa y la variable existe
    header("Location: MiCuenta.php"); 
    
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

<div class="Foto text-left">
    <img src="https://files.catbox.moe/8bi6f0.jpg" alt="FotoPerfil" class="img-fluid perfil-img"> 
</div>
  
<div>
    <a href="CerrarSesion.php"><button class = "Logout">Cerrar Sesion</button></a>
</div>


<div class="tabla">
<h1 class="form">Mis Datos</h1>
<?php
if (isset($_SESSION["IdPaciente"])) {
    $IdPaciente = $_SESSION["IdPaciente"];
    $sql = "SELECT * FROM pacientes WHERE IdPaciente = $IdPaciente";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Mostrar los datos en HTML
        while($row = $result->fetch_assoc()) {
            echo "<div style='display: flex; flex-wrap: wrap;'>";
            // Columna 1
            echo "<div style='width: 50%; padding-right: -5px;'>";
            echo "<p><strong>Nombre:</strong> " . $row["Nombre"] . "</p>";
            echo "<p><strong>Fecha de Nacimiento:</strong> " . $row["FechaDeNacimiento"] . "</p>";
            echo "<p><strong>Sexo:</strong> " . ($row["Sexo"] == 'M' ? 'Masculino' : 'Femenino') . "</p>";
            echo "<p><strong>Tipo de Sangre:</strong> " . $row["TipoDeSangre"] . "</p>";
            echo "<p><strong>Peso:</strong> " . $row["Peso"] . " kg</p>";
            echo "<p><strong>Estatura:</strong> " . $row["Estatura"] . " cm</p>";
            echo "<p><strong>Dirección:</strong> " . $row["Direccion"] . "</p>";
            echo "</div>";
            
            // Columna 2
            echo "<div style='width: 50%; padding-left: -5px;'>";
            echo "<p><strong>Correo Electrónico:</strong> " . $row["CorreoElectronico"] . "</p>";
            echo "<p><strong>Teléfono de Casa:</strong> " . $row["TelefonoCasa"] . "</p>";
            echo "<p><strong>Teléfono Celular:</strong> " . $row["TelefonoCelular"] . "</p>";
            echo "<p><strong>Enfermedades:</strong> " . $row["Enfermedades"] . "</p>";
            echo "<p><strong>Alergias:</strong> " . $row["Alergias"] . "</p>";
            echo "<p><strong>Cirugías:</strong> " . $row["Cirugias"] . "</p>";
                        echo "</div>";
            
            echo "</div>";
        }
    } else {
        echo "<tr><td colspan='14'>No se encontraron datos para este paciente.</td></tr>";
    }
} else {
    echo "<tr><td colspan='14'>Por favor, inicie sesión para ver su perfil.</td></tr>";
}
?>

<button onclick="location.href='modificarPacientes.php'" class="BotonModificar">Modificar</button>
</div>

<div class="tabla2">
<h1 class="form">Mis Citas</h1>
<table class="user-table">
 <thead>
   <tr>
     <th>Fecha</th>
     <th>Hora</th>
     <th>Medico</th>
     <th>PDF</th>
     <th></th>
   </tr>
 </thead>
 <tbody> 
 <?php

        // Verifica que el paciente haya iniciado sesión
        if (isset($_SESSION['IdPaciente'])) {
            $PacienteID = $_SESSION['IdPaciente'];

            $sql = "SELECT 
            c.IdCita,
            c.Fecha,
            c.Hora,
            c.Estado,
            m.Nombre AS NombreMedico
        FROM 
            citas c
        INNER JOIN 
            medicos m ON c.MedicoID = m.IdMedico
        WHERE 
            c.PacienteID = ? 
            AND c.Estado = 'Pendiente'";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $PacienteID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Itera sobre los resultados y genera las filas de la tabla
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['Fecha']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Hora']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['NombreMedico']) . "</td>";
                    echo "<td><a href='crearpdf.php?cita_id=" . urlencode($row['IdCita']) . "' target='_blank'>PDF</a></td>";
                    echo "<td>";
                    echo "<button class='Logout' onclick='cancelarcita(" . htmlspecialchars($row['IdCita']) . ")'>Cancelar</button>";
                    echo "</td>";
                   echo "</tr>";

                }
            } else {
                echo "<tr><td colspan='5'>No tienes citas agendadas.</td></tr>";
            }

            $stmt->close();
        } else {
            echo "<tr><td colspan='5'>Por favor, inicia sesión para ver tus citas.</td></tr>";
        }

        $conn->close();
        ?>  
        <button class="BotonCita">Crear Cita</button>
    
            </tbody>
        </table>
        
    </div>
 <div class = "CanjeablesDato">
    <h3 class= "headercanjeables">Sabias que puedes obtener premios por asistir a tus citas?</h3>
    <a href="Canjeables.php">
    <button class="CanjeablesDatoBtn">Llevame ahí</button> 
    </a>
    </div>
    <div id="crearcita" class="crearcita">
    <!-- Datos para llenar para la cita -->
    <div class="cuestionariocita">
        <span class="close">&times;</span>
        <form action="agendarcita.php" method="POST">
            <label for="doctor">ELIJA A SU DOCTOR:</label><br>
            <select id="doctor" name="IdMedico" required>
                <option value="" disabled selected>Seleccione un doctor</option>
                <!-- Las opciones serán generadas dinámicamente con JavaScript -->
            </select><br>

            <label for="calendario">ELIJA EL DÍA:</label><br>
            <input type="date" id="calendario" name="Fecha" required><br>

            <label for="hora">ELIJA SU HORA:</label><br>
            <input type="time" id="hora" name="Hora" min="10:00" max="19:00"required><br>

            <div class="ParaCentrar">
                <button type="submit" class="botonCita">AGENDAR</button>
            </div>
        </form>
    </div>
</div>

<script>

// Get the modal
var crearcita = document.getElementById("crearcita");

// Get the button that opens the modal
var botonCita = document.querySelector(".BotonCita");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// Cuando le den al boton, se abra la ventana
botonCita.onclick = function() {
  crearcita.style.display = "block";
}

// cuando se de click en la X se cierre
span.onclick = function() {
  crearcita.style.display = "none";
}

// Funcion que hace que al clickear afuera del formulario este se cierre we
window.onclick = function(event) {
  if (event.target == crearcita) {
    crearcita.style.display = "none";
  }
}

// Función para que salgan los medicos al hacer la  cita
function obtenerMedicos() {
    fetch('agarrardoctores.php') 
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al obtener los datos de los médicos');
            }
            return response.json();
        })
        .then(data => {
            const selectDoctor = document.getElementById('doctor');
            selectDoctor.innerHTML = '<option value="" disabled selected>Seleccione un doctor</option>'; 
            data.forEach(medico => {
                const option = document.createElement('option');
                option.value = medico.IdMedico; 
                option.textContent = medico.Nombre; 
                selectDoctor.appendChild(option);
            });
        })
        .catch(error => console.error('Error:', error));
}

// Llamar a la función para cargar los médicos al cargar la página
document.addEventListener('DOMContentLoaded', obtenerMedicos);
</script>


<script>
function cancelarcita(IdCita) {
    if (confirm("¿Estás seguro de que deseas cancelar esta cita?")) {
        // Enviar solicitud de cancelación
        fetch('cancelarcita.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `IdCita=${IdCita}`
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Mostrar el mensaje
            location.reload(); // Recargar la página para actualizar la lista de citas
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocurrió un error al cancelar la cita.');
        });
    }
}
</script>

</body>

