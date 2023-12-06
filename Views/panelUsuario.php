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
    <div class="container-flex fondo-panel">
        <div class="container pt-3">
            <div class="row">
                <div class="col-3">
                    <div class="fondo-blanco">
                        <div class="d-flex justify-content-start align-items-center mb-3">
                            <div class="circulo-user"></div>
                            <div class="ms-3">
                                <p class="mb-0"><?= $usuario->getNombre() . " " . $usuario->getApellidos() ?></p>
                                <p class="mb-0"><?= $usuario->getRol_id() ?></p>
                            </div>
                        </div>

                        <a href="<?= url . "?controller=Panel&action=modificarDatos" ?>">Modificar mis datos</a>
                        <a href="<?= url . "?controller=Panel&action=verPedidos" ?>">Ver pedidos</a>
                        <a href="<?= url . "?controller=Panel&action=desconectar" ?>">Desconectar</a>
                    </div>
                </div>
                <div class="col-9">
                    <p>cosas</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>