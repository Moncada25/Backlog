<?php

if (isset($_POST['btnCreateAccount'])) {

    date_default_timezone_set('America/Bogota');

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = openssl_encrypt($_POST['password'], COD, KEY);
    $team = $_POST['team'];
    $date = date("Y-m-d h:i:s");

    $query = "INSERT INTO `usuario` (`username`, `password`, `email`, `team`, `status`, `date_access`)
    VALUES ('$username', '$password', '$email', '$team', '0', '$date')";

    if ($db->newRow($query) > 0) { ?>

    <div class="alert alert-success efecto-derecha" style="font-family: Times; font-size: 22px">
        Account created successfully<br>
        <a href="login.php" class="badge badge-success">Login</a>
    </div>
    <?php
    } else { ?>
    <div class="alert alert-danger efecto-derecha" style="font-family: Times; font-size: 22px">
        Error creating account<br>
    </div>
    <?php
    }
    
} else { ?>

    <div class="col-sm-12 shadow-lg p-3 mb-5 cajita efecto-arriba">
        <form id="form" action="" method="post">
            <h1>Create account</h1>
            <hr>

            <div class="row">
                <div class="col-sm-6 form-row" style="margin-bottom: 25px;">
                    <input type="text" maxlength="30" name="username" id="username" required />
                    <label alt="Label" data-placeholder="Username"></label>
                </div>
                <div class="col-sm-6 form-row" style="margin-bottom: 25px;">
                    <input type="email" maxlength="60" name="email" id="email" required />
                    <label alt="Label" data-placeholder="Email"></label>
                </div> 
            </div>

            <div class="row">
                <div class="col-sm-6 form-row" style="margin-bottom: 25px;">
                    <input type="password" maxlength="30" name="password" id="password" required />
                    <label alt="Label" data-placeholder="Password"></label>
                </div>
                <div class="col-sm-6 form-row" style="margin-bottom: 25px;">
                    <input type="text" maxlength="30" name="team" id="team"/>
                    <label alt="Label" data-placeholder="Team"></label>
                </div>
            </div>

            <button form="form" class="btn" type="submit" name="btnCreateAccount" id="btnCreateAccount">Add user</button>
            <br>
            <br>
        </form>
    </div>
<?php
}