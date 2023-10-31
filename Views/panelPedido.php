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

    <?php
    foreach ($productos as $producto) {
        $categoria = CategoriaDAO::getCategoryName($producto->getCategoria_id());
    ?>
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h4 class="card-title"><?= $producto->getNombre_producto() ?></h4>
                <h5><?= $categoria ?></h5>
                <p class="card-text"><?= $producto->getDescripcion() ?></p>
                <h6><?= $producto->getCoste_base() ?> €</h6>
                <div class="d-inline-flex p-2 me-1">
                    <form action=<?= url . "?controller=Producto&action=modificar" ?> method='post'>
                        <input name="producto_id" value="<?= $producto->getProducto_id() ?>" hidden />
                        <button class="btn btn-primary" type="submit">Modificar</button>
                    </form>
                    <form action=<?= url . "?controller=Producto&action=eliminar" ?> method='post'>
                        <input name="producto_id" value="<?= $producto->getProducto_id() ?>" hidden />
                        <button class="btn btn-secondary" type="submit">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>

    <?php
    }
    ?>

</body>

</html>