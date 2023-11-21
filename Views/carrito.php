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
    <div class="mt-3">
        <div class="container px-0">
            <h1 class="text-h1 mb-4">Carrito</h1>
            <hr class="linea-carrito">
        </div>
    </div>
    <div class="container">
        <?php
        if (count($_SESSION['carrito']) == 0) {
        ?>
            <div class="d-flex justify-content-center">
                <p class="text-h2">Todavía no tienes ningún producto en el carrito</p>
            </div>
        <?php
        } else {
        ?>
            <div class="row">
                <div class="col-9 px-0">
                    <h3 class="text-h3 mb-3">Vendido por LEROY MERLIN</h3>
                    <?php
                    foreach ($carrito as $producto) {
                    ?>
                        <div class="row">
                            <div class="d-flex justify-content-start w-100 px-0 altura-carrito">
                                <div class="align-self-center img-carrito" style="background-image: url(<?= $producto->getProducto()->getImagen() ?>);"></div>
                                <p>fsf</p>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-3 ps-4 mt-2">
                    <div class="d-flex justify-content-between align-items-center py-4 px-3 mb-3 cartel-cheque">
                        <h3 class="mb-0 text-cheque">Aplicar cheques club</h4>
                            <picture>
                                <img src="assets/icons/flecha_derecha.svg" alt="flecha" class="flecha">
                            </picture>
                    </div>
                    <hr class="w-100 mb-0 linea-carrito">
                    <div class="px-3 borde-fino">
                        <div class="d-flex justify-content-between pt-3">
                            <p class="mb-2">Subtotal</p>
                            <p class="mb-2">€</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Gastos de envío estimados</p>
                            <p>€</p>
                        </div>
                    </div>
                    <div class="py-2 px-3 fondo-gris">
                        <div class="d-flex justify-content-between">
                            <p>Total</p>
                            <p>€</p>
                        </div>
                        <p>Impuestos incluidos</p>
                        <button class="btn-compra">Continuar</button>
                        <p>Pago 100% seguro</p>
                        <picture>
                            <img src="assets/images/carrito/pago.svg" alt="métodos de pago">
                        </picture>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</body>

</html>