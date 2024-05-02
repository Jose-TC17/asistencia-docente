<?php

function getCountAttendance($userId, $connection){
    $curretMonth = date("Y-m");

    $consultMonth = "SELECT 
        SUM(CASE WHEN asis_state = 'Puntual' THEN 1 ELSE 0 END) as punctual_count,
        SUM(CASE WHEN asis_state = 'Falto' THEN 1 ELSE 0 END) as absent_count,
        MONTH(month_date) as month_date,
        YEAR(month_date) as year_date
    FROM attendance
    WHERE teachers_id = :teachers_id
    GROUP BY YEAR(month_date), MONTH(month_date)";

    $prepareConsultMonth = $connection->prepare($consultMonth);
    $prepareConsultMonth->bindValue(":teachers_id", $userId);
    $prepareConsultMonth->execute();

    $resultPrepareConsult = $prepareConsultMonth->fetchAll(PDO::FETCH_ASSOC);

    return $resultPrepareConsult;
}

$monthA = date("m");

$monthlySpanish = [
    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
];

$userId = $_SESSION['user_id'];

$monthlyAttendanceData = getCountAttendance($userId, $connection);

$labelsLine = [];
$dataPunctual = [];
$dataAbsent = [];

foreach($monthlyAttendanceData as $row){
    $labelsLine[] = $monthlySpanish[date($row['month_date']) - 1]. ' ' . date($row['year_date']);
    $dataPunctual[] = $row['punctual_count'];
    $dataAbsent[] = $row['absent_count'];
}


?>