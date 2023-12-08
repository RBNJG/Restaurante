<?php

$carrito = $_SESSION['carrito'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Descripció web">
    <meta name="keywords" content="Paraules clau">
    <meta name="author" content="Autor">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/full_estil.css" rel="stylesheet" type="text/css" media="screen">
    <title>Leroy Merlin</title>
</head>

<body>
    <div class="d-flex flex-column align-items-center">
        <div class="d-flex flex-column align-items-center">
            <h2 class="text-h1">Iniciar sesión</h2>
            <hr class="linea-carrito">
        </div>
        <div>
            <p class="text text-password-big color-hover"><?= $_SESSION['mail'] ?></p>
        </div>
        <div class="password-container">
            <div class="d-flex align-items-center">
                <p class="me-1 mb-2 text text-password-big color-migas">Contraseña</p>
                <p class="text mb-2 text-password-small color-hover">- Obligatorio</p>
            </div>
            <form action=<?= url . "?controller=Password&action=verificar" ?> method='post' class="d-flex flex-column">
                <input name="password" type="password" class="mb-4 p-3 input-password">
                <?php
                if (isset($_SESSION['errorpassword'])) {
                ?>
                    <p><?= $_SESSION['errorpassword'] ?></p>
                <?php
                    unset($_SESSION['errorpassword']);
                }
                ?>
                <button type="submit" class="mb-5 btn-compra">Conectarme</button>
            </form>
        </div>
    </div>
</body>

</html>