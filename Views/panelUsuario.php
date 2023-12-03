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
    <h1>Panel usuario</h1>
    <a href="<?= url . "?controller=Panel&action=modificarDatos" ?>">Modificar mis datos</a>
    <a href="">Ver pedidos</a>
    <a href="<?= url . "?controller=Panel&action=desconectar" ?>">Desconectar</a>
</body>

</html>