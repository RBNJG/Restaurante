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
    <link href="assets/css/carta.css" rel="stylesheet" type="text/css" media="screen">
    <title>Leroy Merlin</title>
</head>

<body>
    <div class="mt-3">
        <div class="container px-0">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text"><a href=<?= url . "?controller=Home" ?> class="text-migas">Home</a></li>
                    <li class="breadcrumb-item active text" aria-current="page">Carta</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="mt-3">
        <div class="container px-0 d-flex align-items-center fondo-carta">
            <h2 class="ms-4 text-white text-carta">Carta</h2>
        </div>
        <div class="container px-0 mt-3">
            <p class="text">Bienvenido a una experiencia culinaria donde la pasión por el hogar y el jardín se funde con la delicia de cada plato.
                Nuestra carta, inspirada en la esencia de Leroy Merlin, celebra la fusión entre bricolaje, sostenibilidad y gastronomía.
                Aquí, cada bocado es un reflejo de nuestra dedicación a la calidad, la frescura y el compromiso con el medio ambiente.
                Descubre sabores que, al igual que nuestros proyectos de hogar, están cuidadosamente diseñados para deleitar tus sentidos.
            </p>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-3 px-0 mb-5">
                <div class="d-flex align-items-center justify-content-between ps-2 pe-3 py-3 fondo-desplegable">
                    <h3 class="text-h2">Categorías</h4>
                        <hr class="linea-menos">
                </div>
                <div class="ps-2">
                    <?php
                    foreach ($categorias as $categoria) {
                    ?>
                        <div class="d-flex justify-content-start mt-2 align-items-center h-categoria">
                            <div class="img-categoria <?php if ($categoria->getNombre_categoria() == "Pescados" or $categoria->getNombre_categoria() == "Bebidas") {
                                                            echo 'img-categoria-left';
                                                        } ?>" style="background-image: url(<?= $categoria->getImagen() ?>);"></div>
                            <a href="#<?= $categoria->getNombre_categoria() ?>" class="text-categoria">
                                <h5 class="ps-2 mb-0 px-auto text text-categoria"> <?= $categoria->getNombre_categoria() ?></h5>
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <hr class="my-4 linea-filtros">
                <h2 class="text-filtro">Filtrar</h2>
                <div class="d-flex align-items-center justify-content-between ps-2 pe-3 mt-4 py-3 fondo-desplegable">
                    <h3 class="text-h2">Valoraciones de clientes</h4>
                        <hr class="linea-menos">
                </div>
                <form action=<?= url . "?controller=Carta&action=index" ?> method='post' class="d-flex flex-column">
                    <div class="ps-2">
                        <div class="d-flex justify-content-start align-items-baseline my-3">
                            <input type="checkbox" name="4estrellas" value="4" <?= $estrellas4 ? 'checked' : '' ?>>
                            <div class="d-flex align-items-center ms-3 me-2">
                                <img src="assets/images/carta/4_estrellas.svg" alt="" class="estrella">
                            </div>
                            <p class="mb-0 text">4 y más</p>
                            <p class="mb-0 ms-2 text color-hover">(<?php if ($productos == null) {
                                                    echo "0";
                                                } else {
                                                    echo Calculadora::countEstrellas($productos, 4);
                                                } ?>)</p>
                        </div>
                        <div class="d-flex justify-content-start align-items-baseline my-3">
                            <input type="checkbox" name="3estrellas" value="3" <?= $estrellas3 ? 'checked' : '' ?>>
                            <picture class="d-flex align-items-center ms-3 me-2">
                                <img src="assets/images/carta/3_estrellas.svg" alt="" class="estrella">
                            </picture>
                            <p class="mb-0 text">3 y más</p>
                            <p class="mb-0 ms-2 text color-hover">(<?php if ($productos == null) {
                                                    echo "0";
                                                } else {
                                                    echo Calculadora::countEstrellas($productos, 3);
                                                } ?>)</p>
                        </div>
                    </div>

                    <hr class="my-4 linea-filtros">
                    <div class="d-flex align-items-center justify-content-between ps-2 pe-3 py-3 fondo-desplegable">
                        <h3 class="text-h2">Precio</h4>
                            <hr class="linea-menos">
                    </div>
                    <div class="p-0 mb-3">
                        <div class="d-flex justify-content-start align-items-baseline ms-2 mt-3">
                            <div class="input-precio">
                                <input type="number" value="<?= htmlspecialchars($precioMin) ?>" min="1" max="100" maxlength="5" class="precio text" name="minimo">
                                <span class="text">€</span>
                            </div>
                            <p class="mb-0 mx-1 mx-md-3 text">-</p>
                            <div class="input-precio">
                                <input type="number" value="<?= htmlspecialchars($precioMax) ?>" min="1" max="100" maxlength="5" class="precio text" name="maximo">
                                <span class="text">€</span>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 linea-filtros">
                    <div class="d-flex justify-content-start align-items-baseline ms-3">
                        <div>
                            <input type="checkbox" name="envio" <?= $envio ? 'checked' : '' ?>>
                        </div>
                        <p class="ms-3 mb-0 text">Envío gratuito a domicilio</p>
                    </div>
                    <hr class="my-4 linea-filtros">
                    <div class="d-flex justify-content-start align-items-baseline ms-3">
                        <div>
                            <input type="checkbox" name="descuento" <?= $descuento ? 'checked' : '' ?>>
                        </div>
                        <p class="ms-3 mb-0 text">Productos en oferta</p>
                    </div>
                    <hr class="my-4 linea-filtros">

                    <input type="number" name="filtro" value="1" hidden>

                    <button type="submit" class="mt-4 align-self-center w-75 btn-compra text-h2">Aplicar</button>
                    <a href="<?= url . "?controller=Carta" ?>" class="mt-3 align-self-center text">Restablecer</a>
                </form>
            </div>
            <div class="col-9 ps-5 pe-0 mt-2 mb-5">
                <div class="row">
                    <div class="d-flex justify-content-start align-items-center">
                        <p class="my-0 text"><b><?php if ($productos == null) {
                                                    echo "0";
                                                } else {
                                                    echo count($productos);
                                                }  ?></b> producto(s) ordenado(s) por</p>
                        <select name="" id="" class="ms-3 text select-filtro">
                            <option value="menos_mas">Precio: de menor a mayor</option>
                            <option value="mas_menos">Precio: de mayor a menor</option>
                            <option value="vendidos">Los más vendidos</option>
                        </select>
                        <picture>
                            <img src="assets/images/carta/info.svg" alt="info" class="ms-3">
                        </picture>
                    </div>
                </div>
                <?php
                $contador = 0;
                $categoriaActual = "";
                if ($productos == null) {
                ?>
                    <h2 class="mt-3 text-h2">Ningún producto cumple los requisitos</h2>
                    <?php
                } else {
                    foreach ($productos as $producto) {
                        if ($categoriaActual != $producto->getCategoria_id()) {;
                            if ($categoriaActual != "") {
                    ?>
            </div>
        <?php
                            }
                            $categoriaActual = $producto->getCategoria_id();
                            $categoria = CategoriaDAO::getCategoryName($categoriaActual);
        ?>
        <div class="row mt-4" id="<?= $categoria ?>">
            <div class="col-12">
                <h3 class="text-h2"><?= $categoria ?></h3>
            </div>
        </div>
        <div class="row mt-2 mb-2">
        <?php
                        }
        ?>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="h-carta">
                <div class="h-100">
                    <div class="img-carta" style="background-image: url(<?= $producto->getImagen() ?>);"></div>
                    <div class="d-flex flex-column justify-content-between h-texto-carta">
                        <div class="">
                            <p class="mb-0 text subrayado"><?= $producto->getNombre_producto() ?></p>
                            <div class="d-flex justify-content-start align-items-center mb-3">
                                <picture>
                                    <img src="<?php if ($producto->getEstrellas() == 3) {
                                                    echo 'assets/images/carta/3_estrellas.svg';
                                                } else if ($producto->getEstrellas() == 4) {
                                                    echo 'assets/images/carta/4_estrellas.svg';
                                                } else if ($producto->getEstrellas() == 0) {
                                                    echo 'assets/images/carta/0_estrellas.svg';
                                                } ?>" alt="calificación" class="pt-0 estrella">
                                </picture>
                                <p class="mb-0 mt-1 ms-2 text-opiniones"><?= $producto->getOpiniones() ?> opiniones</p>
                            </div>
                            <?php if ($producto->getCoste_base() == $precio) { ?>
                                <picture class="w-100">
                                    <img src="assets/images/carta/precio_mas_bajo.svg" alt="precio más bajo" class="mb-2 precio-bajo">
                                </picture>
                            <?php
                            }
                            if ($producto->getDescuento() == 0) {
                            ?>
                                <p class="text-precio"><?= $producto->getCoste_base() ?> €</p>
                            <?php
                            } else {
                            ?>
                                <div class="d-flex align-items-center justify-content-center mb-2 cartel-descuento">
                                    <p class="mb-0 text text-cartel-descuento"><?php echo '- ' . number_format(round($producto->getCoste_base() - ($producto->getCoste_base() * $producto->getDescuento()), 2), 2) ?> €</p>
                                </div>
                                <div class="mb-1">
                                    <p class="mb-0 text text-precio-tachado"><?= $producto->getCoste_base() ?> €</p>
                                </div>
                                <div class="mb-1">
                                    <p class="mb-0 text text-precio color-descuento"><?php echo number_format(round($producto->getCoste_base() * $producto->getDescuento(), 2), 2) ?> €</p>
                                </div>
                            <?php
                            }
                            if ($producto->getEnvio_gratis() == true) {
                            ?>
                                <div class="d-flex justify-content-start align-items-center">
                                    <picture>
                                        <img src="assets/images/carta/tick_envio.svg" alt="envío gratis">
                                    </picture>
                                    <p class="mb-0 ms-1 mt-1 text-envio-gratis">Envío gratis</p>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="">
                            <form action=<?= url . "?controller=Carta&action=anadir" ?> method='post'>
                                <input name="producto_id" value="<?= $producto->getProducto_id() ?>" hidden />
                                <button class="btn-anadir-carrito" type="submit">Añadir al carrito</button>
                            </form>
                            <hr class="w-100 mb-0 mt-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
                    }
                }
?>
        </div>
        </div>
    </div>
    </div>
</body>

</html>