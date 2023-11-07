<?php

$producto_id = $_POST['producto_id'];
$producto = ProductoDAO::getProduct($producto_id);
$categorias = CategoriaDAO::getAllCategories();


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
    <h2>Modificar <?= $producto->getNombre_producto() ?></h2>
    <br>
    <form action=<?= url . "?controller=Producto&action=guardarCambios" ?> method="post">
        <input type="hidden" name="producto_id" value="<?= $producto->getProducto_id() ?>">
        <label for="nombre_producto">Nombre producto: </label>
        <input type="text" name="nombre_producto" value="<?= $producto->getNombre_producto() ?>">
        <br><br>
        <label for="descripcion">Descripción producto: </label><br>
        <textarea name="descripcion" id="descripcion" rows="5" cols="50"><?= $producto->getDescripcion() ?></textarea>
        <br><br>
        <label for="categoria_id">Categoría: </label>
        <select name="categoria_id" id="categoria">
            <?php foreach ($categorias as $categoria) { ?>
                <option value="<?= $categoria->getCategoria_id() ?>"> <?= $categoria->getNombre_categoria() ?></option>
            <?php
            }
            ?>
        </select>
        <br><br>
        <label for="coste_base">Precio: </label>
        <input type="number" name="coste_base" value="<?= $producto->getCoste_base() ?>">
        <br><br>
        <input type="submit" value="Guardar cambios">

    </form>


</body>

</html>