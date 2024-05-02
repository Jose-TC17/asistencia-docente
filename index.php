<?php

session_start();
session_destroy();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OEARP | UNI</title>
    <!-- icono del sistema -->
    <link rel="icon" href="img/UNI.png">
    <!-- conexion con archivos css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/messagess.css">
    <!-- conexion con google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/0057a56781.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="header">
        <img src="img/UNI.png" alt="logo de la uni">
        <label>UNIVERSIDAD NACIONAL DE INGENIERÍA <br> <span>FACULTAD DE INGENIERÍA MÉCANICA</span></label>
    </header>
    <section class="main-section">
        <h1 class="title">INTRANET EARPFIM</h1>
        <p class="login-text">
            Sistema de Planificación de Recursos Académicos y
            Empresariales
        </p>
        <div class="login-container">
            <form action="" method="post">
                <!-- usuario -->
                <div class="user-container">
                    <label class="user">Usuario</label>
                    <input type="email" id="email" name="email" placeholder="Usuario UNI">
                </div>
                <!-- contraseña -->
                <div class="password-container">
                    <label class="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Contraseña">
                </div>
                <!-- mostrar contraseña -->
                <div class="show-password">
                    <input type="checkbox" name="" id="show-password" onclick="showPassword()">
                    <label>Mostrar contraseña</label>
                </div>
                <!-- boton -->
                <input type="submit" class="button" id="button" name="button" value="INICIAR SESION">

            </form>
            <a href="" class="questions">¿Olvido su contraseña?</a>
            <div class="separation">
                <hr>
                o
                <hr>
            </div>
            <button class="btn-google"><img src="img/google.png" alt="google">Iniciar Sesion con Google</button>
            <label class="info">Temporalmente solo para docentes</label>
        </div>
        <div class="messages" id="messages">
            <?php
            include('models/baseDatos.php');
            include('controllers/controllersL.php');
            ?>
        </div>
    </section>
    <script src="js/mostrar-contra.js"></script>
</body>

</html>