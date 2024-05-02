<?php 

    if(!empty($_POST['button-jus'])){
        if(empty($_POST['name_jus']) || empty($_POST['motive_jus'])){

            echo "no dejar las casillas vacias";
        }else{
            setlocale(LC_TIME, "es_ES.UTF-8");
            date_default_timezone_set("America/Lima");
        
            $date = date("d/m/Y");
        
            $dataDate = date("Y-m-d");

            $hour = date("H:i:s");

            // variables del formulario
            $nameJ = $_POST['name_jus'];
            $motiveJ = $_POST['motive_jus'];
            
            $uploadDirectory = "earpfim/justificaciones/";
            $uploadedFile = $_FILES['evidence_jus']['tmp_name'];
            $fileName = basename($_FILES['evidence_jus']['name']);
            $destination = $uploadDirectory . $fileName;

            if ($fileName == ""){
                $newFileName = "No hay evidencia";
            }else{
                $newFileName = $fileName;
            }

            $checkEntryJus = "SELECT name_jus, reason_jus, evidence_jus FROM justifications WHERE teachers_id = :teachers_id AND
            date_jus = :date_jus";

            $prepareCheckEntry = $connection->prepare($checkEntryJus);
            $prepareCheckEntry->bindValue(":teachers_id", $_SESSION['user_id']);
            $prepareCheckEntry->bindValue(":date_jus", $date);
            $prepareCheckEntry->execute();

            $resultCheckEntry = $prepareCheckEntry->fetchAll(PDO::FETCH_ASSOC);
            
            try{

                if(isset($_SESSION['user_id'])){

                    if(empty($resultCheckEntry)){
                        $teacherId = $_SESSION['user_id'];

                        $consultJustifications = "INSERT INTO justifications (teachers_id, name_jus, reason_jus, evidence_jus, date_jus, hour_jus, month_date)
                        VALUES (:teachers_id, :name_jus, :reason_jus, :evidence_jus, :date_jus, :hour_jus, :month_date)";

                        $prepareConsultJus = $connection->prepare($consultJustifications);
                        $prepareConsultJus->bindValue(":teachers_id", $teacherId);
                        $prepareConsultJus->bindValue(":name_jus", $nameJ);
                        $prepareConsultJus->bindValue(":reason_jus", $motiveJ);
                        $prepareConsultJus->bindValue(":evidence_jus", $newFileName);
                        $prepareConsultJus->bindValue(":date_jus", $date);
                        $prepareConsultJus->bindValue(":hour_jus", $hour);
                        $prepareConsultJus->bindValue(":month_date", $dataDate);

                        $prepareConsultJus->execute();

                        echo "Justificacion enviada";
                    }else{
                        echo "Ya justificaste por hoy";
                    }
                    
                }else{
                    echo "error con la clave foranea";
                }

                
            }catch(PDOException $errJus){
                "error en la consulta" . $errJus->getMessage();            
            }
        }
            
            
        

        
        
    }


?>