<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Información del pedido">
    <meta name="keywords" content="Paraules clau">
    <meta name="author" content="Autor">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/full_estil.css" rel="stylesheet" type="text/css" media="screen">
    <title>Leroy Merlin</title>
</head>

<body>
    <section class="rellenar">
        <div class="container">
            <div class="mb-4 grupo-panel fondo-blanco">
                <div>
                    <h1 class="mb-3 text-h1">Detalles del pedido</h1>
                    <h2 class="text-h2">PEDIDO Nº <?= $pedido->getPedido_id() ?></p>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text"><b>Fecha : </b><?= $fecha->format("d/m/Y"); ?></p>
                            <p class="text"><b>Coste total : </b><?= $pedido->getCoste_total() ?> €</p>
                            <p class="text"><b>Estado : </b><?= $pedido->getEstado() ?></p>
                            <?php
                            if ($pedido->getDescuento_aplicado() != 0) {
                            ?>
                                <p class="text"><b>Descuento aplicado : </b><?= $pedido->getDescuento_aplicado() ?> €</p>
                            <?php
                            }
                            if ($pedido->getPropina() != 0) {
                            ?>
                                <p class="text"><b>Propina : </b><?= $pedido->getPropina() ?> €</p>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <hr class="align-self-center linea-panel">
                </div>
                <?php
                foreach ($detallesPedido as $detalle) {
                    $producto = ProductoDAO::getProduct($detalle->getProducto_id());
                ?>
                    <div class="d-flex justify-content-between">
                        <div class="align-self-center img-carrito" style="background-image: url(<?= $producto->getImagen() ?>);"></div>
                        <div class="w-100 px-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text"><b><?= $producto->getNombre_producto() ?></b></p>
                                <p class="text"><b>Cantidad : </b><?= $detalle->getCantidad_producto() ?></p>
                            </div>
                            <div class="me-3">
                                <p class="text"><b>Subtotal : </b><?= $detalle->getSubtotal() ?> €</p>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
    <script src="https://unpkg.com/notie"></script>
    <script src="assets/js/views/carrito.js"></script>
</body>

</html>