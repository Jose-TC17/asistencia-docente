<?php 
    include('../controllers/controllersL.php');
    include('../models/baseDatos.php');

    
    session_start();
    // verificacion si el usuario esta auntenticado
    include("../authentication/verify.php");
    include("../controllers/controllerReport.php");

    $countReport = 1;

    $selectReports = "SELECT affair_re, comment_re, date_re, hour_re FROM report WHERE teachers_id = :teachers_id";
    $prepareSelectR = $connection->prepare($selectReports);
    $prepareSelectR->bindParam(":teachers_id", $_SESSION['user_id'], PDO::PARAM_INT);
    $prepareSelectR->execute();

    $resultSelectR = $prepareSelectR->fetchAll(PDO::FETCH_ASSOC);

    
    
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
    <link rel="stylesheet" href="../css/inicio.css">
    <link rel="stylesheet" href="../css/historiales-j-p.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- conexion con google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Roboto:wght@500&display=swap" rel="stylesheet">
</head>

<body>
    <?php include("../layouts/header.php") ?>
    <!-- contenido del cuerpo de la pagina -->
    <div class="body-container" id="body-container">
        <h1>Historial de Notificaciones</h1>
        <div class="content-history-j">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Asunto</th>
                        <th scope="col">Comentario</th>
                        <th scope="col">Dia y fecha</th>
                        <th scope="col">Hora</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach($resultSelectR as $dataR): ?>
                    <tr>
                        <th scope="row"><?php echo $countReport++ ?></th>
                        <td><?php echo $dataR['affair_re'] ?></td>
                        <td><?php echo $dataR['comment_re'] ?></td>
                        <td><?php echo $dataR['date_re'] ?></td>
                        <td><?php echo str_replace(".0000000", "", $dataR['hour_re']);  ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
    <?php include("../layouts/sidebar.php") ?>
    <script src="../js/inicio.js"></script>
    <script src="https://kit.fontawesome.com/0057a56781.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>