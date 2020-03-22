<?php

session_start();

include 'global/config.php';
include 'global/clases.php';
include 'templates/header.php';
$db = new db();
$seguridad = new seguridad();

include 'main/validateUser.php';

if ($seguridad->logueo_autorizado() == "sesion") {

    if (isset($_GET['item'])) {

        if($_GET['item'] === "tasks"){ 
            include 'main/tasks.php';            
        }else if($_GET['item'] === "backlog"){
            include 'main/backlog.php';            
        }
    }
}

if (isset($_POST['btnSendTask'])) {
    include 'main/addTask.php';            
}

if($seguridad->logueo_autorizado() == "nosesion"){
    echo "
    <script>
        alert('No ha iniciado sesión, por favor hágalo.');
        window.location.href='login.php';
    </script>";
}else if(!isset($_GET['item'])){
    echo "<script>window.location.href='home.php?item=tasks';</script>";
} 

include 'templates/footer.php';
?>