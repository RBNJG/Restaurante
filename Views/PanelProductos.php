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
                                    <div class="d-flex justify-content-start align-items-center p-2 fondo-panel-seleccionado">
                                        <div class="comida-admin"></div>
                                        <div class="ms-2">
                                            <p class="mb-0 text text-panel-seleccionado">Gestionar productos</p>
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
                    <div class="mb-4 grupo-panel fondo-blanco">
                        <h2 class="mb-3 text text-h2">Nuevo producto</h2>
                        <form action=<?= url . "?controller=Panel&action=nuevoProducto" ?> method="post">
                            <input type="hidden" name="producto_id" value="">

                            <div class="w-50 me-3 mb-4 d-flex flex-column">
                                <label for="nombre" class="mb-1">
                                    <p class="me-1 mb-2 text text-password-big color-migas">Nombre producto</p>
                                </label>
                                <input type="text" name="nombre_producto" value="" class="p-3 input-password" required>
                            </div>

                            <div class="w-50 me-3 mb-4 d-flex flex-column">
                                <label for="nombre" class="mb-1">
                                    <p class="me-1 mb-2 text text-password-big color-migas">Descripción producto</p>
                                </label>
                                <textarea name="descripcion" class="p-3 input-password" rows="5" cols="50"></textarea>
                            </div>

                            <div class="w-50 me-3 mb-4 d-flex flex-column">
                                <label for="categoria" class="mb-1">
                                    <p class="me-1 mb-2 text text-password-big color-migas">Categoría</p>
                                </label>
                                <select name="categoria_id" class="text select-filtro">
                                    <?php foreach ($categorias as $categoria) { ?>
                                        <option value="<?= $categoria->getCategoria_id() ?>"> <?= $categoria->getNombre_categoria() ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="w-25 me-3 mb-4 d-flex flex-column">
                                <label for="coste_base" class="mb-1">
                                    <p class="me-1 mb-2 text text-password-big color-migas">Precio</p>
                                </label>
                                <input type="decimal" name="coste_base" value="" class="p-3 input-password" required>
                            </div>

                            <div class="w-25 me-3 mb-4 d-flex justify-content-start align-items-center">
                                <label for="envio_gratis" class="mb-1">
                                    <p class="me-1 mb-0 text text-password-big color-migas">Envío gratis</p>
                                </label>
                                <input type="checkbox" name="envio_gratis" value="1" class="ms-3 checkbox">
                            </div>

                            <div class="w-50 me-3 mb-4 d-flex flex-column">
                                <label for="imagen" class="mb-1">
                                    <p class="me-1 mb-2 text text-password-big color-migas">Ruta imagen</p>
                                </label>
                                <input type="text" name="imagen" value="" class="p-3 input-password" required>
                            </div>

                            <div class="w-100 d-flex justify-content-start">
                                <button type="submit" class="w-25 align-self-center mb-2 btn-compra">Crear producto</button>
                            </div>

                        </form>
                    </div>
                    <div class="mb-4 grupo-panel fondo-blanco">
                        <h2 class="mb-3 text text-h2">Listado de productos</h2>
                        <?php
                        $ultimo = end($productos);
                        foreach ($productos as $producto) {
                        ?>
                            <div class="d-flex justify-content-between">
                                <div class="d-flex justify-content-start align-items-center">
                                    <div class="align-self-center img-carrito" style="background-image: url(<?= $producto->getImagen() ?>);"></div>
                                    <p class="mb-0 ms-3 text bold"><?= $producto->getNombre_producto() ?></p>
                                </div>
                                <div class="d-flex flex-column justify-content-between">
                                    <form action=<?= url . "?controller=Panel&action=eliminarProducto" ?> method='post'>
                                        <div class="d-flex align-items-center me-4">
                                            <input name="producto_id" value="<?= $producto->getProducto_id() ?>" hidden>
                                            <button class="px-3 mb-3 mt-1 btn-eliminar" type="submit">Eliminar</button>
                                        </div>
                                    </form>
                                    <form action=<?= url . "?controller=Panel&action=modificarProducto" ?> method='post'>
                                        <div class="d-flex align-items-center me-4">
                                            <input name="producto_id" value="<?= $producto->getProducto_id() ?>" hidden>
                                            <button class="px-3 mb-1 btn-compra" type="submit">Modificar</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <?php
                            if ($producto !== $ultimo) {
                            ?>
                                <hr class="align-self-center linea-panel">
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>