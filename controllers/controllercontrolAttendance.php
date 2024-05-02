<?php

function getPorcentage($userIdP, $connection){

    // capturas el año mes y dia
    $curretMonth = date("Y-m-d");

    // consulta va a contar cuantos puntuales, tardanzas o faltas
    $consultPercentaje = "SELECT
    SUM(CASE WHEN asis_state = 'Puntual' THEN 1 ELSE 0 END) as punctual_count,
    SUM(CASE WHEN asis_state = 'Tardanza' THEN 1 ELSE 0 END) as delay_count,
    SUM(CASE WHEN asis_state = 'Falto' THEN 1 ELSE 0 END) as absent_count
    FROM attendance
    WHERE teachers_id = :teachers_id";
    // prepara consulta
    $prepareConsultP = $connection->prepare($consultPercentaje);
    $prepareConsultP->bindValue(":teachers_id", $userIdP);
    // 
    $prepareConsultP->execute();

    $resultConsultP = $prepareConsultP->fetch(PDO::FETCH_ASSOC);

    return $resultConsultP;
}

$userIdP = $_SESSION['user_id'];

$getPersentangeD = getPorcentage($userIdP, $connection);

$totalPunctual = $getPersentangeD['punctual_count'];
$totalDelay = $getPersentangeD['delay_count'];
$totalAbsent = $getPersentangeD['absent_count'];

$totalValue = ($totalPunctual * 100) + ($totalDelay * 50) + ($totalAbsent * 0);

$totalAttendance = $totalPunctual + $totalDelay + $totalAbsent;

// Check if $totalAttendance is zero before performing the division
$averagePorcentage = $totalAttendance !== 0  ? $totalValue / $totalAttendance : 0;

?>
