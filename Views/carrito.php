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
                <div class="col-9 px-0 mb-5">
                    <h3 class="text-h3 mb-3">Vendido por LEROY MERLIN</h3>
                    <?php
                    $pos = 0;
                    foreach ($carrito as $producto) {
                    ?>
                        <div class="row">
                            <div class="d-flex justify-content-start w-100 ps-0 pe-2 altura-carrito">
                                <div class="align-self-center img-carrito" style="background-image: url(<?= $producto->getProducto()->getImagen() ?>);"></div>
                                <div class="w-100 d-flex flex-column justify-content-around">
                                    <div class="d-flex justify-content-between px-3">
                                        <p class="mb-0 text"><?= $producto->getProducto()->getNombre_producto() ?></p>
                                        <form action=<?= url . "?controller=Carrito&action=eliminar" ?> method='post'>
                                            <input name="pos_producto" value="<?= $pos ?>" hidden />
                                            <button type="submit" class="d-flex justify-content-center align-items-center contenedor-basura sin-estilo">
                                                <picture>
                                                    <img src="assets/images/carrito/basura.svg" alt="" class="img-basura">
                                                </picture>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="d-flex justify-content-between px-3">
                                        <div class="d-flex align-self-center altura-selector">
                                            <?php
                                            if ($producto->getCantidad() == 1) {
                                            ?>
                                                <button id="" class="restar-off" disabled>
                                                    <picture class="d-flex align-items-center">
                                                        <img src="assets/images/carrito/menos.svg" alt="">
                                                    </picture>
                                                </button>
                                            <?php
                                            } else {
                                            ?>
                                                <form action=<?= url . "?controller=Carrito&action=modificarCantidad" ?> method='post'>
                                                    <input name="restar" value="<?= $pos ?>" hidden />
                                                    <button class="restar" type="submit">
                                                        <picture class="d-flex align-items-center">
                                                            <img src="assets/images/carrito/menos.svg" alt="">
                                                        </picture>
                                                    </button>
                                                </form>
                                            <?php
                                            }
                                            ?>
                                            <input type="text" id="cantidad" class="mx-0 text" value="<?= $producto->getCantidad() ?>" readonly>
                                            <form action=<?= url . "?controller=Carrito&action=modificarCantidad" ?> method='post'>
                                                <input name="sumar" value="<?= $pos ?>" hidden />
                                                <button class="sumar" type="submit">
                                                    <picture class="d-flex align-items-center">
                                                        <img src="assets/images/carrito/mas.svg" alt="">
                                                    </picture>
                                                </button>
                                            </form>
                                        </div>
                                        <?php
                                        if ($producto->getProducto()->getDescuento() == 0) {
                                        ?>
                                            <p class="mb-0 text-cheque"><?= Calculadora::totalProducto($producto) ?> €</p>
                                        <?php
                                        } else {
                                        ?>
                                            <div>
                                                <div class="d-flex justify-content-end">
                                                    <div class="d-flex align-items-center justify-content-center cartel-descuento">
                                                        <p class="mb-0 text-cartel-descuento"><?php echo '- ' . round($producto->getProducto()->getCoste_base() - ($producto->getProducto()->getCoste_base() * $producto->getProducto()->getDescuento()), 2) ?> €</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-baseline">
                                                    <p class="mb-0 me-4 text text-precio-tachado-carrito"><?= $producto->getProducto()->getCoste_base() ?> €</p>
                                                    <p class="mb-0 text text-precio color-descuento"><?php echo number_format(round($producto->getProducto()->getCoste_base() * $producto->getProducto()->getDescuento(), 2), 2) ?> €</p>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        $pos++;
                    }
                    ?>
                </div>
                <div class="col-3 ps-4 mt-2 mb-5">
                    <div class="d-flex justify-content-between align-items-center py-4 px-3 mb-3 cartel-cheque">
                        <h3 class="mb-0 text-cheque">Aplicar cheques club</h4>
                            <picture>
                                <img src="assets/icons/flecha_derecha.svg" alt="flecha" class="flecha">
                            </picture>
                    </div>
                    <hr class="w-100 mb-0 linea-carrito">
                    <div class="px-3 borde-fino">
                        <div class="d-flex justify-content-between pt-3">
                            <p class="mb-2 text-cheque">Subtotal</p>
                            <p class="mb-2 text-cheque"><?= Calculadora::subtotal($carrito) ?> €</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="text">Gastos de envío estimados</p>
                            <p class="text"><?= Calculadora::costeEnvio($carrito) ?> €</p>
                        </div>
                    </div>
                    <div class="py-2 px-3 fondo-gris">
                        <div class="d-flex justify-content-between">
                            <p class="text-h2">Total</p>
                            <p class="text-h2"><?= Calculadora::total($carrito) ?> €</p>
                        </div>
                        <p class="text">Impuestos incluidos</p>
                        <button class="btn-compra mb-3">Continuar</button>
                        <p class="mb-2 text-pago">Pago 100% seguro</p>
                        <picture>
                            <img src="assets/images/carrito/pago.svg" alt="métodos de pago" class="mt-2 mb-3">
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