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
    <h1>Panel usuario</h1>
    <a href="">Modificar mis datos</a>
    <a href="">Ver pedidos</a>
    <a href="<?= url . "?controller=Panel&action=desconectar" ?>">Desconectar</a>

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
</body>

</html>