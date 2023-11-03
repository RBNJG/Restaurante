<?php

$productos = ProductoDAO::getAllProducts();

$contador = 0;

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
    <div class="row">
        <div class="col-3">
            <p>filtros</p>
        </div>
        <div class="col-9">
            <div class="row">
                <?php
                foreach ($productos as $producto) {
                    $categoria = CategoriaDAO::getCategoryName($producto->getCategoria_id());
                    if ($contador % 4 === 0 && $contador !== 0) {
                ?>
            </div>
            <div class="row">
            <?php
                        $contador = 0;
                    }
                    if ($contador == 0) {
            ?>
                <h3><?= $categoria ?></h3>
            <?php
                    }
            ?>
            <div class="col-md-3">
                <div class="card h-100" style="width: 18rem;">
                    <div class="foto_carta">
                        <img src="<?= $producto->getImagen() ?>" class="card-img-top" alt="<?= $producto->getNombre_producto() ?>">
                    </div>
                    <div class="card-body">
                        <h4 class="card-title"><?= $producto->getNombre_producto() ?></h4>
                        <h5><?= $categoria ?></h5>
                        <p class="card-text"><?= $producto->getDescripcion() ?></p>
                        <h6><?= $producto->getCoste_base() ?> €</h6>
                    </div>
                    <div class="d-flex justify-content-center align-items-end boton_comprar">
                        <div class="d-flex justify-content-around">
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
            </div>
        <?php
                    $contador++;
                }
        ?>
            </div>
        </div>

</body>

</html>