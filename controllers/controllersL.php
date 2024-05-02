<?php

// include("../models/baseDatos.php");

if (!empty($_POST['button'])) {
    if (empty($_POST['email']) && empty($_POST['password'])) {
?>
        <script>
            const messages = document.getElementById("messages");
            messages.style.display = 'flex';
            messages.style.background = '#E74826';
            messages.style.border = '1px solid #F33E17';

            function timeDate() {
                messages.style.display = 'none';
            }

            setTimeout(timeDate, 3000);
        </script>
        <?php
        echo '<p><i class="fa-regular fa-circle-xmark"></i> Los campos estan vacios</p>';
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        try {
            // consulta sql
            $consultDB = "SELECT * FROM teachers WHERE email_teacher=:email";

            // preparar consulta
            $prepareConsult = $connection->prepare($consultDB);

            // los parametros
            $prepareConsult->bindParam(':email', $email);
            // $prepareConsult->bindParam(':password', $password);

            // ejecutar la consulta
            $prepareConsult->execute();

            // obtener los resultados
            $users = $prepareConsult->fetch(PDO::FETCH_ASSOC);

            if ($users) {
                if (password_verify($password, $users['password_teacher'])) {
                    ?>
                        <script>
                            const messages = document.getElementById("messages");
                            messages.style.display = 'flex';
                            messages.style.background = '#38AE26';
                            messages.style.border = '1px solid #21A90C';

                            function timeDate() {
                                messages.style.display = 'none';
                            }
                            setTimeout(timeDate, 3000);
                        </script>
                    <?php
                    echo '<p><i class="fa-regular fa-circle-check"></i> Inicio de sesion exitoso</p>';
                    session_start();
                    $_SESSION['user_id'] = $users['teachers_id'];
                    header("location: inicio/index.php");
                }
                else{
                    ?>
                        <script>
                            const messages = document.getElementById("messages");
                            messages.style.display = 'flex';

                            function timeDate() {
                                messages.style.display = 'none';
                            }

                            setTimeout(timeDate, 3000);
                        </script>
                    <?php
                    echo '<p><i class="fa-regular fa-circle-xmark"></i> Contraseña incorrecta </p>';
                }
            } else {
                ?>
                    <script>
                        const messages = document.getElementById("messages");
                        messages.style.display = 'flex';

                        function timeDate() {
                            messages.style.display = 'none';
                        }

                        setTimeout(timeDate, 3000);
                    </script>
                <?php
                echo '<p><i class="fa-regular fa-circle-xmark"></i> Usuario no registrado</p>';
            }
        } catch (PDOException $errorL) {
            echo '<p><i class="fa-regular fa-circle-xmark"></i> error con la consulta</p>' . $errorL->getMessage();
        }
    }
}

?>