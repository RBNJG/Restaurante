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
            <section id="opiniones" class="container">

            </section>
        </div>
    </main>
    <script>
        function cargarOpiniones() {
            fetch('http://www.leroymerlin.com/Controller/APIController.php', {
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
            const contenedorOpiniones = document.getElementById('opiniones');

            opiniones.forEach(opinion => {
                const urlImagenEstrellas = obtenerImagenEstrellas(opinion.estrellas);
                const fecha = formatearFecha(opinion.fecha);

                const divRow = document.createElement('div');
                divRow.className = 'row mb-3 p-4 fondo-blanco borde';

                divRow.innerHTML = `
            <div class="col-3">
                <div class="d-flex flex-column">
                    <div class="d-flex justify-content-start align-items-center">
                        <div class="me-3 circulo-user-opiniones"></div>
                        <p class="mb-0 text bold">${opinion.nombre_usuario} ${opinion.apellidos_usuario}</p>
                    </div>
                    <p class="my-3 text text-fecha">Opinión publicada el <b>${fecha}</b></p>
                    <div class="d-flex justify-content-start align-items-center my-2">
                        <img src="assets/images/opiniones/verificado.svg" alt="" class="me-1 img-verificado">
                        <p class="mb-0 text text-verificado">Compra verificada</p>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="d-flex align-items-start flex-column ps-5 separador">
                    <div class="d-flex justify-content-start aling-items-center mb-2">
                        <img src="${urlImagenEstrellas}" alt="" class="img-estrellas">
                        <p class="ms-2 mb-0 text">${opinion.estrellas} / 5</p>
                    </div>
                    <div class="my-2">
                        <p class="text">${opinion.opinion}</p>
                    </div>
                    <p class="text text-util">¿Te ha parecido útil esta opinión?</p>
                    <div class="d-flex justify-content-start">
                        <button id="si_util_${opinion.opinion_id}" class="me-3 boton-opiniones" onclick="incrementarContador(${opinion.opinion_id}, 'si')">Sí (${opinion.util_si})</button>
                        <button id="no_util_${opinion.opinion_id}" class="boton-opiniones" onclick="incrementarContador(${opinion.opinion_id}, 'no')">No (${opinion.util_no})</button>
                    </div>
                </div>
            </div>
        `;

                contenedorOpiniones.appendChild(divRow);
            });
        }

        function obtenerImagenEstrellas(estrellas) {
            let imagen;
            switch (estrellas) {
                case 1:
                    imagen = 'assets/images/carta/1_estrella.svg';
                    break;
                case 2:
                    imagen = 'assets/images/carta/2_estrellas.svg';
                    break;
                case 3:
                    imagen = 'assets/images/carta/3_estrellas.svg';
                    break;
                case 4:
                    imagen = 'assets/images/carta/4_estrellas.svg';
                    break;
                case 5:
                    imagen = 'assets/images/carta/5_estrellas.svg';
                    break;
            }
            return imagen;
        }

        function formatearFecha(fecha) {
            let partesFecha = fecha.split('-');
            let fechaPartes = new Date(partesFecha[0], partesFecha[1] - 1, partesFecha[2]);

            let opciones = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };

            return new Intl.DateTimeFormat('es-ES', opciones).format(fechaPartes);
        }

        function incrementarUtil(opinion_id) {
            // Incrementar el contador
            let botonSiUtil = document.getElementById(`si_util_${opinion_id}`);
            let contadorActual = parseInt(botonSiUtil.textContent.match(/\d+/)[0]);
            botonSiUtil.textContent = `Sí (${contadorActual + 1})`;

            // Deshabilitar ambos botones
            botonSiUtil.disabled = true;
            let botonNoUtil = document.getElementById(`no_util_${opinion_id}`);
            botonNoUtil.disabled = true;

            // Aquí podrías agregar código para enviar este cambio al servidor, si es necesario
        }

        function incrementarContador(opinion_id, tipo) {
            let botonSiUtil = document.getElementById(`si_util_${opinion_id}`);
            let botonNoUtil = document.getElementById(`no_util_${opinion_id}`);

            // Incrementar el contador apropiado
            if (tipo === 'si') {
                let contadorActual = parseInt(botonSiUtil.textContent.match(/\d+/)[0]);
                botonSiUtil.textContent = `Sí (${contadorActual + 1})`;
            } else if (tipo === 'no') {
                let contadorActual = parseInt(botonNoUtil.textContent.match(/\d+/)[0]);
                botonNoUtil.textContent = `No (${contadorActual + 1})`;
            }

            // Deshabilitar ambos botones
            botonSiUtil.disabled = true;
            botonNoUtil.disabled = true;
            botonSiUtil.classList.add('boton-deshabilitado');
            botonNoUtil.classList.add('boton-deshabilitado');

            // Aquí podrías agregar código para enviar este cambio al servidor, si es necesario
        }
    </script>
</body>

</html>