<?php 
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="images/icons/icon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Backlog</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/pass.css">
    <link rel="stylesheet" href="css/text.css">
    <link rel="stylesheet" href="css/email.css">
    <link rel="stylesheet" href="css/transiciones.css">
    <link rel="stylesheet" href="css/config.css">

</head>

<style>
    html,
    body {
        background: #8e9eab;
        /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #eef2f3, #8e9eab);
        /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #eef2f3, #8e9eab);
        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    .item {
        background-color: transparent;
        font-family: Times;
        font-size: 22px;
        color: rgb(220, 12, 12);
    }

    .bar {
        font-family: 'Times New Roman', Times, serif;
        font-size: 22px;
        text-align: center;
    }

    .drop {
        border-radius: 15px;
        font-family: 'Times New Roman', Times, serif;
        font-size: 18px;
        text-align: center;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top bar">
        <a class="navbar-brand item" href="index.php">
            <img class="img-fluid" src="images/icons/home.png">
        </a>
        <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">

                <?php if (!isset($_SESSION['SESION'])):?>
                <li class="nav-item active item">
                    <a class="nav-link" href="registro.php">
                        <img class="img-fluid" src="images/icons/register.png">
                        Register
                    </a>
                </li>
                    
                <li class="nav-item active item">
                    <a class="nav-link" href="login.php">
                        <img class="img-fluid" src="images/icons/pass.png">
                        Login
                    </a>
                </li>

                <?php else:?>

                <li class="dropdown">
                    <button class="btn item dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="img-fluid" src="images/icons/icon.png">
                        Account
                    </button>
                    <div class="dropdown-menu drop">
                        <a class="dropdown-item" href="home.php?item=tasks">
                            <img class="img-fluid" src="images/icons/task.png">
                            Profile
                        </a>
                        <a class="dropdown-item" href="home.php?item=backlog">
                            <img class="img-fluid" src="images/icons/backlog.png">
                            Backlog
                        </a>
                    </div>
                </li>
                    
                <li class="nav-item active item">
                    <a class="nav-link" href="login.php?item=salir">
                        <img class="img-fluid" src="images/icons/exit.png">
                        Salir <?php echo "(".$_SESSION['SESION'][0]['username'].")";?>
                    </a>
                </li>
            <?php endif; ?>

            </ul>
        </div>
    </nav>
    <br />
    <br />

    <div class="container-fluid">
