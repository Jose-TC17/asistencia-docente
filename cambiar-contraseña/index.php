<?php 
    // include('../controllers/controllersL.php');
    include('../models/baseDatos.php');

    
    session_start();
    // verificacion si el usuario esta auntenticado
    if(empty($_SESSION['user_id'])){
        header("location: ../authentication/authentication.php");
        exit();
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link rel="stylesheet" href="../css/cambiar-contraseñas.css">
</head>

<body>
    <div class="back">
        <a href="../inicio/">Regresar</a>
    </div>
    <div class="container">
        <h2>Cambiar Contraseña</h2>
        <form action="../cambiar-contraseña/" method="POST">
            <label for="password_actual">Contraseña Actual:</label>
            <input type="password" id="password_actual" name="curret-password" required>
            <br>

            <label for="nueva_contrasena">Nueva Contraseña:</label>
            <input type="password" id="nueva_contrasena" name="new-password" required>
            <br>

            <label for="confirmar_contrasena">Confirmar Nueva Contraseña:</label>
            <input type="password" id="confirmar_contrasena" name="confirm-password" required>
            <br>

            <input type="submit" name="change-password" value="cambiar Contraseña">
        </form>
    </div>
    <div class="messages-password" id="messages-password">
        <?php 
        include("../models/baseDatos.php");
        include("../controllers/controllerCC.php");
        ?>
    </div>
</body>

</html>
