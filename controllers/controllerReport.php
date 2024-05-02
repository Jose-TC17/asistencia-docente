<?php

if(!empty($_POST['button-jus'])){
    if(empty($_POST['affair-report']) || empty($_POST['comment-report'])){
        echo "Los campos estan vacios";
    }else{
        setlocale(LC_TIME, "es_ES.UTF-8");
        date_default_timezone_set("America/Lima");

        $dateReport = date("d/m/Y");
        $hourReport = date("h:i:s");

        $affairReport = $_POST['affair-report'];
        $commentReport = $_POST['comment-report'];

        // para que registre un reporte por dia
        $verifyReport = "SELECT affair_re, comment_re FROM report WHERE teachers_id = :teachers_id
        AND date_re = :date_re";

        $prepareVerify = $connection->prepare($verifyReport);
        $prepareVerify->bindValue(":teachers_id", $_SESSION['user_id']);
        $prepareVerify->bindValue(":date_re", $dateReport);
        $prepareVerify->execute();

        $resultVerifyReport = $prepareVerify->fetchAll(PDO::FETCH_ASSOC);

        if(empty($resultVerifyReport)){
            $insertReport = "INSERT INTO report (teachers_id, affair_re, comment_re, date_re, hour_re)
            VALUES (:teachers_id, :affair_re, :comment_re, :date_re, :hour_re)";

            $insertReport = $connection->prepare($insertReport);
            $insertReport->bindValue(":teachers_id", $_SESSION['user_id']);
            $insertReport->bindValue(":affair_re", $affairReport);
            $insertReport->bindValue(":comment_re", $commentReport);
            $insertReport->bindValue(":date_re", $dateReport);
            $insertReport->bindValue(":hour_re", $hourReport);

            $insertReport->execute();

            echo "reporte enviado correctamente";
        }else{
            echo "Ya se envio el reporte por hoy";
        }
        
    }
}


?>