<?php
include('../controllers/controllersL.php');
include('../models/baseDatos.php');


session_start();
// verificacion si el usuario esta auntenticado
include("../authentication/verify.php");

include("../controllers/controllercontrolAttendance.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="3600;url=../authentication/authentication.php">
    <title>OEARP | UNI</title>
    <!-- icono del sistema -->
    <link rel="icon" href="../img/UNI.png">
    <!-- conexion con archivos css -->
    <link rel="stylesheet" href="../css/headerss.css">
    <link rel="stylesheet" href="../css/sidebarss.css">
    <link rel="stylesheet" href="../css/gestor-reportees.css">
    <!-- conexion con google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Roboto:wght@500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/0057a56781.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body>
    <?php include("../layouts/header.php") ?>
    <!-- contenido del cuerpo de la pagina -->
    <div class="body-container" id="body-container">
        <div class="title">
            <h1>REPORTES ASISTENCIA</h1>
            <hr>
        </div>
        <div class="buttons">
            <div class="download">
                <a class="PDF" href="../controllers/controllerPDF.php"><i class="far fa-file-pdf"></i>Descargar PDF</a>
                <a class="EXEL" href="../controllers/controllerEXEL.php"><i class="fa-solid fa-file-excel"></i>Descargar EXEL</a>
            </div>
            <div class="insert-report">
                <button id="new_form"><i class="fa-solid fa-plus"></i>Nueva Nota</button>
                <a href="../gestor-reportes/ver-reportes.php"><i class="fa-solid fa-bell"></i>Notificaciones</a>
            </div>
        </div>
        <div class="statistics">
            <div class="average-attendance">
                <h3>Promedio</h3>
                <div class="circle" id="circle">
                    <label class="percentage" id="percentaje"><?php echo number_format($averagePorcentage, 2) . "%" ?></label>
                    <label class="attendance-circle">asistencias</label>
                </div>
            </div>
            <div class="graphics">
                <div class="graphics-pie"><canvas class="pie" id="pie"></canvas>
                </div>
            </div>
        </div>
        <div class="graphics-big">
            <div class="graphics-line"><canvas class="line" id="line"></canvas>
            </div>
            <div class="graphics-bar">
                <canvas class="bar" id="bar"></canvas>
            </div>
            <div class="container-forms" id="container-forms">
                <form enctype="multipart/form-data" method="POST">
                    <div class="x">
                        <i id="x-button" class="fa-solid fa-xmark"></i>
                    </div>
                    <h3>Nueva Nota</h3>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Asunto:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="nombre" name="affair-report" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="motivo" class="form-label">Comentarios:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-comment"></i></span>
                            <textarea class="form-control" id="motivo" name="comment-report" rows="4" required></textarea>
                        </div>
                    </div>

                    <div class="mb-3 text-center">
                        <input type="submit" name="button-jus" class="btn btn-primary" value="Enviar Informe" />
                    </div>
                </form>

                <div class="messages">
                    <?php include("../controllers/controllerReport.php"); ?>
                </div>
            </div>
        </div>
        
    </div>
    <?php include("../layouts/sidebar.php") ?>
    <script src="../js/inicio.js"></script>
    <script src="../js/reporteess.js"></script>
    <?php include("../graphics/graphics.php"); ?>
    <script>
        const percentage = document.getElementById("percentaje");
        const circle = document.getElementById("circle");
        const attendanceCircle = document.getElementById("attendance-circle");

        const averagePorcentage = <?php echo $averagePorcentage; ?>;

        if (averagePorcentage > 50) {
            circle.style.backgroundColor = "#256AEA";
        } else if (averagePorcentage <= 50 && averagePorcentage > 25) {
            circle.style.backgroundColor = "#F96A1E";
        } else {
            circle.style.backgroundColor = "#F00";
        }
    </script>
    


</body>

</html>