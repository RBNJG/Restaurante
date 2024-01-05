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
    <link href="assets/css/panel.css" rel="stylesheet" type="text/css" media="screen">
    <title>Leroy Merlin</title>
</head>

<body>
    <div class="mt-2 d-flex flex-column align-items-center rellenar">
        <div class="d-flex flex-column align-items-center">
            <h2 class="text-h1">¡Te damos la bienvenida!</h2>
            <hr class="linea-carrito">
        </div>
        <div>
            <p class="text color-verde">Introduce tu email para iniciar sesión o registrarte</p>
        </div>
        <div class="password-container">
            <div class="d-flex align-items-center">
                <p class="me-1 mb-2 text text-password-big color-migas">Correo electrónico</p>
                <p class="text mb-2 text-password-small color-hover">- Obligatorio</p>
            </div>
            <form action=<?= url . "?controller=Login&action=verificarMail" ?> method='post' class="d-flex flex-column">
                <input name="mail" type="email" class="mb-4 p-3 input-password">
                <button type="submit" class="mb-5 btn-compra">Continuar</button>
            </form>
        </div>
    </div>
</body>

</html>