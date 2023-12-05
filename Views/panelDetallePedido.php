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
    <div>
        <h1>Panel usuario</h1>
        <a href="<?= url . "?controller=Panel&action=modificarDatos" ?>">Modificar mis datos</a>
        <a href="<?= url . "?controller=Panel&action=verPedidos" ?>">Ver pedidos</a>
        <a href="<?= url . "?controller=Panel&action=desconectar" ?>">Desconectar</a>
    </div>
    <div>
        <div>
            <p>Fecha : <?= $pedido->getFecha() ?></p>
            <p>Coste total : <?= $pedido->getCoste_total() ?> €</p>
            <p>Estado : <?= $pedido->getEstado() ?></p>
        </div>
        <form action=<?= url . "?controller=Panel&action=repetirPedido" ?> method='post'>
                <input name="repetirpedido" value="<?= $pedido->getPedido_id() ?>" hidden>
                <button class="mb-3" type="submit">Repetir pedido</button>
            </form>
        <?php
        foreach ($detallesPedido as $detalle) {
        ?>
            <div>
                <p>Producto : <?= ProductoDAO::getProduct($detalle->getProducto_id())->getNombre_producto() ?></p>
                <p>Cantidad : <?= $detalle->getCantidad_producto() ?></p>
                <p>Precio : <?= $detalle->getSubtotal() ?> €</p>
            </div>
        <?php
        }
        ?>
    </div>
</body>

</html>