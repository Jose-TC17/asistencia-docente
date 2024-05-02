<?php

if(!isset($_SESSION)){
    session_start();
}

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["change-password"])){
    $curretPassword = $_POST['curret-password'];
    $newPassword = $_POST['new-password'];
    $confirm_password = $_POST['confirm-password'];
    $user_id = $_SESSION['user_id'];
    
    try{
        $consulPA = "SELECT password_teacher FROM teachers WHERE teachers_id = :user_id";
        $conexPrepare = $connection->prepare($consulPA);
        $conexPrepare->bindParam(":user_id", $user_id);
        $conexPrepare->execute();
        $result =  $conexPrepare->fetch(PDO::FETCH_ASSOC);

        if(!$result){
            echo 'Contraseña actual incorrecta';
        } else{
            $curretPasswordH = $result['password_teacher'];

            if(password_verify($curretPassword, $curretPasswordH)){
                if($newPassword == $confirm_password){
                    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
            
                    $consult = "UPDATE teachers SET password_teacher = :newPassword WHERE teachers_id = :user_id";
                    $conexPrepare = $connection->prepare($consult);
                    $conexPrepare->bindParam(":newPassword", $newPasswordHash);
                    $conexPrepare->bindParam(":user_id", $user_id);
                    $conexPrepare->execute();
            
                    echo "Cambio de contraseña correctamente";
                }
            }else{
                echo "Contraseña actual incorrecta";
            }
        }
    }catch(PDOException $errorPassword){
        echo "Error en la consulta" . $errorPassword->getMessage();
    }
}
?>