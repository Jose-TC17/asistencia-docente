<?php

$hourA = date("H:i:s");

// Mapeo de los días
$daysSpanish = array(
    'Monday' => 'Lunes',
    'Tuesday' => 'Martes',
    'Wednesday' => 'Miércoles',
    'Thursday' => 'Jueves',
    'Friday' => 'Viernes',
    'Saturday' => 'Sábado',
    'Sunday' => 'Domingo'
);

setlocale(LC_TIME, "es_ES.UTF-8");
date_default_timezone_set("America/Lima");

$dateDay = date("l");
$dataDate = date("d/m/y");
$dataHour = date("H:i:s");

$dateAttendance = date("Y-m-d");


$newDaysSpanish = $daysSpanish[$dateDay];

if ($_SERVER['REQUEST_METHOD'] === "POST" && !empty($_POST['action-type'] === "REGISTRAR: ENTRADA / SALIDA")) {
    try {

        // registrar si se ha entrado la asistencia en el dia actual
        $checkEntryQuery = "SELECT asis_id, enter_entry, enter_exit FROM attendance WHERE teachers_id = :teachers_id AND
        date_day = :date_day";

        $prepareCheckEntry = $connection->prepare($checkEntryQuery);
        $prepareCheckEntry->bindValue(":teachers_id", $_SESSION['user_id']);
        $prepareCheckEntry->bindValue(":date_day", "$newDaysSpanish $dataDate");
        $prepareCheckEntry->execute();

        $entryData = $prepareCheckEntry->fetch(PDO::FETCH_ASSOC);

        // condicion del estado de asistencia
        if (strtotime($dataHour) >= strtotime("7:15:00") && strtotime($dataHour) <= strtotime("8:10:00")) {
            $stateAttendance = "Puntual";
        } elseif (strtotime($dataHour) >= strtotime("8:11:00") && strtotime($dataHour) <= strtotime("13:55:00")) {
            $stateAttendance = "Tardanza";
        } else {
            $stateAttendance = "Falto";
        }

        if (empty($entryData) && strtotime($dataHour) >= strtotime("7:15:00") && strtotime($dataHour) <= strtotime("13:55:00")) {
            $consultA = "INSERT INTO attendance (teachers_id, date_day, enter_entry, enter_exit, asis_state, month_date)
            VALUES (:teachers_id, :date_day, :enter_entry, :enter_exit, :asis_state, :month_date)";

            $prepareConsultA = $connection->prepare($consultA);
            $prepareConsultA->bindValue(":teachers_id", $_SESSION['user_id']);
            $prepareConsultA->bindValue(":date_day", "$newDaysSpanish $dataDate");
            $prepareConsultA->bindValue(":enter_entry", $dataHour);
            $prepareConsultA->bindValue(":enter_exit", "Aun no marca salida");
            $prepareConsultA->bindValue(":asis_state", $stateAttendance);
            $prepareConsultA->bindValue(":month_date", $dateAttendance);

            $prepareConsultA->execute();

?>
            <script>
                const messages = document.getElementById("messages");
                messages.style.display = 'flex';
                messages.style.background = '#38AE26';
                messages.style.border = '1px solid #21A90C';

                function timeDate() {
                    messages.style.display = 'none';
                }
                setTimeout(timeDate, 3000);
            </script>
        <?php
            echo "Entrada registrada correctamente";
            echo '<meta http-equiv="refresh" content="2;index.php">';
        } else if ((empty($entryData['enter_exit']) || $entryData['enter_exit'] == "Aun no marca salida") && strtotime($dataHour) >= strtotime("13:56:00") && strtotime($dataHour) <= strtotime("15:00:00")) {

            $updateEntryQuery = "UPDATE attendance SET enter_exit = :enter_exit WHERE asis_id = :asis_id_update";
            $prepareUpdateEntry = $connection->prepare($updateEntryQuery);
            $prepareUpdateEntry->bindValue(":enter_exit", $dataHour);
            $prepareUpdateEntry->bindValue(":asis_id_update", $entryData['asis_id']);
            $prepareUpdateEntry->execute();


        ?>
            <script>
                const messages = document.getElementById("messages");
                messages.style.display = 'flex';
                messages.style.background = '#38AE26';
                messages.style.border = '1px solid #21A90C';

                function timeDate() {
                    messages.style.display = 'none';
                }
                setTimeout(timeDate, 3000);
            </script>
        <?php
            echo "Salida registrada correctamente";
            echo '<meta http-equiv="refresh" content="2;index.php">';
        } else {

        ?>
            <script>
                const messages = document.getElementById("messages");
                messages.style.display = 'flex';
                messages.style.background = '#ED6F17';
                messages.style.border = '1px solid #D6610F';

                function timeDate() {
                    messages.style.display = 'none';
                }
                setTimeout(timeDate, 3000);
            </script>
<?php
            echo 'Ya se registró la entrada';

            echo '<meta http-equiv="refresh" content="2;index.php">';
            exit();
        }
    } catch (PDOException $errA) {
        $response['success'] = False;
        $response['message'] = "Error en la consulta" . $errA->getMessage();

        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
}





?>