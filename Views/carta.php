<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Página de restauración de Leroy Merlin">
    <meta name="keywords" content="Paraules clau">
    <meta name="author" content="Autor">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/full_estil.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/css/carta.css" rel="stylesheet" type="text/css" media="screen">
    <link href="node_modules/notie/dist/notie.css" rel="stylesheet">
    <link href="node_modules/notie/dist/notie.min.css" rel="stylesheet">
    <title>Leroy Merlin</title>
</head>

<body onload="cargarCarta()">
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
                <div role="button" id="desplegable-categorias" class="d-flex align-items-center justify-content-between ps-2 pe-3 py-3 fondo-desplegable">
                    <h3 class="text-h2">Categorías</h4>
                        <hr class="linea-menos">
                </div>
                <div id="categorias" class="ps-2">
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
                <div role="button" id="desplegable-valoraciones" class="d-flex align-items-center justify-content-between ps-2 pe-3 mt-4 py-3 fondo-desplegable">
                    <h3 class="text-h2">Valoraciones de clientes</h4>
                        <hr class="linea-menos">
                </div>
                <form action=<?= url . "?controller=Carta&action=index" ?> method='post' class="d-flex flex-column">
                    <div id="valoraciones" class="ps-2">
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
                    <div role="button" id="desplegable-precio" class="d-flex align-items-center justify-content-between ps-2 pe-3 py-3 fondo-desplegable">
                        <h3 class="text-h2">Precio</h4>
                            <hr class="linea-menos">
                    </div>
                    <div id="precio" class="p-0">
                        <div class="d-flex justify-content-start align-items-baseline ms-2 mt-3 mb-3">
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
            <div id="productos-carta" class="col-9 ps-5 pe-0 mt-2 mb-5">
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
            </div>
        </div>
    </div>
</body>
<script src="https://unpkg.com/notie"></script>
<script src="assets/js/views/carta.js"></script>

</html>