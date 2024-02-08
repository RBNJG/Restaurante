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
    <div class="container-flex fondo-panel">
        <div class="container pt-4">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-6">
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
                                                        }  ?></p>
                            </div>
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <hr class="mb-0 align-self-center linea-panel">
                            <a href="<?= url . "?controller=Panel" ?>" class="text-menu">
                                <div class="d-flex justify-content-start align-items-center p-2 mb-3 fondo-panel-seleccionado">
                                    <div class="casa-user"></div>
                                    <div class="ms-2">
                                        <p class="mb-0 text text-panel-seleccionado">Inicio</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                        if ($usuario->getRol_id() == 1) {
                        ?>
                            <div class="d-flex flex-column">
                                <p class="ms-2 mb-0 text text-panel-seccion">Gestión</p>
                                <hr class="mb-0 mt-2 align-self-center linea-panel">
                                <a href="<?= url . "?controller=Panel&action=listadoProductos" ?>" class="text-menu">
                                    <div class="d-flex justify-content-start align-items-center p-2 fondo-panel-no-seleccionado">
                                        <div class="comida-admin"></div>
                                        <div class="ms-2">
                                            <p class="mb-0 text">Gestionar productos</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="<?= url . "?controller=Panel&action=revisarPedidos" ?>" class="text-menu">
                                    <div class="d-flex justify-content-start align-items-center p-2 mb-3 fondo-panel-no-seleccionado">
                                        <div class="pedido-user"></div>
                                        <div class="ms-2">
                                            <p class="mb-0 text">Gestionar pedidos</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="d-flex flex-column">
                                <p class="ms-2 mb-0 text text-panel-seccion">Compras</p>
                                <hr class="mb-0 mt-2 align-self-center linea-panel">
                                <a href="<?= url . "?controller=Panel&action=verPedidos" ?>" class="text-menu">
                                    <div class="d-flex justify-content-start align-items-center p-2 mb-3 fondo-panel-no-seleccionado">
                                        <div class="pedido-user"></div>
                                        <div class="ms-2">
                                            <p class="mb-0 text">Pedidos</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php
                        }
                        ?>
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
                <div class="col-lg-9 col-md-8 col-6">
                    <?php
                    if ($usuario->getRol_id() == 2) {
                    ?>
                        <div class="mb-3 grupo-panel fondo-blanco">
                            <div class="d-flex justify-content-between">
                                <h2 class="text-h2">Puntos de fidelidad</h2>
                                <p class="me-2 mb-0 text-h2"><?= $usuario->getPuntos_fidelidad() ?></p>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="grupo-panel fondo-blanco">
                        <?php
                        if ($pedidosUser == null) {
                        ?>
                            <h2 class="text text-h2">Todavía no has realizado ningún pedido</h2>
                        <?php
                        } else {
                            $fechaString = $pedidosUser[0]->getFecha();
                            $fecha = new DateTime($fechaString);

                        ?>
                            <h2 class="text text-h2">Último pedido</h2>
                            <hr class="align-self-center linea-panel">
                            <div class="">
                                <form action=<?= url . "?controller=Panel&action=detallePedido" ?> method='post'>
                                    <p class="text-h2">PEDIDO Nº <?= $pedidosUser[0]->getPedido_id() ?></p>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="text"><b>Fecha : </b><?= $fecha->format("d/m/Y"); ?></p>
                                            <p class="text"><b>Coste total : </b><?= $pedidosUser[0]->getCoste_total() ?> €</p>
                                            <p class="text"><b>Estado : </b><?= $pedidosUser[0]->getEstado() ?></p>
                                            <?php
                                            if ($pedidosUser[0]->getDescuento_aplicado() != 0) {
                                            ?>
                                                <p class="text"><b>Descuento aplicado : </b><?= $pedidosUser[0]->getDescuento_aplicado() ?> €</p>
                                            <?php
                                            }
                                            if ($pedidosUser[0]->getPropina() != 0) {
                                            ?>
                                                <p class="text"><b>Propina : </b><?= $pedidosUser[0]->getPropina() ?> €</p>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="d-flex align-items-center me-4">
                                            <input name="pedido" value="<?= $pedidosUser[0]->getPedido_id() ?>" hidden>
                                            <button class="px-3 mb-3 btn-compra" type="submit">Ver detalles</button>
                                        </div>
                                    </div>
                                </form>
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