<?php
require('fpdf186/fpdf.php'); // Incluye la librería FPDF
include('conexion.php');

if (isset($_GET['cita_id'])) {
    $IdCita = $_GET['cita_id'];

    // Conexión a la base de datos
    $conn = connection();

    // Consulta para obtener los datos de la cita
    $sql = "SELECT 
                c.Fecha,
                c.Hora,
                m.Nombre AS NombreMedico,
                p.Nombre AS NombrePaciente
            FROM 
                citas c
            INNER JOIN 
                medicos m ON c.MedicoID = m.IdMedico
            INNER JOIN 
                pacientes p ON c.PacienteID = p.IdPaciente
            WHERE 
                c.IdCita = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $IdCita);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();

        // Crear el PDF con FPDF
        $pdf = new FPDF();
        $pdf->AddPage();

        // Encabezado con logo
        $pdf->Image('img/happy_teeth_transparent.png', 10, -5, 50); // Imagen en la esquina superior izquierda
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetTextColor(33, 37, 41); // Texto gris oscuro
        $pdf->Cell(0, 10, 'Clinica Happy Teeth', 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'I', 12);
        $pdf->SetTextColor(100, 100, 100); // Texto gris claro
        $pdf->Cell(0, 10, 'Detalles de la cita', 0, 1, 'C');
        $pdf->Ln(10);

        // Diseño de la tabla
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(44, 62, 80); // Color de encabezado (azul oscuro)
        $pdf->SetTextColor(255, 255, 255); // Texto blanco
        $pdf->Cell(50, 10, 'Fecha', 1, 0, 'C', true);
        $pdf->Cell(50, 10, 'Hora', 1, 0, 'C', true);
        $pdf->Cell(50, 10, 'Medico', 1, 0, 'C', true);
        $pdf->Cell(40, 10, 'Paciente', 1, 1, 'C', true);

        // Relleno de datos
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetTextColor(33, 37, 41); // Texto gris oscuro
        $pdf->SetFillColor(240, 240, 240); // Fondo gris claro
        $pdf->Cell(50, 10, $data['Fecha'], 1, 0, 'C', true);
        $pdf->Cell(50, 10, $data['Hora'], 1, 0, 'C', true);
        $pdf->Cell(50, 10, $data['NombreMedico'], 1, 0, 'C', true);
        $pdf->Cell(40, 10, $data['NombrePaciente'], 1, 1, 'C', true);

        $pdf->Ln(15);

        // Pie de página
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->SetTextColor(150, 150, 150); // Texto gris medio
        $pdf->Cell(0, 10, 'Clinica Happy Teeth', 0, 0, 'C');

        // Mostrar el PDF en el navegador
        $pdf->Output();
    } else {
        echo "No se encontró la cita con el ID proporcionado.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No se dio un ID de cita.";
}
?>