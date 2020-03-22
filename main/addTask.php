<?php

date_default_timezone_set('America/Bogota');
$date = date("Y-m-d h:i:s");

$task = $_POST['taskName'];
$status = $_POST['selectStatus'];
$points = $_POST['points'];
$description = $_POST['description'];
$username = $_SESSION['SESION'][0]['username'];

$query = "INSERT INTO `task` (`user_assigned`, `task`, `description`, `points`, `status`, `date`) VALUES ('$username', '$task', '$description', '$points', '$status', '$date');";

if($db->newRow($query) >= 1){ 
    
    echo "
    <script>
        alert('Task added successfully.');
        window.location.href='home.php?item=tasks';
    </script>";
    }else{ 
        
    echo "
    <script>
        alert('Error...');
        window.location.href='home.php?item=tasks';
    </script>";
}