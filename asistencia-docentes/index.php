<?php
include('../controllers/controllersL.php');
include('../models/baseDatos.php');


session_start();
// verificacion si el usuario esta auntenticado
include("../authentication/verify.php");

// seleccionar los datos
$count = 1;

$user_id = $_SESSION['user_id'];

try{
    // haciendo una consulta para seleccionar los elementos de la tabla de asistencia
    $getAttendance = "SELECT asis_id, date_day, enter_entry, enter_exit, asis_state FROM attendance WHERE teachers_id = :user_id";

    $prepareGetUser = $connection->prepare($getAttendance);
    $prepareGetUser->bindParam("user_id", $user_id, PDO::PARAM_INT);
    $prepareGetUser->execute();

    $user_dataA = $prepareGetUser->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $errA){
    echo "error de conexion" . $errA->getMessage();
}

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
    <link rel="stylesheet" href="../css/asiistencia-docentteess.css">
    <!-- conexion con google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Roboto:wght@500&display=swap" rel="stylesheet">
</head>

<body>
    <?php include("../layouts/header.php") ?>
    <!-- contenido del cuerpo de la pagina -->
    <div class="body-container" id="body-container">
        <div class="title-attendance">
            <div class="content-header-attendance">
                <img src="../img/clipboard-list-solid.svg" alt="">
                <h1>Registrar Asistencia</h1>
            </div>
            <div class="hour">
                <label>HORA</label>
                <p class="register-hour" id="register-hour"></p>
            </div>
        </div>
        <div class="content-text">
            <p>
                <span>ENTRADA:</span> Se podra registrar la entrada apartir de las <b>7:15 AM</b> hasta las
                <b>8:00 AM</b>
                con un plazo de <b>10 minutos</b> de consideración, después de ello se le registrara como
                tardanza.
            </p>
            <hr>
            <p>
                <span>SALIDA:</span> Se podra registrar salida desde <b>5 minutos</b> antes y se tendra una
                tolerancia de <b>1 hora</b>
                como máximo para poder registrar la salida, después de ello ya no se podra marcar su salida.
            </p>
            <form action="" method="POST">
                <input type="hidden" name="action-type" value="REGISTRAR: ENTRADA / SALIDA" />
                <input type="submit" name="action-type" value="REGISTRAR: ENTRADA / SALIDA" />
            </form>
        </div>
        <div class="history-content">
            <div class="content-table">
                <div class="container-table-header">
                    <Label>Historial de Asistencia</Label>
                    <hr>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Entrada</th>
                            <th scope="col">Salida</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($user_dataA as $data): ?>
                        <tr>
                            <td class="id-row"><?php echo $count++;?></td>
                            <td><?php echo $data['date_day'] ?></td>
                            <td class="hour" id="hour"><?php echo str_replace(".0000000", "", $data['enter_entry'])?></td>
                            <td class="hour2" id="hour2"><?php echo str_replace(".0000000", "", $data['enter_exit']) ?></td>
                            <td class="punctual <?php echo strtolower($data['asis_state']); ?>" id="state">
                                <?php echo $data['asis_state'] ?>
                            </td>

                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="messages" id="messages">
            <?php
            include("../controllers/controllerAttendance.php");
            ?>
        </div>
    </div>
    <?php include("../layouts/sidebar.php") ?>
    <script src="../js/inicio.js"></script>
    <script src="../js/asistencia.js"></script>
    <script src="../js/detailsA.js"></script>
</body>

</html>