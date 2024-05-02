<?php

require("../FPDF/fpdf.php");

session_start();
include("../models/baseDatos.php");

include("../controllers/controllerConsult.php");

function generatePdf($attendanceData, $attendanceData2)
{
    // Creación del PDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Configuración de la fuente y el tamaño de la letra
    $pdf->SetFont("Arial", 'B', 16);

    $pdf->Cell(40, 10, "Reporte de asistencia");

    // Separación de la línea
    $pdf->Ln(20);

    $pdf->Cell(40, 10, "Resultado de las asistencia");

    $pdf->Ln(10);


    // Mostrar los resultados de la consulta de asistencia
    foreach ($attendanceData as $row) {
        $pdf->Cell(40, 10, 'Total de asistencia puntuales: ' . $row['punctual']);
        $pdf->Ln();
        $pdf->Cell(40, 10, 'Total de tardanzas: ' . $row['delay_attendance']);
        $pdf->Ln();
        $pdf->Cell(40, 10, 'Total de Faltas: ' . $row['absent_attendance']);
        $pdf->Ln();
    }

    // asistencias totales
    $attendanceTotal = $row['punctual'] + $row['delay_attendance'];

    $pdf->Cell(40, 10, "Asistencia Total: $attendanceTotal");
    $pdf->Ln(20);

    $pdf->Cell(40, 10, "Registros Mensuales");
    $pdf->Ln(20);

    foreach($attendanceData2 as $row2){
        $pdf->Cell(40, 10, "Total de asistencia Mensuales: " . $row2['punctual_month']);
        $pdf->Ln();
        $pdf->Cell(40, 10, "Total de Tardanzas Mensual: " . $row2['delay_month']);
        $pdf->Ln();
        $pdf->Cell(40, 10, "Total de Faltas Mensuales: " . $row2['absent_month']);
        $pdf->Ln();
    }

    // Salida del PDF
    $pdf->Output("reportes_de_asistencia.pdf", "D");
}

$userIdPDF = $_SESSION['user_id'];

// Obtener datos de asistencia

$resultConsult = dataAttendancePDF($userIdPDF, $connection);
$resultCountMonth = dataMonthlyAttendance($userIdPDF, $connection);
// Limpiar cualquier salida previa
ob_clean();

// Generar el PDF con los datos de asistencia
generatePdf($resultConsult, $resultCountMonth);
?>
