<?php

$productos = ProductoDAO::getAllProducts();
$categorias = CategoriaDAO::getAllCategories();

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
            echo "<tr><td>" . $producto->getNombre_producto() . "</td><td>" . $categoria . "</td><td>" . $producto->getDescripcion() . "</td><td>" . $producto->getCoste_base() . " €</td>" ."<td><button onclick=''>Añadir</button></td>" . " " . "<td><button onclick=''>Eliminar</button></td></tr>";
        }
        ?>
    </table>
</body>

</html>