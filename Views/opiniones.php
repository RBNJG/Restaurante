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
    <link href="assets/css/opiniones.css" rel="stylesheet" type="text/css" media="screen">
    <title>Leroy Merlin</title>
</head>

<body onload="cargarOpiniones()">
    <main class="fondo-resenyas rellenar">
        <div class="container">
            <section class="mt-3 mb-3">
                <h1 class="mb-4 text-h1">Opiniones</h1>
                <hr class="mb-4 linea-carrito">
                <p class="text">
                    Aquí puedes dejar tu opinión sobre nuestros productos o servicio.
                    Para poder escribir una opinión debes haber realizado un pedido cómo mínimo.
                </p>
            </section>
            <section class="d-flex justify-content-center mb-4 fondo-blanco borde">
                <div>
                    <div class="d-flex justify-content-center">
                        <h2 class="text-h2">4.8/5</h2>
                    </div>
                    <div class="d-flex justify-content-center mb-2 media-opiniones">
                        <img src="assets/images/carta/3_estrellas.svg" alt="">
                        <p class="mb-0 ms-2 text"><?php if ($opiniones == null) {
                                                        echo 0;
                                                    } else {
                                                        echo count($opiniones);
                                                    }; ?> opiniones</p>
                    </div>
                    <div class="d-flex align-items-start flex-column">
                        <div class="w-100 d-flex justify-content-start align-items-center">
                            <div class="d-flex align-items-start me-3 5estrellas">
                                <img src="assets/images/carta/3_estrellas.svg" alt="">
                            </div>
                            <div class="me-3 barra-progreso">
                                <div class="barra-progreso-llena" style="width:<?php if (OpinionesDAO::getOpinionesByStars(5) == null) {
                                                                                    echo 0;
                                                                                } else {
                                                                                    echo Calculadora::porcentajeOpiniones(count($opiniones), count(OpinionesDAO::getOpinionesByStars(5)));
                                                                                }  ?>%"></div>
                            </div>
                            <p class="mb-0 text">134</p>
                        </div>
                        <div class="w-100 d-flex justify-content-start align-items-center">
                            <div class="d-flex justify-content-start me-3 4estrellas">
                                <img src="assets/images/carta/3_estrellas.svg" alt="">
                            </div>
                            <div class="me-3 barra-progreso">
                                <div class="barra-progreso-llena" style="width:<?php if (OpinionesDAO::getOpinionesByStars(4) == null) {
                                                                                    echo 0;
                                                                                } else {
                                                                                    echo Calculadora::porcentajeOpiniones(count($opiniones), count(OpinionesDAO::getOpinionesByStars(4)));
                                                                                }  ?>%"></div>
                            </div>
                            <p class="mb-0 text">12</p>
                        </div>
                        <div class="w-100 d-flex justify-content-start align-items-center">
                            <div class="d-flex align-items-center me-3 3estrellas">
                                <img src="assets/images/carta/3_estrellas.svg" alt="">
                            </div>
                            <div class="me-3 barra-progreso">
                                <div class="barra-progreso-llena" style="width:<?php if (OpinionesDAO::getOpinionesByStars(3) == null) {
                                                                                    echo 0;
                                                                                } else {
                                                                                    echo Calculadora::porcentajeOpiniones(count($opiniones), count(OpinionesDAO::getOpinionesByStars(3)));
                                                                                }  ?>%"></div>
                            </div>
                            <p class="mb-0 text">1</p>
                        </div>
                        <div class="w-100 d-flex justify-content-start align-items-center">
                            <div class="d-flex align-items-center me-3 2estrellas">
                                <img src="assets/images/carta/3_estrellas.svg" alt="">
                            </div>
                            <div class="me-3 barra-progreso">
                                <div class="barra-progreso-llena" style="width:<?php if (OpinionesDAO::getOpinionesByStars(2) == null) {
                                                                                    echo 0;
                                                                                } else {
                                                                                    echo Calculadora::porcentajeOpiniones(count($opiniones), count(OpinionesDAO::getOpinionesByStars(2)));
                                                                                }  ?>%"></div>
                            </div>
                            <p class="mb-0 text">1</p>
                        </div>
                        <div class="w-100 d-flex justify-content-start align-items-center">
                            <div class="d-flex align-items-center me-3 1estrella">
                                <img src="assets/images/carta/3_estrellas.svg" alt="">
                            </div>
                            <div class="me-3 barra-progreso">
                                <div class="barra-progreso-llena" style="width:<?php if (OpinionesDAO::getOpinionesByStars(1) == null) {
                                                                                    echo 0;
                                                                                } else {
                                                                                    echo Calculadora::porcentajeOpiniones(count($opiniones), count(OpinionesDAO::getOpinionesByStars(1)));
                                                                                }  ?>%"></div>
                            </div>
                            <p class="mb-0 text">2</p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="row mb-4">
                <div class="col-12 col-md-6">
                    <form action=<?= url . "?controller=API&action=api" ?> method='post'>
                        <input type="text" name="accion" value="buscar_pedido" id="" hidden>
                        <button type="submit" class="d-flex justify-content-center align-items-center btn-compra text-h3">Filtrar
                            <img src="assets/images/opiniones/filtro.svg" alt="">
                        </button>
                    </form>
                </div>
                <div class="col-12 col-md-6">
                    <div class="d-flex align-items-center my-2 px-2 ms-2 buscador-header">
                        <form class="d-flex justify-content-between w-100" role="search">
                            <input class="w-100 buscador text" type="search" placeholder="Buscar un producto, una marca..." aria-label="Search">
                            <button type="submit" class="sin-estilo">
                                <img src="assets/images/header/lupa.svg" alt="">
                            </button>
                        </form>
                    </div>
                </div>
            </section>
            <section id="" class="container">
                <div class="row mb-3 p-4 fondo-blanco borde">
                    <div class="col-3">
                        <div class="d-flex align-items-start flex-column separador">
                            <div class="d-flex justify-content-start">
                                <div class="circulo-user-opiniones"></div>
                                <p>Nombre usuario</p>
                            </div>
                            <p>Opinión publicada el ....</p>
                            <div class="d-flex justify-content-start">
                                <img src="assets/images/header/opiniones.svg" alt="">
                                <p>Compra verificada</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="d-flex align-items-start flex-column">
                            <div class="d-flex justify-content-start aling-items-center mb-2">
                                <img src="assets/images/carta/4_estrellas.svg" alt="">
                                <p class="mb-0 text">4/5</p>
                            </div>
                            <div class="mb-2">
                                <p class="text">Opinión</p>
                            </div>
                            <p>¿Te ha parecido útil esta opinión?</p>
                            <div class="d-flex justify-content-start">
                                <button>Sí</button>
                                <button>No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <script>
        function cargarOpiniones() {
            fetch('http://www.leroymerlin.com/?controller=API&action=api', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'accion=buscar_opiniones'
                })
                .then(response => response.json())
                .then(opiniones => mostrarOpiniones(opiniones))
                .catch(error => console.error('Error:', error));
        }

        function mostrarOpiniones(opiniones) {
            var seccionOpiniones = document.getElementById('opiniones');
            seccionOpiniones.innerHTML = '';
            opiniones.forEach(function(opinion) {
                // Aquí construyes el HTML para cada opinión
                var div = document.createElement('div');
                div.className = 'mb-3 fondo-blanco borde';

                div.innerHTML = `<p>${opinion.opinion}</p>`;
                seccionOpiniones.appendChild(div);
            });
        }
    </script>
</body>

</html>