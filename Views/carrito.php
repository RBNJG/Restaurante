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
    <link href="assets/css/carrito.css" rel="stylesheet" type="text/css" media="screen">
    <link href="node_modules/notie/dist/notie.css" rel="stylesheet">
    <link href="node_modules/notie/dist/notie.min.css" rel="stylesheet">
    <title>Leroy Merlin</title>
</head>

<body onload="obtenerUsuario();cargarCarrito()">
    <div class="mt-3">
        <div class="container px-0">
            <h1 class="text-h1 mb-4">Carrito</h1>
            <hr class="linea-carrito">
        </div>
    </div>
    <section id="contenedor-carrito" class="container rellenar">
        <div class="row">
            <div id="productos-carrito" class="col-12 col-md-8 col-lg-9 px-0 mb-5">

            </div>
            <div id="pago" class="col-12 col-md-4 col-lg-3 ps-4 mt-2 mb-5" style="display: none;">
                <div id="aplicar-puntos" class="d-flex justify-content-between align-items-center py-4 px-3 cartel-cheque">
                    <h3 class="mb-0 text-cheque">Aplicar puntos fidelidad</h4>
                        <picture>
                            <img src="assets/icons/flecha_derecha.svg" alt="flecha" class="flecha">
                        </picture>
                </div>
                <div id="asignar-puntos" class="p-3 contenedor-puntos">
                    <div class="d-flex justify-content-between">
                        <p class="text">Puntos acumulados</p>
                        <p id="puntos-acumulados" class="text"></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="mb-1 text">Aplica tus puntos</p>
                        <input id="puntos-aplicados" type="number" min="0" value="0" class="ps-1 text input-puntos">
                    </div>
                </div>
                <hr class="w-100 mb-0 mt-4 linea-carrito">
                <div class="p-3 borde-fino">
                    <div class="d-flex justify-content-between">
                        <p class="mb-0 text-cheque">Subtotal</p>
                        <p id="subtotal" class="mb-0 text-cheque"></p>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <p class="mb-0 text">Gastos de envío estimados</p>
                        <p id="coste-envio" class="mb-0 text"></p>
                    </div>
                    <div id="descuento-aplicado" class="mt-3 d-flex justify-content-between">
                        <p class="mb-0 text">Descuento aplicado</p>
                        <p id="descuento-precio" class="mb-0 text">0 €</p>
                    </div>
                </div>
                <div class="py-2 px-3 fondo-gris">
                    <div class="d-flex justify-content-between">
                        <p class="text-h2">Total</p>
                        <p id="total" class="text-h2"></p>
                    </div>
                    <p class="text">Impuestos incluidos</p>
                    <p id="puntos-generados" class="text"></p>
                    <form id="compra" action=<?php if (!isset($_SESSION['usuario_id'])) {
                                                    echo url . "?controller=Login";
                                                } else {
                                                    echo url . "?controller=Carrito&action=compra";
                                                } ?> method='post'>
                        <input name="descuento" id="descuentoJS"  hidden>
                        <input name="coste_total" id="coste_totalJS" hidden>
                        <input name="puntos_generados" id="puntos_generadosJS" hidden>
                        <input name="propina" id="propina" hidden>
                        <button class="btn-compra mb-3">Continuar</button>
                    </form>
                    <p class="mb-2 text-pago">Pago 100% seguro</p>
                    <picture class="w-100">
                        <img src="assets/images/carrito/pago.svg" alt="métodos de pago" class="mt-2 mb-3 pagos">
                    </picture>
                </div>
            </div>
        </div>
        <!-- Popup para la propina -->
        <div id="popupPropina" class="popup">
            <div class="d-flex flex-column align-items-center contenedor_popup">
                <div class="w-100 pe-2 pt-2 mb-2 d-flex justify-content-end" >
                    <img id="cerrarPropina" src="assets/images/opiniones/cerrar.svg" alt="" class="cerrar" role="button">
                </div>
                <div class="px-4 pb-4">
                    <h2 class="mb-4">¿Quieres dejar una propina?</h2>
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-3">
                            <p class="mb-0 text-h3">Porcentaje sobre el pedido:</p>
                            <div class="ms-3 d-flex align-self-center altura-selector">
                                <button class="restar" id="restar-porcentaje">
                                    <picture class="d-flex align-items-center">
                                        <img src="assets/images/carrito/menos.svg">
                                    </picture>
                                </button>
                                <input type="number" id="inputPropina" min="1" max="100" value="3" class="mx-0 text-h3" readonly>
                                <button class="sumar" id="sumar-porcentaje">
                                    <picture class="d-flex align-items-center">
                                        <img src="assets/images/carrito/mas.svg">
                                    </picture>
                                </button>
                            </div>
                        </div>
                        <p id="total-propina" class="mb-3 text-h3"></p>
                    </div>
                    <div class="w-100 d-flex justify-content-center">
                        <button id="btnAceptarPropina" class="me-2 btn-compra">Aceptar</button>
                        <button id="btnCancelarPropina" class="ms-2 btn-eliminar">Omitir</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://unpkg.com/notie"></script>
    <script src="assets/js/views/carrito.js"></script>
</body>

</html>