
<?php
// verificacion si el usuario esta auntenticado
if (empty($_SESSION['user_id'])) {
    header("location: ../authentication/authentication.php");
    exit();
}

if(isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 3600)){
        session_unset();
        session_destroy();
        header("location: ../authentication/authentication.php");
        exit();
    }

    $_SESSION['last_activity'] = time();

?>