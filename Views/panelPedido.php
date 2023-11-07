<?php

$productos = ProductoDAO::getAllProducts();

$contador = 0;

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
        <div>
            <h2>Productos</h2>
            <div class="d-flex justify-content-around bg-primary">
                <div class="container col-3 bg-secondary">
                    <p>filtros</p>
                </div>
                <div class="container col-9 bg-success">

                    <?php
                    foreach ($productos as $producto) {
                        $categoria = CategoriaDAO::getCategoryName($producto->getCategoria_id());
                        if ($contador % 4 === 0 && $contador !== 0) {
                    ?>
                </div>
            <?php
                            $contador = 0;
                        }
                        if ($contador == 0) {
            ?>
                <h3><?= $categoria ?></h3>

                <div class="row row-cols-2 row-cols-md-4 g-4">
                <?php
                        }
                ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="h-50 d-inline-block">
                        <img src="<?= $producto->getImagen() ?>" class="card-img-top foto" alt="<?= $producto->getNombre_producto() ?>">
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
        </div>
</body>

</html>