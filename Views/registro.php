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

    <form action=<?= url . "?controller=Registro&action=registrarUsuario" ?> method="post">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="apellidos">Apellidos:</label><br>
        <input type="text" id="apellidos" name="apellidos" required><br>

        <label for="direccion">Dirección:</label><br>
        <input type="text" id="direccion" name="direccion" required><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?= $_SESSION['mail'] ?>" required><br>

        <label for="telefono">Teléfono:</label><br>
        <input type="tel" id="telefono" name="telefono" required><br>

        <label for="contrasena">Contraseña:</label><br>
        <input type="password" id="contrasena" name="password" required><br>

        <input type="submit" value="Registrar">
    </form>

</body>

</html>