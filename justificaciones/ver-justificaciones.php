<?php 
    include('../controllers/controllersL.php');
    include('../models/baseDatos.php');

    
    session_start();
    // verificacion si el usuario esta auntenticado
    include("../authentication/verify.php");
    include("../controllers/controllerJustifications.php");

    $countJus = 1;
    $user_id = $_SESSION['user_id'];

    try{    
        $selectJus = "SELECT reason_jus, evidence_jus, date_jus, hour_jus FROM justifications WHERE teachers_id = :teachers_id";
        $prepareSelectJ = $connection->prepare($selectJus);
        $prepareSelectJ->bindParam(":teachers_id", $user_id, PDO::PARAM_INT);
        $prepareSelectJ->execute();

        $dataSelectJ = $prepareSelectJ->fetchAll(PDO::FETCH_ASSOC);

    }catch(PDOException $err){
        echo "error en la consulta" . $err->getMessage();
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
        <h1>Historial de justificaciones</h1>
        <div class="content-history-j">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Mensaje</th>
                        <th scope="col">Evidencia</th>
                        <th scope="col">Dia y fecha</th>
                        <th scope="col">Hora</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dataSelectJ as $info): ?>
                    <tr>
                        <th scope="row"><?php echo $countJus++ ?></th>
                        <td><?php echo $info['reason_jus'] ?></td>
                        <td><?php echo $info['evidence_jus'] ?></td>
                        <td><?php echo $info['date_jus'] ?></td>
                        <td><?php echo str_replace(".0000000", "", $info['hour_jus'] ) ?></td>
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