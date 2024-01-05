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
                                <div class="d-flex justify-content-start align-items-center p-2 fondo-panel-seleccionado">
                                    <div class="datos-user"></div>
                                    <div class="ms-2">
                                        <p class="mb-0 text text-panel-seleccionado">Información personal</p>
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
                    <div class="mb-4 p-4 grupo-panel fondo-blanco">
                        <form action=<?= url . "?controller=Panel&action=guardarCambios" ?> method="post">
                            <div class="d-flex justify-content-between mb-4">
                                <div class="w-50 me-3 d-flex flex-column">
                                    <label for="nombre" class="mb-1">
                                        <div class="d-flex align-items-center">
                                            <p class="me-1 mb-2 text text-password-big color-migas">Nombre</p>
                                            <p class="text mb-2 text-password-small color-hover">- Obligatorio</p>
                                        </div>
                                    </label>
                                    <input type="text" id="nombre" name="nombre" value="<?= UsuarioDAO::getUser($_SESSION['usuario_id'])->getNombre() ?>" class="p-3 input-password" required>
                                </div>

                                <div class="w-50 ms-3 d-flex flex-column">
                                    <label for="apellidos" class="mb-1">
                                        <div class="d-flex align-items-center">
                                            <p class="me-1 mb-2 text text-password-big color-migas">Apellidos</p>
                                            <p class="text mb-2 text-password-small color-hover">- Obligatorio</p>
                                        </div>
                                    </label>
                                    <input type="text" id="apellidos" name="apellidos" value="<?= UsuarioDAO::getUser($_SESSION['usuario_id'])->getApellidos() ?>" class="p-3 input-password" required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-start mb-4">
                                <div class="w-50 pe-3 d-flex flex-column">
                                    <label for="direccion" class="mb-1">
                                        <div class="d-flex align-items-center">
                                            <p class="me-1 mb-2 text text-password-big color-migas">Dirección</p>
                                            <p class="text mb-2 text-password-small color-hover">- Obligatorio</p>
                                        </div>
                                    </label>
                                    <input type="text" id="direccion" name="direccion" value="<?= UsuarioDAO::getUser($_SESSION['usuario_id'])->getDireccion() ?>" class="p-3 input-password" required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mb-4">
                                <div class="w-50 me-3 d-flex flex-column">
                                    <label for="email" class="mb-1">
                                        <div class="d-flex align-items-center">
                                            <p class="me-1 mb-2 text text-password-big color-migas">Email</p>
                                            <p class="text mb-2 text-password-small color-hover">- Obligatorio</p>
                                        </div>
                                    </label>
                                    <input type="email" id="email" name="email" value="<?= UsuarioDAO::getUser($_SESSION['usuario_id'])->getEmail() ?>" class="p-3 input-password" required>
                                </div>

                                <div class="w-50 ms-3 d-flex flex-column">
                                    <label for="telefono" class="mb-1">
                                        <div class="d-flex align-items-center">
                                            <p class="me-1 mb-2 text text-password-big color-migas">Teléfono</p>
                                            <p class="text mb-2 text-password-small color-hover">- Obligatorio</p>
                                        </div>
                                    </label>
                                    <input type="tel" id="telefono" name="telefono" value="<?= UsuarioDAO::getUser($_SESSION['usuario_id'])->getTelefono() ?>" class="p-3 input-password" required>
                                </div>
                            </div>

                            <div class="w-100 d-flex justify-content-center">
                                <button type="submit" class="w-50 align-self-center mb-2 btn-compra">Guardar cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>