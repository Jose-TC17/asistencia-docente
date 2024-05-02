<?php 

// funcion para el grafico Pie (asistencia generales)
function getAttendanceData($userId, $connection){
    // obtener los datos de la asistencia
    $consultAttendance = "SELECT asis_state, COUNT(*) as count FROM attendance WHERE teachers_id = :userId GROUP BY
    asis_state";

    $prepareConsultA = $connection->prepare($consultAttendance);
    $prepareConsultA->bindValue(":userId", $userId);
    $prepareConsultA->execute();
    $resultAttendance = $prepareConsultA->fetchAll(PDO::FETCH_ASSOC);


    $labels = [];
    $data = [];

    foreach ($resultAttendance as $row){
        $labels[] = $row['asis_state'];
        $data[] = $row['count'];
    }

    return ['labels' => $labels, "data" => $data];
}

$userId = $_SESSION['user_id'];
$attendanceData = getAttendanceData($userId, $connection);

?>