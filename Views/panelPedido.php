<?php

$productos = ProductoDAO::getAllProducts();
$categorias = CategoriaDAO::getAllCategories();

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
    <div class="mt-3">
        <div class="container px-0">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text"><a href=<?= url . "?controller=Home" ?>>Home</a></li>
                    <li class="breadcrumb-item active text" aria-current="page">Carta</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="mt-5 mb-3">
        <div class="container px-0 fondo-carta d-flex align-items-center">
            <h2 class="ms-4 text-white text-carta">Carta</h2>
        </div>
        <div class="container px-0 mt-3">
            <p>Bienvenido a una experiencia culinaria donde la pasión por el hogar y el jardín se funde con la delicia de cada plato.
                Nuestra carta, inspirada en la esencia de Leroy Merlin, celebra la fusión entre bricolaje, sostenibilidad y gastronomía.
                Aquí, cada bocado es un reflejo de nuestra dedicación a la calidad, la frescura y el compromiso con el medio ambiente.
                Descubre sabores que, al igual que nuestros proyectos de hogar, están cuidadosamente diseñados para deleitar tus sentidos.
            </p>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-3 px-0">
                <div class="d-flex align-items-center justify-content-between ps-2 pe-3">
                    <h3 class="text-h2">Categorías</h4>
                        <hr class="linea-menos">
                </div>
                <div class="ps-2">
                    <?php
                    foreach ($categorias as $categoria) {
                    ?>
                        <div class="d-flex justify-content-start mt-2 align-items-center h-categoria">
                            <div class="d-flex img-categoria <?php if ($categoria->getNombre_categoria() == "Pescados" or $categoria->getNombre_categoria() == "Bebidas") {
                                                                    echo 'img-categoria-left';
                                                                } ?>" style="background-image: url(<?= $categoria->getImagen() ?>)" ;></div>
                            <h5 class="ps-2 mb-0 px-auto text"> <?= $categoria->getNombre_categoria() ?></h5>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <hr class="mt-4 linea-filtros">
                <h2 class="text-h1">Filtrar</h2>
                <div class="d-flex align-items-center justify-content-between ps-2 pe-3 mt-4">
                    <h3 class="text-h2">Valoraciones de clientes</h4>
                        <hr class="linea-menos">
                </div>
            </div>
            <div class="col-9 ps-5 bg-secondary">
                <div class="d-flex justify-content-start align-items-center">
                    <p class="text"><b><?= count($productos) ?></b> producto(s) ordenado(s) por</p>
                    <select name="" id="" class="ms-3">
                        <option value="">Los más vendidos</option>
                        <option value="">Precio: de menor a mayor</option>
                        <option value="">Precio: de mayor a menor</option>
                    </select>
                </div>
            </div>
        </div>
    </div>





















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