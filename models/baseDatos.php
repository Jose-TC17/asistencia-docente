<!-- conexion a la base de datos -->

<?php
    $server = "localhost";
    $database = "EARPFIM";
    $user = "";
    $password = "";

    try{
        $connection = new PDO("sqlsrv:Server=$server; Database=$database", $user, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    catch(PDOException $error){
        die("Error de conexion:" .$error->getMessage());
    }
?>  