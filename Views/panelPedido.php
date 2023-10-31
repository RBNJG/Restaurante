<?php

$productos = ProductoDAO::getAllProducts();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Productos</h2>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th></th>
            <th></th>
        </tr>
        <?php
        foreach ($productos as $producto) {
            $categoria = CategoriaDAO::getCategoryName($producto->getCategoria_id());
        ?>
            <tr>
                <td><?= $producto->getNombre_producto() ?></td>
                <td><?= $categoria ?></td>
                <td><?= $producto->getDescripcion() ?></td>
                <td><?= $producto->getCoste_base() ?> €</td>
                <td>
                    <form action=<?= url . "?controller=Producto&action=modificar" ?> method='post'>
                        <input name="producto_id" value="<?= $producto->getProducto_id() ?>" hidden />
                        <button class="bet-button w3-black w3-section" type="submit">Modificar</button>
                    </form>
                </td>
                <td>
                    <form action=<?= url . "?controller=Producto&action=eliminar" ?> method='post'>
                        <input name="producto_id" value="<?= $producto->getProducto_id() ?>" hidden />
                        <button class="bet-button w3-black w3-section" type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>