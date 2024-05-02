<?php
if (empty($_SESSION['user_id'])) {
    session_start();
    header("location: ../authentication/authentication.php");
    exit();
}
?>

<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <a href="../inicio/">
            <img class="logo" src="../img/UNI.png" alt="logo uni">
        </a>
        <div class="title">
            <label class="university-name">UNI | EARPFIM</label>
            <label class="teacher">Docente</label>
        </div>
    </div>
    <div class="list-nav">
        <div class="general">
            <div class="title-general" id="title-general">
                <img src="../img/briefcase-solid.svg" alt="">
                <label>GENERAL</label>
                <img id="angle" class="angle" src="../img/angle-down-solid.svg" alt="">
            </div>
            <div class="container-general" id="container-general">
                <a href="../asistencia-docentes/" class="list-content">Asistencia</a>
                <a href="../gestor-reportes/" class="list-content">Generar Reportes</a>
                <a href="../justificaciones/" class="list-content">Redactar Justificación</a>
                <a href="../gestor-reportes/ver-reportes.php" class="list-content">Ver Reportes</a>
                <a href="../justificaciones/ver-justificaciones.php" class="list-content">Ver Justificaciones</a>
                <a href="../ayuda/" class="list-content">Ayuda</a>
            </div>
        </div>
    </div>
</div>