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
        <?php
        foreach ($pedidosUser as $pedido) {
        ?>
            <form action=<?= url . "?controller=Panel&action=detallePedido" ?> method='post'>
                <p>Fecha : <?= $pedido->getFecha() ?></p>
                <p>Coste total : <?= $pedido->getCoste_total() ?> €</p>
                <p>Estado : <?= $pedido->getEstado() ?></p>
                <input name="pedido" value="<?= $pedido->getPedido_id() ?>" hidden>
                <button class="btn-compra mb-3" type="submit">Ver detalles</button>
            </form>
        <?php
        }
        ?>
    </div>
</body>

</html>