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
        <div class="container pt-4">
            <div class="row">
                <div class="col-3">
                    <div class="mb-4 grupo-panel fondo-blanco">
                        <div class="d-flex justify-content-start align-items-center mb-3">
                            <div class="circulo-user"></div>
                            <div class="ms-3">
                                <p class="mb-0 text text-panel-user"><?= $usuario->getNombre() . " " . $usuario->getApellidos() ?></p>
                                <p class="mb-0 text"><?php switch ($usuario->getRol_id()) {
                                                            case 1:
                                                                echo 'Administrador';
                                                                break;
                                                            case 2:
                                                                echo 'Usuario';
                                                                break;
                                                            case 3:
                                                                echo 'Desarrollador';
                                                                break;
                                                        }  ?></p>
                            </div>
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <hr class="mb-0 align-self-center linea-panel">
                            <a href="<?= url . "?controller=Panel" ?>" class="text-menu">
                                <div class="d-flex justify-content-start align-items-center p-2 mb-3 fondo-panel-no-seleccionado">
                                    <div class="casa-user"></div>
                                    <div class="ms-2">
                                        <p class="mb-0 text">Inicio</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="d-flex flex-column">
                            <p class="ms-2 mb-0 text text-panel-seccion">Compras</p>
                            <hr class="mb-0 mt-2 align-self-center linea-panel">
                            <a href="<?= url . "?controller=Panel&action=verPedidos" ?>" class="text-menu">
                                <div class="d-flex justify-content-start align-items-center p-2 mb-3 fondo-panel-seleccionado">
                                    <div class="pedido-user"></div>
                                    <div class="ms-2">
                                        <p class="mb-0 text text-panel-seleccionado">Pedidos</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="d-flex flex-column">
                            <p class="ms-2 mb-0 text text-panel-seccion">Cuenta</p>
                            <hr class="mb-0 mt-2 align-self-center linea-panel">
                            <a href="<?= url . "?controller=Panel&action=modificarDatos" ?>" class="text-menu">
                                <div class="d-flex justify-content-start align-items-center p-2 fondo-panel-no-seleccionado">
                                    <div class="datos-user"></div>
                                    <div class="ms-2">
                                        <p class="mb-0 text">Información personal</p>
                                    </div>
                                </div>
                            </a>
                            <a href="<?= url . "?controller=Panel&action=desconectar" ?>" class="text-menu">
                                <div class="d-flex justify-content-start align-items-center p-2 mb-3 fondo-panel-no-seleccionado">
                                    <div class="desconectar-user"></div>
                                    <div class="ms-2">
                                        <p class="mb-0 text">Desconexión</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="mb-4 grupo-panel fondo-blanco">
                        <div>
                            <p class="text-h2">PEDIDO Nº <?= $pedido->getPedido_id() ?></p>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="text"><b>Fecha : </b><?= $fecha->format("d/m/Y"); ?></p>
                                    <p class="text"><b>Coste total : </b><?= $pedido->getCoste_total() ?> €</p>
                                    <p class="text"><b>Estado : </b><?= $pedido->getEstado() ?></p>
                                </div>
                                <div class="d-flex align-items-center me-4">
                                    <form action=<?= url . "?controller=Panel&action=repetirPedido" ?> method='post'>
                                        <input name="repetirpedido" value="<?= $pedido->getPedido_id() ?>" hidden>
                                        <button class="px-3 mb-3 btn-compra" type="submit">Repetir pedido</button>
                                    </form>
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
                                        <p class="text"><?= $producto->getNombre_producto() ?></p>
                                        <p class="text">Cantidad : <?= $detalle->getCantidad_producto() ?></p>
                                    </div>
                                    <div class="me-3">
                                        <p class="text">Subtotal : <?= $detalle->getSubtotal() ?> €</p>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>