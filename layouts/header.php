<?php 

    include("../models/baseDatos.php");
    include("../controllers/controllersL.php");

     if(empty($_SESSION['user_id'])){
        session_start();
        header("location: ../authentication/authentication.php");
        exit();
     }

     // obtener los datos del usuario
     $user_id = $_SESSION['user_id'];

     $getUser = "SELECT name_teacher , lastnameP_teacher, lastnameM_teacher FROM teachers WHERE teachers_id= :user_id";
     $prepareGetUser = $connection->prepare($getUser);
     $prepareGetUser->bindParam(':user_id', $user_id, PDO::PARAM_INT);
     $prepareGetUser->execute();
     $user_data = $prepareGetUser->fetch(PDO::FETCH_ASSOC);

    //  mostrar el nombre de usuario en el header
    $userName = $user_data['name_teacher'] . " " . $user_data['lastnameP_teacher'] . " " . $user_data['lastnameM_teacher']; 
?>


<header class="header" id="header">
    <!-- lineas del menu -->
    <div class="menu-line" id="menu-line">
        <div class="line-span-one"></div>
        <div class="line-span-two"></div>
        <div class="line-span-three"></div>
    </div>
    <!-- nombre del usuario -->
    <label class="user-name" id="user-name">Bienvenido, <?php echo $userName ?></label>
    <!-- ajustes -->
    <img class="settings" id="settings" src="../img/tres-puntos.png" alt="ajustes">
    <!-- contenido de los ajustes -->
    <div class="settings-container" id="settings-container">
        <a href="../cambiar-contraseña/">Cambiar Contraseña</a>
        <a href="../controllers/controllerCS.php">Cerrar Sesion</a>
    </div>
</header>