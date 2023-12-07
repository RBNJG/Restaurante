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
    <div class="container-flex fondo-panel">
        <div class="container pt-4">
            <div class="row">
                <div class="col-3">
                    <div class="mb-4 grupo-panel fondo-blanco">
                        <div class="d-flex justify-content-start align-items-center mb-3">
                            <div class="circulo-user"></div>
                            <div class="ms-3">
                                <p class="mb-0 text text-panel-user"><?= $usuario->getNombre() . " " . $usuario->getApellidos() ?></p>
                                <p class="mb-0 text"><?php switch($usuario->getRol_id()){case 1: echo 'Administrador'; break; case 2: echo 'Usuario'; break; case 3: echo 'Desarrollador'; break;}  ?></p>
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
                                <div class="d-flex justify-content-start align-items-center p-2 mb-3 fondo-panel-no-seleccionado">
                                    <div class="pedido-user"></div>
                                    <div class="ms-2">
                                        <p class="mb-0 text">Pedidos</p>
                                    </div>
                                </div>
                            </a>
                        </div>
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
                    <form action=<?= url . "?controller=Panel&action=guardarCambios" ?> method="post">
                        <label for="nombre">Nombre:</label><br>
                        <input type="text" id="nombre" name="nombre" value="<?= UsuarioDAO::getUser($_SESSION['usuario_id'])->getNombre() ?>" required><br>

                        <label for="apellidos">Apellidos:</label><br>
                        <input type="text" id="apellidos" name="apellidos" value="<?= UsuarioDAO::getUser($_SESSION['usuario_id'])->getApellidos() ?>" required><br>

                        <label for="direccion">Dirección:</label><br>
                        <input type="text" id="direccion" name="direccion" value="<?= UsuarioDAO::getUser($_SESSION['usuario_id'])->getDireccion() ?>" required><br>

                        <label for="email">Email:</label><br>
                        <input type="email" id="email" name="email" value="<?= UsuarioDAO::getUser($_SESSION['usuario_id'])->getEmail() ?>" required><br>

                        <label for="telefono">Teléfono:</label><br>
                        <input type="tel" id="telefono" name="telefono" value="<?= UsuarioDAO::getUser($_SESSION['usuario_id'])->getTelefono() ?>" required><br>

                        <input type="submit" value="Guardar cambios">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>