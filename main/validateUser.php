<?php

if (isset($_POST['btnEnter'])) {
    
    $username = $_POST['username'];
    $pass = openssl_encrypt($_POST['password'], COD, KEY);

    $accountPass = "SELECT * FROM `usuario` WHERE `password` LIKE '$pass' AND `username` LIKE '$username'";

    $accountVal = $db->db_sql($accountPass);

    if($accountVal != null){
        $seguridad->logueo_sesiones($accountVal);
    }else{
        noPass();
        exit;
    }
}

function noPass(){ ?>
<div class="alert alert-danger efecto-abajo" style="font-family: Times; font-size: 22px">
    Usuario no registrado, por favor verifique los datos e intente nuevamente.<br>
    <a href="login.php" class="badge badge-info">Inténtalo de nuevo</a><br>
    <a href="registro.php" class="badge badge-success">Regístrate</a>
</div>
<?php 
}