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
                    <div class="d-flex justify-content-center align-items-baseline">
                        <h2 id="media-estrellas" class="text-h2"></h2>
                        <p class="mb-0 text"> / 5</p>
                    </div>
                    <div class="d-flex justify-content-center mb-2 media-opiniones">
                        <img id="estrellas-opiniones" src="assets/images/carta/3_estrellas.svg" alt="">
                        <p id="total-opiniones" class="mb-0 ms-2 text"></p>
                    </div>
                    <div class="d-flex align-items-start flex-column">
                        <div class="w-100 d-flex justify-content-start align-items-center">
                            <div class="d-flex align-items-start me-3 5estrellas">
                                <img src="assets/images/carta/5_estrellas.svg" alt="">
                            </div>
                            <div class="me-3 barra-progreso">
                                <div id="barra-progreso-5" class="barra-progreso-llena"></div>
                            </div>
                            <p id="cantidad-opiniones-5" class="mb-0 text"></p>
                        </div>
                        <div class="w-100 d-flex justify-content-start align-items-center">
                            <div class="d-flex justify-content-start me-3 4estrellas">
                                <img src="assets/images/carta/4_estrellas.svg" alt="">
                            </div>
                            <div class="me-3 barra-progreso">
                                <div id="barra-progreso-4" class="barra-progreso-llena"></div>
                            </div>
                            <p id="cantidad-opiniones-4" class="mb-0 text"></p>
                        </div>
                        <div class="w-100 d-flex justify-content-start align-items-center">
                            <div class="d-flex align-items-center me-3 3estrellas">
                                <img src="assets/images/carta/3_estrellas.svg" alt="">
                            </div>
                            <div class="me-3 barra-progreso">
                                <div id="barra-progreso-3" class="barra-progreso-llena"></div>
                            </div>
                            <p id="cantidad-opiniones-3" class="mb-0 text"></p>
                        </div>
                        <div class="w-100 d-flex justify-content-start align-items-center">
                            <div class="d-flex align-items-center me-3 2estrellas">
                                <img src="assets/images/carta/2_estrellas.svg" alt="">
                            </div>
                            <div class="me-3 barra-progreso">
                                <div id="barra-progreso-2" class="barra-progreso-llena"></div>
                            </div>
                            <p id="cantidad-opiniones-2" class="mb-0 text"></p>
                        </div>
                        <div class="w-100 d-flex justify-content-start align-items-center">
                            <div class="d-flex align-items-center me-3 1estrella">
                                <img src="assets/images/carta/1_estrella.svg" alt="">
                            </div>
                            <div class="me-3 barra-progreso">
                                <div id="barra-progreso-1" class="barra-progreso-llena"></div>
                            </div>
                            <p id="cantidad-opiniones-1" class="mb-0 text"></p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="row mb-4">
                <div class="col-12 col-md-6 d-flex align-items-center">
                    <form action=<?= url . "?controller=API&action=api" ?> method='post'>
                        <input type="text" name="accion" value="buscar_pedido" id="" hidden>
                        <button id="filtrar" type="submit" class="d-flex justify-content-center align-items-center btn-compra text">Filtrar
                            <img src="assets/images/opiniones/filtro.svg" alt="" class="img-filtro">
                        </button>
                    </form>
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-end">
                    <div id="busqueda" class="d-flex align-items-center my-2 px-2 ms-2 buscador-header">
                        <form class="d-flex justify-content-between w-100" role="search">
                            <input class="w-100 buscador text" type="search" placeholder="Buscar por palabras clave" aria-label="Search">
                            <button type="submit" class="sin-estilo">
                                <img src="assets/images/header/lupa.svg" alt="">
                            </button>
                        </form>
                    </div>
                </div>
            </section>
            <section id="opiniones" class="container mb-4">
            </section>
            <div id="paginacion" class="mb-4">
                <div class="d-flex justify-content-center">
                    <picture>
                        <img id="paginaAnterior" src="assets/images/carta/izquierda.svg" alt="página anterior">
                    </picture>
                    <select id="selectPagina" class="mx-3 text select-pagina">
                    </select>
                    <picture>
                        <img id="paginaSiguiente" src="assets/images/carta/derecha.svg" alt="página siguiente">
                    </picture>
                </div>
            </div>
        </div>
    </main>
    <script>
        //Función para obtener la información de las opiniones en JSON
        function cargarOpiniones() {
            fetch('http://www.leroymerlin.com/Controller/APIController.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'accion=buscar_opiniones'
                })
                .then(response => response.json())
                .then(opiniones => {
                    let paginas = paginarOpiniones(opiniones, 1);
                    informacionOpiniones(opiniones);
                    mostrarOpiniones(paginas[0]);
                    agregarControlesPaginacion(paginas);
                    estiloPaginacion(0, paginas.length);
                })
                .catch(error => console.error('Error:', error));
        }

        //Función para contruir el HTML de cada opinión con sus datos
        function mostrarOpiniones(opiniones) {
            const contenedorOpiniones = document.getElementById('opiniones');
            contenedorOpiniones.innerHTML = '';

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

        //Función para mostrar datos de las opiniones en pantalla
        function informacionOpiniones(opiniones) {
            //Mostramos el total de opiniones
            let totalOpiniones = document.getElementById('total-opiniones');
            totalOpiniones.innerHTML = opiniones.length + " opiniones";

            //Guardamos la cantidad de opiniones por estrella
            let notaTotal = 0;
            let cantidadPorEstrellas = {
                1: 0,
                2: 0,
                3: 0,
                4: 0,
                5: 0
            };
            opiniones.forEach(opinion => {
                notaTotal += opinion.estrellas;
                cantidadPorEstrellas[opinion.estrellas]++;
            });

            //Mostramos la nota media de las opiniones
            let notaMedia = (notaTotal / opiniones.length).toFixed(1);
            let mediaEstrellas = document.getElementById('media-estrellas');
            mediaEstrellas.innerHTML = notaMedia + " ";

            let imagenEstrellas = document.getElementById('estrellas-opiniones');

            //Según la nota media mostramos una imagen u otra
            if (notaMedia >= 1 && notaMedia <= 1.9) {
                imagenEstrellas.src = 'assets/images/carta/1_estrella.svg';
            } else if (notaMedia >= 2 && notaMedia <= 2.9) {
                imagenEstrellas.src = 'assets/images/carta/2_estrellas.svg';
            } else if (notaMedia >= 3 && notaMedia <= 3.4) {
                imagenEstrellas.src = 'assets/images/carta/3_estrellas.svg';
            } else if (notaMedia >= 3.5 && notaMedia <= 3.9) {
                imagenEstrellas.src = 'assets/images/opiniones/3_5_estrellas.svg';
            } else if (notaMedia >= 4 && notaMedia <= 4.4) {
                imagenEstrellas.src = 'assets/images/carta/4_estrellas.svg';
            } else if (notaMedia >= 4.5 && notaMedia <= 4.9) {
                imagenEstrellas.src = 'assets/images/opiniones/4_5_estrellas.svg';
            } else if (notaMedia >= 5) {
                imagenEstrellas.src = 'assets/images/carta/5_estrellas.svg';
            }

            //Mostramos la cantidad de opiniones por cada estrella y damos estilo a la barra
            for (let estrellas = 1; estrellas <= 5; estrellas++) {
                let cantidadOpiniones = document.getElementById(`cantidad-opiniones-${estrellas}`);
                cantidadOpiniones.innerHTML = cantidadPorEstrellas[estrellas];

                let porcentaje = (cantidadPorEstrellas[estrellas] / opiniones.length) * 100;
                let barraProgreso = document.getElementById(`barra-progreso-${estrellas}`);
                barraProgreso.style.width = porcentaje + '%';
            }
        }

        //Función para mostrar la imagen de estrellas según la nota del usuario
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

        //Función para dar formato a la fecha en la que se hizo la opinión
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

        //Función para manejar los botones y los valores de util_si / util_no
        function incrementarContador(opinion_id, tipo) {
            let botonSiUtil = document.getElementById(`si_util_${opinion_id}`);
            let botonNoUtil = document.getElementById(`no_util_${opinion_id}`);

            //Incrementamos el valor del botón presionado
            if (tipo === 'si') {
                let contadorActual = parseInt(botonSiUtil.textContent.match(/\d+/)[0]);
                botonSiUtil.textContent = `Sí (${contadorActual + 1})`;
            } else if (tipo === 'no') {
                let contadorActual = parseInt(botonNoUtil.textContent.match(/\d+/)[0]);
                botonNoUtil.textContent = `No (${contadorActual + 1})`;
            }

            //Después de presionar un botón deshabilitamos las dos opciones
            botonSiUtil.disabled = true;
            botonNoUtil.disabled = true;
            botonSiUtil.classList.add('boton-deshabilitado');
            botonNoUtil.classList.add('boton-deshabilitado');

            //Preparamos los datos que enviaremos a la API
            let datos = new URLSearchParams({
                accion: "sumar_util",
                opinion_id: opinion_id,
                tipo: tipo
            }).toString();

            //Método de envío
            let opciones = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: datos
            };

            //Enviamos la solicitud al servidor para guardar los cambios
            fetch('http://www.leroymerlin.com/Controller/APIController.php', opciones)
                .then(response => response.json())
                .then(data => {
                    console.log('Respuesta del servidor:', data);
                })
                .catch(error => {
                    console.error('Error al enviar datos:', error);
                });
        }

        //Función para separar las opiniones en grupos para mostrar con paginación
        function paginarOpiniones(opiniones, opinionesPorPagina) {
            let paginas = [];
            for (let i = 0; i < opiniones.length; i += opinionesPorPagina) {
                let segmento = opiniones.slice(i, i + opinionesPorPagina);
                paginas.push(segmento);
            }
            return paginas;
        }

        //Función para controlar la paginación con los botones
        function agregarControlesPaginacion(paginas) {
            const selectPagina = document.getElementById('selectPagina');
            selectPagina.innerHTML = '';

            // Agregar opciones para cada página
            paginas.forEach((_, indice) => {
                let opcion = document.createElement('option');
                opcion.value = indice;
                opcion.textContent = `${indice + 1} de ${paginas.length}`;
                selectPagina.appendChild(opcion);
            });

            // Manejar cambio de página
            selectPagina.onchange = () => {
                let paginaSeleccionada = selectPagina.value;
                mostrarOpiniones(paginas[paginaSeleccionada]);
                estiloPaginacion(selectPagina.selectedIndex, paginas.length);
            };

            // Navegación de página
            document.getElementById('paginaAnterior').onclick = () => {
                if (selectPagina.selectedIndex > 0) {
                    selectPagina.selectedIndex--;
                    selectPagina.onchange();
                }

                estiloPaginacion(selectPagina.selectedIndex, paginas.length);
            };

            document.getElementById('paginaSiguiente').onclick = () => {
                if (selectPagina.selectedIndex < paginas.length - 1) {
                    selectPagina.selectedIndex++;
                    selectPagina.onchange();
                }

                estiloPaginacion(selectPagina.selectedIndex, paginas.length);
            };
        }

        //Función para cambiar la aparariencia de los botones de paginación según la página actual
        function estiloPaginacion(paginaActual, totalPaginas) {
            const botonAnterior = document.getElementById('paginaAnterior');
            const botonSiguiente = document.getElementById('paginaSiguiente');

            // Actualizar el estilo o clase del botón "Anterior"
            if (paginaActual === 0) {
                botonAnterior.classList.remove('btn-activado');
                botonAnterior.classList.add('btn-desactivado');
                botonAnterior.src = "assets/images/carta/izquierda.svg";
            } else {
                botonAnterior.classList.remove('btn-desactivado');
                botonAnterior.classList.add('btn-activado');
                botonAnterior.src = "assets/images/opiniones/boton_izquierda_activo.svg";
            }

            // Actualizar el estilo o clase del botón "Siguiente"
            if (paginaActual === totalPaginas - 1) {
                botonSiguiente.classList.remove('btn-activado');
                botonSiguiente.classList.add('btn-desactivado');
                botonSiguiente.src = "assets/images/carta/derecha.svg";
            } else {
                botonSiguiente.classList.remove('btn-desactivado');
                botonSiguiente.classList.add('btn-activado');
                botonSiguiente.src = "assets/images/opiniones/boton_derecha_activo.svg"
            }
        }
    </script>
</body>

</html>