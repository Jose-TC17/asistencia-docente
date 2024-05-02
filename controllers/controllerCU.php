<?php 
    // controlador para agregar usuario

    if(!empty($_POST['button-new-user'])){
        if(empty($_POST['user-name']) || empty($_POST['new-name']) || empty($_POST['new-lastnameP']) || empty($_POST['new-lastnameM']) || empty($_POST['new-email']) || empty($_POST['new-password']) || empty($_POST['new-phone'])){
            echo "No dejar casillas vacias";
        }
        else{
            $userName = $_POST['user-name'];
            $newName = $_POST['new-name'];
            $newLastnameP = $_POST['new-lastnameP'];
            $newLastnameM = $_POST['new-lastnameM'];
            $newEmail = $_POST['new-email'];
            $newPassword = $_POST['new-password'];
            $newPhone = $_POST['new-phone'];

            $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

            try{
                $consultNewUser = "INSERT INTO teachers (user_teacher, name_teacher, lastnameP_teacher, lastnameM_teacher, email_teacher, password_teacher, phonenumber) VALUES (:user_teacher, :name_teacher, :lastnameP, :lastnameM, :email_teacher, :password_teacher, :phone)";
                $prepareConsultUser = $connection->prepare($consultNewUser);
                $prepareConsultUser->bindParam(":user_teacher", $userName);
                $prepareConsultUser->bindParam(":name_teacher", $newName);
                $prepareConsultUser->bindParam(":lastnameP", $newLastnameP);
                $prepareConsultUser->bindParam(":lastnameM", $newLastnameM);
                $prepareConsultUser->bindParam(":email_teacher", $newEmail);
                $prepareConsultUser->bindParam(":password_teacher", $newPasswordHash);
                $prepareConsultUser->bindParam(":phone", $newPhone);
                $prepareConsultUser->execute();

                echo "Usuario creado exitosamente";
            }catch(PDOException $errorCU){
                echo "error de conexion" . $errorCU->getMessage();
            }

        }   
    }

?>