<?php

$productos = ProductoDAO::getAllProducts();
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
    <main>
        <section class="mt-5 mb-5">
            <div class="container sombra">
                <div class="row">
                    <div class="col-4 d-flex flex-column align-items-center justify-content-center">
                        <img src="assets/images/home/Cartel carrousel.svg" alt="Cartel carrousel" class="my-3">
                        <p class="text-center my-4 text-carousel">Disfruta de nuestras terrazas en compañía</p>
                    </div>
                    <div class="col-8 px-0">
                        <picture class="">
                            <img src="assets/images/home/terraza_home.jpg" alt="terraza Leroy Merlin" class="img-fluid w-100">
                        </picture>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-5 mb-5">
            <div class="container px-0">
                <h2 class="mt-6 mb-4 pt-2 pb-2 text-center text-h2">Nuestras ofertas en carta</h2>
                <div class="row d-flex justify-content-between">
                    <div class="col-4 d-flex justify-content-start">
                        <a href="">
                            <picture>
                                <img src="assets/images/home/Ensaladas.png" alt="Oferta ensaladas" class="img-fluid">
                            </picture>
                        </a>
                    </div>
                    <div class="col-4 d-flex justify-content-center">
                        <a href="">
                            <picture>
                                <img src="assets/images/home/Pasta.png" alt="Spaghettis baratos" class="img-fluid">
                            </picture>
                        </a>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                        <a href="">
                            <picture>
                                <img src="assets/images/home/Oferta entrecot.png" alt="Oferta en brasa" class="img-fluid">
                            </picture>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-5 mb-5">
            <div class="container px-0 seccion-novedades">
                <div class="row py-5 p-novedades">
                    <div class="col-4 d-flex align-items-center ps-4 justify-content-start">
                        <picture>
                            <img src="assets/images/home/Nueva carta.png" alt="Nueva carta" class="img-fluid">
                        </picture>
                    </div>
                    <div class="col-3 ps-4 d-flex align-items-center">
                        <picture>
                            <img src="assets/images/home/Carta.png" alt="Carta" class="img-fluid">
                        </picture>
                    </div>
                    <div class="col-5 d-flex align-items-center">
                        <div class="d-flex align-items-center text-center fondo-blanco h-100 mr-3">
                            <div>
                                <h3 class="text-h2">¡Descrube nuestra nueva carta!</h3>
                                <p class="my-3 text">Nuestra nueva carta refleja la pasión que ponemos en cada rincón de tu hogar.
                                    ¿Listo para una experiencia culinaria única?
                                    ¡Ven y descubre sabores que te inspirarán a renovar no solo tu casa, sino también tu paladar!
                                </p>
                                <button class="mt-4 btn-g-w">Ver carta</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-5 mb-5">
            <div class="container px-0">
                <h2 class="mt-6 mb-3 text-center text-h2">Categorias</h2>
                <div class="row justify-content-center">
                        <div class="d-flex justify-content-center">
                            <button class="btn-c-h">Entrantes</button>
                            <button class="btn-c-h">Ensaladas</button>
                            <button class="btn-c-h">Arroces</button>
                            <button class="btn-c-h">Brasa</button>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="btn-c-h">Carnes</button>
                            <button class="btn-c-h">Pescados</button>
                            <button class="btn-c-h">Bebidas</button>
                            <button class="btn-c-h">Postres</button>
                        </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>