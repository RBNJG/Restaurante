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
    <div class="mt-2 d-flex justify-content-center">
        <div class="w-50">
            <div class="mb-2 d-flex flex-column align-items-center">
                <h2 class="text-h1">Crear una cuenta</h2>
                <hr class="linea-carrito">
            </div>
            <form action=<?= url . "?controller=Registro&action=registrarUsuario" ?> method="post">
                <div class="d-flex justify-content-between mb-4">
                    <div class="w-50 me-3 d-flex flex-column">
                        <label for="nombre" class="mb-1">
                            <div class="d-flex align-items-center">
                                <p class="me-1 mb-2 text text-password-big color-migas">Nombre</p>
                                <p class="text mb-2 text-password-small color-hover">- Obligatorio</p>
                            </div>
                        </label>
                        <input type="text" id="nombre" name="nombre" class="p-3 input-password" required>
                    </div>

                    <div class="w-50 ms-3 d-flex flex-column">
                        <label for="apellidos" class="mb-1">
                            <div class="d-flex align-items-center">
                                <p class="me-1 mb-2 text text-password-big color-migas">Apellidos</p>
                                <p class="text mb-2 text-password-small color-hover">- Obligatorio</p>
                            </div>
                        </label>
                        <input type="text" id="apellidos" name="apellidos" class="p-3 input-password" required>
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
                        <input type="text" id="direccion" name="direccion" class="p-3 input-password" required>
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
                        <input type="email" id="email" name="email" value="<?= $_SESSION['mail'] ?>" class="p-3 input-password" required>
                    </div>

                    <div class="w-50 ms-3 d-flex flex-column">
                        <label for="telefono" class="mb-1">
                            <div class="d-flex align-items-center">
                                <p class="me-1 mb-2 text text-password-big color-migas">Teléfono</p>
                                <p class="text mb-2 text-password-small color-hover">- Obligatorio</p>
                            </div>
                        </label>
                        <input type="tel" id="telefono" name="telefono" class="p-3 input-password" required>
                    </div>
                </div>

                <div class="d-flex justify-content-start mb-5">
                    <div class="w-50 pe-3 d-flex flex-column">
                        <label for="contrasena" class="mb-1">
                            <div class="d-flex align-items-center">
                                <p class="me-1 mb-2 text text-password-big color-migas">Contraseña</p>
                                <p class="text mb-2 text-password-small color-hover">- Obligatorio</p>
                            </div>
                        </label>
                        <input type="password" id="contrasena" name="password" class="p-3 input-password" required>
                    </div>
                </div>

                <div class="w-100 d-flex justify-content-center">
                    <button type="submit" class="w-50 align-self-center mb-5 btn-compra">Continuar</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>