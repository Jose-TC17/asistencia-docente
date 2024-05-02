<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="../css/nuevo-usuario.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Roboto:wght@500&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container-forms">
        <h2>Agregar Nuevo Usuario</h2>
        <form action="" method="POST">
            <label for="user-name">Usuario:</label>
            <input type="text" class="form-control" name="user-name" id="user-name">

            <label for="new-name">Nombre:</label>
            <input type="text" class="form-control" name="new-name" id="new-name">

            <label for="new-lastnameP">Apellido Paterno:</label>
            <input type="text" class="form-control" name="new-lastnameP" id="new-lastnameP">

            <label for="new-lastnameM">Apellido Materno:</label>
            <input type="text" class="form-control" name="new-lastnameM" id="new-lastnameM">

            <label for="new-email">Correo:</label>
            <input type="text" class="form-control" name="new-email" id="new-email">

            <label for="new-password">Contraseña:</label>
            <input type="text" class="form-control" name="new-password" id="new-password">

            <label for="new-phone">Telefono:</label>
            <input type="text" class="form-control" name="new-phone" id="new-phone">

            <input type="submit" name="button-new-user" value="Crear Cuenta">

        </form>
        <div class="messages-user">
            <?php 
            include("../models/baseDatos.php");
            include("../controllers/controllerCU.php");
            ?>
        </div>
    </div>

</body>

</html>