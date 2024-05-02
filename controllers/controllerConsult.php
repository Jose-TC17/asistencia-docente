<?php


function dataAttendancePDF($userIdPDF, $connection)
{
    // Crear la consulta para ver cuántas asistencias, tardanzas y faltas hay
    $consultAttendancePDF = "SELECT
        SUM(CASE WHEN asis_state = 'Puntual' THEN 1 ELSE 0 END) as punctual,
        SUM(CASE WHEN asis_state = 'Tardanza' THEN 1 ELSE 0 END) as delay_attendance,
        SUM(CASE WHEN asis_state = 'Falto' THEN 1 ELSE 0 END) as absent_attendance
        FROM attendance
        WHERE teachers_id = :teachers_id";

    $prepareConsultPDF = $connection->prepare($consultAttendancePDF);
    $prepareConsultPDF->bindValue(":teachers_id", $userIdPDF);
    $prepareConsultPDF->execute();

    $resultConsult = $prepareConsultPDF->fetchAll(PDO::FETCH_ASSOC);

    return $resultConsult;
}

 function dataMonthlyAttendance($userIdPDF, $connection){
    $consultMonthAttendance = "SELECT
    SUM(CASE WHEN asis_state = 'Puntual' THEN 1 ELSE 0 END) as punctual_month,
    SUM(CASE WHEN asis_state = 'Tardanza' THEN 1 ELSE 0 END) as delay_month,
    SUM(CASE WHEN asis_state = 'Falto' THEN 1 ELSE 0 END) as absent_month,
    MONTH(month_date) as month_date,
    YEAR(month_date) as year_date
    FROM attendance
    WHERE teachers_id = :teachers_id
    GROUP BY YEAR(month_date), MONTH(month_date)";

    $prepareConsultMonth = $connection->prepare($consultMonthAttendance);
    $prepareConsultMonth->bindValue(":teachers_id", $userIdPDF);
    $prepareConsultMonth->execute();

    $resultCountMonth = $prepareConsultMonth->fetchAll(PDO::FETCH_ASSOC);

    return $resultCountMonth;
}


?>