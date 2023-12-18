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
                                    <div class="d-flex justify-content-start align-items-center p-2 mb-3 fondo-panel-seleccionado">
                                        <div class="pedido-user"></div>
                                        <div class="ms-2">
                                            <p class="mb-0 text text-panel-seleccionado">Gestionar pedidos</p>
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
                <div class="col-9">
                    <div class="mb-4 grupo-panel fondo-blanco">
                        <?php
                        $usuario = UsuarioDAO::getUser($pedido->getUsuario_id());
                        $fechaString = $pedido->getFecha();
                        $fecha = new DateTime($fechaString);
                        ?>
                        <div class="mb-4">
                            <form action=<?= url . "?controller=Panel&action=guardarCambiosPedido" ?> method='post'>
                                <p class="text-h2">PEDIDO Nº <?= $pedido->getPedido_id() ?></p>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="text"><b>Usuario : </b><?= $usuario->getNombre() . " " . $usuario->getApellidos() ?></p>
                                        <p class="text"><b>Fecha : </b><?= $fecha->format("d/m/Y") ?></p>
                                        <p class="text"><b>Coste envio : </b><?= Calculadora::costeEnvio($detallesPedido) ?> €</p>
                                        <p class="text"><b>Subtotal : </b><?= Calculadora::subtotal($detallesPedido) ?> €</p>
                                        <p class="text"><b>Coste total : </b><?= Calculadora::total($detallesPedido) ?> €</p>
                                        <div class="d-flex justify-content-start align-items-center">
                                            <p class="pt-2 text"><b>Estado : </b></p>
                                            <select name="estado" id="estado" class="ms-3 py-1 text select-filtro">
                                                <option value="En preparación" <?php echo ($pedido->getEstado() == 'En preparación') ? 'selected' : ''; ?>>En preparación</option>
                                                <option value="Enviado" <?php echo ($pedido->getEstado() == 'Enviado') ? 'selected' : ''; ?>>Enviado</option>
                                                <option value="Entregado" <?php echo ($pedido->getEstado() == 'Entregado') ? 'selected' : ''; ?>>Entregado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center me-4">
                                        <input name="coste" value="<?= Calculadora::total($detallesPedido) ?>" hidden>
                                        <input name="pedido" value="<?= $pedido->getPedido_id() ?>" hidden>
                                        <button class="px-3 mb-3 btn-compra" type="submit">Guardar cambios</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php
                        $ultimo = end($detallesPedido);
                        $pos = 0;
                        foreach ($detallesPedido as $detalle) {
                            $producto = ProductoDAO::getProduct($detalle->getProducto_id());
                        ?>
                            <div class="row">
                                <div class="d-flex justify-content-start w-100 ps-0 pe-2 altura-carrito">
                                    <div class="align-self-center img-carrito" style="background-image: url(<?= $producto->getImagen() ?>);"></div>
                                    <div class="w-100 d-flex flex-column justify-content-around">
                                        <div class="d-flex justify-content-between px-3">
                                            <p class="mb-0 text"><?= $producto->getNombre_producto() ?></p>
                                            <form action=<?= url . "?controller=Panel&action=eliminarProductoPedido" ?> method='post'>
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
                                                if ($detalle->getCantidad_producto() == 1) {
                                                ?>
                                                    <button id="" class="restar-off" disabled>
                                                        <picture class="d-flex align-items-center">
                                                            <img src="assets/images/carrito/menos.svg" alt="">
                                                        </picture>
                                                    </button>
                                                <?php
                                                } else {
                                                ?>
                                                    <form action=<?= url . "?controller=Panel&action=modificarCantidad" ?> method='post'>
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
                                                <input type="text" id="cantidad" class="mx-0 text" value="<?= $detalle->getCantidad_producto() ?>" readonly>
                                                <form action=<?= url . "?controller=Panel&action=modificarCantidad" ?> method='post'>
                                                    <input name="sumar" value="<?= $pos ?>" hidden />
                                                    <button class="sumar" type="submit">
                                                        <picture class="d-flex align-items-center">
                                                            <img src="assets/images/carrito/mas.svg" alt="">
                                                        </picture>
                                                    </button>
                                                </form>
                                            </div>
                                            <?php
                                            if ($producto->getDescuento() == 0) {
                                            ?>
                                                <p class="mb-0 text-cheque"><?= Calculadora::totalProducto($producto, $detalle->getCantidad_producto(), 0) ?> €</p>
                                            <?php
                                            } else {
                                            ?>
                                                <div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="d-flex align-items-center justify-content-center cartel-descuento">
                                                            <p class="mb-0 text-cartel-descuento">- <?= number_format(Calculadora::descuento($producto) * $detalle->getCantidad_producto(), 2) ?> €</p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-baseline">
                                                        <p class="mb-0 me-4 text text-precio-tachado-carrito"><?= Calculadora::totalProducto($producto, $detalle->getCantidad_producto(), 1) ?> €</p>
                                                        <p class="mb-0 text text-precio color-descuento"><?= Calculadora::totalProducto($producto, $detalle->getCantidad_producto(), 0) ?> €</p>
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
                            if ($detalle !== $ultimo) {
                            ?>
                                <hr class="align-self-center linea-panel">
                        <?php
                            }
                            $pos++;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>