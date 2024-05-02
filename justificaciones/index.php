<?php 
    include('../controllers/controllersL.php');
    include('../models/baseDatos.php');

    
    session_start();
    // verificacion si el usuario esta auntenticado
    include("../authentication/verify.php");

    
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
  <link rel="stylesheet" href="../css/justificacioness.css">
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
    <div class="title">
      <h1>Redactar Justificación</h1>
      <hr>
    </div>
    <div class="container mt-4">
      <form enctype="multipart/form-data" method="POST">
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre:</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
            <input type="text" class="form-control" id="nombre" name="name_jus" required>
          </div>
        </div>

        <div class="mb-3">
          <label for="motivo" class="form-label">Motivo de la justificación:</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-comment"></i></span>
            <textarea class="form-control" id="motivo" name="motive_jus" rows="4" required></textarea>
          </div>
        </div>

        <div class="mb-3">
          <label for="evidencia" class="form-label">Cargar evidencia (.pdf):</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
            <input type="file" class="form-control" id="evidencia" name="evidence_jus" accept=".pdf">
          </div>
        </div>

        <div class="mb-3 text-center">
          <input type="submit" name="button-jus" class="btn btn-success" value="Enviar Justificación" />
          <button type="button" class="btn btn-danger"><i class="fas fa-times"></i> Cancelar</button>
        </div>
      </form>
      <div class="messages">
        <?php include("../controllers/controllerJustifications.php"); ?>
      </div>
    </div>

    
  </div>
  <?php include("../layouts/sidebar.php") ?>
  <script src="../js/inicio.js"></script>
  <script src="https://kit.fontawesome.com/0057a56781.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>