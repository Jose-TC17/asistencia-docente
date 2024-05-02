<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function generateEXEL(){
    // Crear un nuevo objeto Spreadsheet
    $spreadsheet = new Spreadsheet();

    // Establecer propiedades del documento
    $spreadsheet->getProperties()
        ->setCreator('Tu Nombre')
        ->setLastModifiedBy('Tu Nombre')
        ->setTitle('Ejemplo de hoja de cálculo')
        ->setSubject('Sujeto de ejemplo')
        ->setDescription('Este es un ejemplo de hoja de cálculo generada usando PhpSpreadsheet.')
        ->setKeywords('phpspreadsheet example')
        ->setCategory('Ejemplo');

    // Agregar algunos datos a la hoja de cálculo
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Asistencia');
    $sheet->setCellValue('B1', 'Tardanza');
    $sheet->setCellValue('C1', 'Falta');

    $sheetDate = $spreadsheet->getActiveSheet();
    $sheetDate->setCellValue('A2', '2');
    $sheetDate->setCellValue('B2', '11');
    $sheetDate->setCellValue('C2', '0');

    // Crear el objeto Writer
    $writer = new Xlsx($spreadsheet);

    // Guardar el archivo en el servidor
    $filename = 'gestor_reportes.xlsx';
    $writer->save($filename);

    // Configurar las cabeceras para la descarga
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    // Enviar el archivo al navegador
    $writer->save('php://output');

}

generateEXEL();
