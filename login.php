<?php

session_start();

include 'global/config.php';
include 'global/clases.php';
include 'templates/header.php';
$db = new db();
$seguridad = new seguridad();

if ($seguridad->logueo_autorizado() != "nosesion") {

    if($_GET['item'] === "salir"){ 
        $seguridad->salir();
    }
}

if ($seguridad->logueo_autorizado() == "nosesion") { ?>

    <div class="row">
        <div class="col-sm-5 shadow-lg p-3 mb-5 cajita efecto-abajo">
            <form id="login" action="home.php" method="post">
                <h1>Enter to backlog</h1>
                <hr class="efecto-abajo">
                <div class="row">
                    <div class="col-sm-6 form-row" style="margin-bottom: 25px;">
                        <input type="text" maxlength="30" name="username" id="username" required />
                        <label alt="Label" data-placeholder="Username"></label>
                    </div>
                    <div class="col-sm-6 form-row" style="margin-bottom: 25px;">
                        <input type='password' maxlength="30" name="password" id="password" required />
                        <label alt="Label" data-placeholder="Password"></label>
                    </div>
                </div>
            </form>
            <button form="login" class="btn" name="btnEnter" type="submit">Login</button>
            <br>
            <br>
        </div>
    </div>

<?php

}else { 
    
    echo "
    <script>
        alert('Cierre la sesión actual para continuar con el logueo.');
        window.location.href='home.php?item=tasks';
    </script>";
}

include 'templates/footer.php';
?>