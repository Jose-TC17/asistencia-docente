<?php 

function getCountDelay($userIdD, $connection){

    $dateDelay = date("Y-m");

    $consultCountDelay = "SELECT
    SUM(CASE WHEN asis_state = 'Tardanza' THEN 1 ELSE 0 END) as delay_attendance,
    MONTH(month_date) as month_affair,
    YEAR(month_date) as year_affair
    FROM attendance
    WHERE teachers_id = :teachers_id
    GROUP BY YEAR(month_date), MONTH(month_date)";

    $prepareConsultDelay = $connection->prepare($consultCountDelay);
    $prepareConsultDelay->bindValue(":teachers_id", $userIdD);

    $prepareConsultDelay->execute();

    $resultPrepareDelay = $prepareConsultDelay->fetchAll(PDO::FETCH_ASSOC);

    return $resultPrepareDelay;
}

function getCountJus($userIdD, $connection){

    $dateJus = date("Y-m");

    // justificaciones

    $consultCountJus = "SELECT 
        COUNT(*) as justifications_count,
        MONTH(month_date) as month_jus,
        YEAR(month_date) as year_jus
    FROM justifications
    WHERE teachers_id = :teachers_id
    GROUP BY YEAR(month_date), MONTH(month_date)
";

    $prepareConsultJus = $connection->prepare($consultCountJus);
    $prepareConsultJus->bindValue(":teachers_id", $userIdD);
    $prepareConsultJus->execute();

    $resultCountJus = $prepareConsultJus->fetchAll(PDO::FETCH_ASSOC);

    return $resultCountJus;
}

$userIdD = $_SESSION['user_id'];

$monthlyDelay = getCountDelay($userIdD, $connection);
$monthlyJus = getCountJus($userIdD, $connection);

$labelBarD = [];
$dataD = [];

$labelBarJ = [];
$dataJ = [];

foreach ($monthlyDelay as $rowD) {
    $labelBarD[] = $monthlySpanish[$rowD['month_affair'] - 1] . ' ' . date($rowD['year_affair']);
    $dataD[] = $rowD['delay_attendance'];
}

foreach ($monthlyJus as $rowJ) {
    $labelBarJ[] = $monthlySpanish[$rowJ['month_jus'] - 1] . ' ' . date($rowJ['year_jus']);
    $dataJ[] = $rowJ['justifications_count'];
}


?>