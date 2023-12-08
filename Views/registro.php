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
    <div class="d-flex justify-content-center">
        <div class="w-50">
            <div class="d-flex flex-column align-items-center">
                <h2 class="text-h1">Crear una cuenta</h2>
                <hr class="linea-carrito">
            </div>
            <form action=<?= url . "?controller=Registro&action=registrarUsuario" ?> method="post">
                <div class="d-flex justify-content-between">
                    <div class="w-50 me-3 d-flex flex-column">
                        <label for="nombre">Nombre:</label><br>
                        <input type="text" id="nombre" name="nombre" class="input-password" required><br>
                    </div>

                    <div class="w-50 ms-3 d-flex flex-column">
                        <label for="apellidos">Apellidos:</label><br>
                        <input type="text" id="apellidos" name="apellidos" class="input-password" required><br>
                    </div>
                </div>

                <div class="d-flex justify-content-start">
                    <div class="w-50 pe-3 d-flex flex-column">
                        <label for="direccion">Dirección:</label><br>
                        <input type="text" id="direccion" name="direccion" class="input-password" required><br>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <div class="w-50 me-3 d-flex flex-column">
                        <label for="email">Email:</label><br>
                        <input type="email" id="email" name="email" value="<?= $_SESSION['mail'] ?>" class="input-password" required><br>
                    </div>

                    <div class="w-50 ms-3 d-flex flex-column">
                        <label for="telefono">Teléfono:</label><br>
                        <input type="tel" id="telefono" name="telefono" class="input-password" required><br>
                    </div>
                </div>

                <div class="d-flex justify-content-start">
                    <div class="w-50 pe-3 d-flex flex-column">
                        <label for="contrasena">Contraseña:</label><br>
                        <input type="password" id="contrasena" name="password" class="input-password" required><br>
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