<?php

session_start();

include 'global/config.php';
include 'global/clases.php';
include 'templates/header.php';
$db = new db();
$seguridad = new seguridad();

if ($seguridad->logueo_autorizado() == "nosesion"){
    include 'main/addUser.php';
} else{ 

    echo "
    <script>
        alert('Cierre la sesión actual para continuar con el registro.');
        window.location.href='home.php?item=tasks';
    </script>";
    ?>

<?php } ?>

<?php
include 'templates/footer.php';
?>