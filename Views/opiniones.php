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
    <link href="assets/css/carta.css" rel="stylesheet" type="text/css" media="screen">
    <link href="node_modules/notie/dist/notie.css" rel="stylesheet">
    <link href="node_modules/notie/dist/notie.min.css" rel="stylesheet">
    <title>Leroy Merlin</title>
</head>

<body onload="obtenerUsuario();cargarOpiniones()">
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
            <section>
                <div class="d-flex justify-content-center">
                    <button id="nueva-opinion" class="mb-4 btn-compra text text-h3">Nueva opinión</button>
                </div>
                <div id="formulario-opinion" class="p-4 formulario-opiniones fondo-blanco borde">
                    <form action="">
                        <div class="d-flex align-items-center mb-3">
                            <label for="" class="me-3 text-h3">Pedido</label>
                            <select name="lista-pedidos" id="lista-pedidos" class="text select-filtro"></select>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <label for="" class="me-2 text-h3">Puntuación</label>
                            <div id="estrellas" class="d-flex estrella-selector">
                                <span class="estrella-opinion" data-valor="1"></span>
                                <span class="estrella-opinion" data-valor="2"></span>
                                <span class="estrella-opinion" data-valor="3"></span>
                                <span class="estrella-opinion" data-valor="4"></span>
                                <span class="estrella-opinion" data-valor="5"></span>
                            </div>
                        </div>
                        <div class="d-flex flex-column mb-3">
                            <label for="" class="mb-2 text-h3">Opinión</label>
                            <textarea name="" id="opinion" cols="30" rows="10" class="p-2 text espacio-comentario"></textarea>
                        </div>

                        <button id="guardar-opinion" class="btn-compra text-h3">Guardar</button>
                    </form>
                </div>
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
                        <div class="w-100 d-flex justify-content-start align-items-center opiniones-naranja">
                            <div class="d-flex align-items-start me-3 5estrellas">
                                <img src="assets/images/carta/5_estrellas.svg" alt="">
                            </div>
                            <div class="me-3 barra-progreso">
                                <div id="barra-progreso-5" class="barra-progreso-llena"></div>
                            </div>
                            <p id="cantidad-opiniones-5" class="mb-0 text"></p>
                        </div>
                        <div class="w-100 d-flex justify-content-start align-items-center opiniones-naranja">
                            <div class="d-flex justify-content-start me-3 4estrellas">
                                <img src="assets/images/carta/4_estrellas.svg" alt="">
                            </div>
                            <div class="me-3 barra-progreso">
                                <div id="barra-progreso-4" class="barra-progreso-llena"></div>
                            </div>
                            <p id="cantidad-opiniones-4" class="mb-0 text"></p>
                        </div>
                        <div class="w-100 d-flex justify-content-start align-items-center opiniones-naranja">
                            <div class="d-flex align-items-center me-3 3estrellas">
                                <img src="assets/images/carta/3_estrellas.svg" alt="">
                            </div>
                            <div class="me-3 barra-progreso">
                                <div id="barra-progreso-3" class="barra-progreso-llena"></div>
                            </div>
                            <p id="cantidad-opiniones-3" class="mb-0 text"></p>
                        </div>
                        <div class="w-100 d-flex justify-content-start align-items-center opiniones-naranja">
                            <div class="d-flex align-items-center me-3 2estrellas">
                                <img src="assets/images/carta/2_estrellas.svg" alt="">
                            </div>
                            <div class="me-3 barra-progreso">
                                <div id="barra-progreso-2" class="barra-progreso-llena"></div>
                            </div>
                            <p id="cantidad-opiniones-2" class="mb-0 text"></p>
                        </div>
                        <div class="w-100 d-flex justify-content-start align-items-center opiniones-naranja">
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
                <div class="col-3 col-md-6 d-flex align-items-center">
                    <div>
                        <button id="filtrar" type="submit" class="d-flex justify-content-center align-items-center btn-compra text">Filtrar
                            <img src="assets/images/opiniones/filtro.svg" alt="" class="img-filtro">
                        </button>
                    </div>
                </div>
                <div class="col-9 col-md-6 d-flex justify-content-end">
                    <div id="busqueda" class="d-flex align-items-center my-2 px-2 ms-2 buscador-header">
                        <form id="buscador" class="d-flex justify-content-between w-100" role="search">
                            <input id="texto-buscador" class="w-100 buscador text" type="search" placeholder="Buscar por palabras clave" aria-label="Search">
                            <button id="buscar" type="submit" class="sin-estilo">
                                <img src="assets/images/header/lupa.svg" alt="">
                            </button>
                        </form>
                    </div>
                </div>
            </section>
            <div id="panelFiltros" class="panel-filtros">
                <div class="container mt-3">
                    <div class="d-flex justify-content-between mx-2">
                        <div class="d-flex justify-content-start align-items-center">
                            <img src="assets/images/opiniones/filtro_gris.svg" alt="" class="">
                            <h3 class="ms-2 mb-0 text text-h3 color-hover">Filtrar</h3>
                        </div>
                        <button id="cerrar-filtros" class="sin-estilo">
                            <img src="assets/images/opiniones/cerrar.svg" alt="">
                        </button>
                    </div>
                </div>
                <hr class="linea-filtros-opiniones">
                <div class="container mt-3">
                    <div class="d-flex flex-column">
                        <div class="mx-2">
                            <form action="">
                                <fieldset class="mb-3">
                                    <p class="text bold">Ordenar por:</p>
                                    <select name="" id="select-order" class="text select-filtro">
                                        <option value="mas_reciente">Las más reciente</option>
                                        <option value="mas_antigua">Las más antiguas</option>
                                        <option value="mas_valorada">Las mejor valoradas</option>
                                        <option value="menos_valorada">Las peor valoradas</option>
                                    </select>
                                </fieldset>
                                <fieldset>
                                    <p class="text bold">Notas</p>
                                    <div class="d-flex justify-content-start align-items-baseline my-3">
                                        <input type="checkbox" name="5estrellas" value="5">
                                        <div class="d-flex align-items-center ms-3 me-2">
                                            <img src="assets/images/carta/5_estrellas.svg" alt="" class="">
                                        </div>
                                        <p class="mb-0 text">5 estrellas</p>
                                    </div>
                                    <div class="d-flex justify-content-start align-items-baseline my-3">
                                        <input type="checkbox" name="4estrellas" value="4">
                                        <picture class="d-flex align-items-center ms-3 me-2">
                                            <img src="assets/images/carta/4_estrellas.svg" alt="" class="">
                                        </picture>
                                        <p class="mb-0 text">4 estrellas</p>
                                    </div>
                                    <div class="d-flex justify-content-start align-items-baseline my-3">
                                        <input type="checkbox" name="3estrellas" value="3">
                                        <picture class="d-flex align-items-center ms-3 me-2">
                                            <img src="assets/images/carta/3_estrellas.svg" alt="" class="">
                                        </picture>
                                        <p class="mb-0 text">3 estrellas</p>
                                    </div>
                                    <div class="d-flex justify-content-start align-items-baseline my-3">
                                        <input type="checkbox" name="2estrellas" value="2">
                                        <picture class="d-flex align-items-center ms-3 me-2">
                                            <img src="assets/images/carta/2_estrellas.svg" alt="" class="">
                                        </picture>
                                        <p class="mb-0 text">2 estrellas</p>
                                    </div>
                                    <div class="d-flex justify-content-start align-items-baseline my-3">
                                        <input type="checkbox" name="1estrella" value="1">
                                        <picture class="d-flex align-items-center ms-3 me-2">
                                            <img src="assets/images/carta/1_estrella.svg" alt="" class="">
                                        </picture>
                                        <p class="mb-0 text">1 estrella</p>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="mx-2 mt-5 d-flex justify-content-around">
                            <button id="aplicar-filtros" type="submit" class="btn-compra text">Filtrar</button>
                            <button id="borrar-todo" class="btn-anadir-carrito" type="submit">Borrar todo</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="fondoOscuro" class="fondo-oscuro"></div>
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
    <script src="https://unpkg.com/notie"></script>
    <script src="assets/js/views/opiniones.js"></script>
</body>

</html>