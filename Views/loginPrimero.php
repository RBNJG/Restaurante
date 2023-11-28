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
            <h2 class="text-h1">¡Te damos la bienvenida!</h2>
            <hr class="linea-carrito">
        </div>
        <div>
            <p>Introduce tu email para iniciar sesión o registrarte</p>
        </div>
        <div>
            <div class="d-flex">
                <p>Correo electrónico </p>
                <p>- Obligatorio</p>
            </div>
            <form action="" class="d-flex flex-column">
                <input type="email" class="mb-4">
                <button type="submit" class="mb-5">Continuar</button>
            </form>
        </div>
    </div>
</body>

</html>