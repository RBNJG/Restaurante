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
    <title>Leroy Merlin</title>
</head>

<body onload="cargarCarrito()">
    <div class="mt-3">
        <div class="container px-0">
            <h1 class="text-h1 mb-4">Carrito</h1>
            <hr class="linea-carrito">
        </div>
    </div>
    <section id="contenedor-carrito" class="container rellenar">
        <div class="row">
            <div id="productos-carrito" class="col-lg-9 col-md-8 col-6 px-0 mb-5">

            </div>
            <div id="pago" class="col-lg-3 col-md-4 col-6 ps-4 mt-2 mb-5">
                <div class="d-flex justify-content-between align-items-center py-4 px-3 mb-3 cartel-cheque">
                    <h3 class="mb-0 text-cheque">Aplicar puntos fidelidad</h4>
                        <picture>
                            <img src="assets/icons/flecha_derecha.svg" alt="flecha" class="flecha">
                        </picture>
                </div>
                <div class="">

                </div>
                <hr class="w-100 mb-0 linea-carrito">
                <div class="px-3 borde-fino">
                    <div class="d-flex justify-content-between pt-3">
                        <p class="mb-2 text-cheque">Subtotal</p>
                        <p id="subtotal" class="mb-2 text-cheque"></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="text">Gastos de envío estimados</p>
                        <p id="coste-envio" class="text"></p>
                    </div>
                </div>
                <div class="py-2 px-3 fondo-gris">
                    <div class="d-flex justify-content-between">
                        <p class="text-h2">Total</p>
                        <p id="total" class="text-h2"></p>
                    </div>
                    <p class="text">Impuestos incluidos</p>
                    <form action=<?php if (!isset($_SESSION['usuario_id'])) {
                                        echo url . "?controller=Login";
                                    } else {
                                        echo url . "?controller=Carrito&action=compra";
                                    } ?> method='post'>
                        <input name="carrito" value="<?= $_SESSION['carrito'] ?>" hidden>
                        <button class="btn-compra mb-3">Continuar</button>
                    </form>
                    <p class="mb-2 text-pago">Pago 100% seguro</p>
                    <picture class="w-100">
                        <img src="assets/images/carrito/pago.svg" alt="métodos de pago" class="mt-2 mb-3 pagos">
                    </picture>
                </div>
            </div>
        </div>
    </section>
    <script>
        //Función que carga el carrito
        function cargarCarrito() {
            fetch('http://www.leroymerlin.com/?controller=API&action=api', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'accion=obtener_carrito'
                })
                .then(response => response.json())
                .then(carrito => {
                    carrito.forEach(producto=> {
                        console.log(typeof producto.producto.coste_base);
                    });
                    mostrarCarrito(carrito),
                        envio(carrito),
                        actualizarCarritoUI(carrito)
                })
                .catch(error => console.error('Error:', error));
        }

        //Función que genera el HTML de los productos del carrito
        function mostrarCarrito(carrito) {

            if (carrito.length === 0) {
                const contenedorCarrito = document.getElementById('contenedor-carrito');
                contenedorCarrito.innerHTML = '';

                // Crear div principal
                const divRow = document.createElement('div');
                divRow.className = 'd-flex justify-content-center mb-5';

                const pMensaje = document.createElement('p');
                pMensaje.className = 'text-h2';
                pMensaje.textContent = "Todavía no tienes ningún producto en el carrito";

                divRow.appendChild(pMensaje);

                contenedorCarrito.appendChild(divRow);

            } else {
                const productosCarrito = document.getElementById('productos-carrito');
                productosCarrito.innerHTML = '';

                const h3Titulo = document.createElement('h3');
                h3Titulo.className = 'text-h3 mb-3';
                h3Titulo.textContent = 'Vendido por LEROY MERLIN';
                productosCarrito.appendChild(h3Titulo);

                carrito.forEach((producto, pos) => {
                    const divRow = document.createElement('div');
                    divRow.className = 'row';

                    const divFlex = document.createElement('div');
                    divFlex.className = 'd-flex justify-content-start w-100 ps-0 pe-2 altura-carrito';

                    //Imagen del producto
                    const divImagen = document.createElement('div');
                    divImagen.className = 'align-self-center img-carrito';
                    divImagen.style.backgroundImage = `url(${producto.producto.imagen})`;
                    divFlex.appendChild(divImagen);

                    const divContenido = document.createElement('div');
                    divContenido.className = 'w-100 d-flex flex-column justify-content-around';

                    //Primera fila dentro del producto
                    const divPrimeraFila = document.createElement('div');
                    divPrimeraFila.className = 'd-flex justify-content-between px-3';

                    //Nombre del producto
                    const pNombreProducto = document.createElement('p');
                    pNombreProducto.className = 'mb-0 text';
                    pNombreProducto.textContent = producto.producto.nombre_producto;
                    divPrimeraFila.appendChild(pNombreProducto);

                    //Botón de eliminar
                    const botonEliminar = document.createElement('button');
                    botonEliminar.className = 'd-flex justify-content-center align-items-center contenedor-basura sin-estilo';
                    botonEliminar.id = 'eliminar-producto';

                    const basura = document.createElement('img');
                    basura.src = 'assets/images/carrito/basura.svg';
                    basura.className = 'img-basura';

                    botonEliminar.appendChild(basura);
                    divPrimeraFila.appendChild(botonEliminar);

                    divContenido.appendChild(divPrimeraFila);

                    // Segunda fila dentro del producto
                    const divSegundaFila = document.createElement('div');
                    divSegundaFila.className = 'd-flex justify-content-between px-3';

                    const divSelector = document.createElement('div');
                    divSelector.className = 'd-flex align-self-center altura-selector';

                    //Si la cantidad del producto es 1 el botón de restar se desactiva
                    if (producto.cantidad === 1) {
                        //Botón menos desactivo
                        const boton = document.createElement('button');
                        boton.className = 'restar-off';
                        boton.disabled = true;

                        const picture = document.createElement('picture');
                        picture.className = 'd-flex align-items-center';

                        //Imagen del botón
                        const img = document.createElement('img');
                        img.src = 'assets/images/carrito/menos.svg';

                        picture.appendChild(img);

                        boton.appendChild(picture);

                        divSelector.appendChild(boton);
                    } else {
                        //Botón menos activo
                        const boton = document.createElement('button');
                        boton.className = 'restar';
                        boton.id = `sumar-${pos}`;

                        const picture = document.createElement('picture');
                        picture.className = 'd-flex align-items-center';

                        //Imagen del botón
                        const img = document.createElement('img');
                        img.src = 'assets/images/carrito/menos.svg';

                        picture.appendChild(img);

                        boton.appendChild(picture);

                        divSelector.appendChild(boton);
                    }

                    //Input con cantidad
                    const inputCantidad = document.createElement('input');

                    //Asignar los atributos al input
                    inputCantidad.type = 'text';
                    inputCantidad.id = 'cantidad';
                    inputCantidad.name = `cantidad-${pos}`;
                    inputCantidad.className = 'mx-0 text';
                    inputCantidad.value = producto.cantidad;
                    inputCantidad.readOnly = true;

                    divSelector.appendChild(inputCantidad);

                    //Botón más
                    const botonMas = document.createElement('button');
                    botonMas.className = 'sumar';
                    botonMas.id = `sumar-${pos}`;

                    const pictureMas = document.createElement('picture');
                    pictureMas.className = 'd-flex align-items-center';

                    //Imagen del botón
                    const imgMas = document.createElement('img');
                    imgMas.src = 'assets/images/carrito/mas.svg';

                    pictureMas.appendChild(imgMas);

                    botonMas.appendChild(pictureMas);

                    divSelector.appendChild(botonMas);

                    divSegundaFila.appendChild(divSelector);

                    //Si el precio tiene descuento se muestra de forma distinta
                    if (producto.producto.descuento === 0.00) {
                        const pPrecio = document.createElement('p');
                        pPrecio.id = `precio-producto-${producto.producto.producto_id}`;
                        pPrecio.className = 'mb-0 text-cheque';
                        pPrecio.textContent = `${(producto.producto.coste_base * producto.cantidad).toFixed(2)} €`;
                        divSegundaFila.appendChild(pPrecio);
                    } else {
                        // Calculamos los valores necesarios
                        let precioFinal = ((producto.producto.descuento * producto.producto.coste_base) * producto.cantidad).toFixed(2);
                        let precioTachado = (producto.producto.coste_base * producto.cantidad).toFixed(2);
                        let descuentoTotal = (precioTachado - precioFinal).toFixed(2);

                        // Creamos el contenedor principal
                        const divPrincipal = document.createElement('div');

                        // Creamos y agregamos el primer div
                        const divDescuento = document.createElement('div');
                        divDescuento.className = 'd-flex justify-content-end';

                        const divCartelDescuento = document.createElement('div');
                        divCartelDescuento.className = 'd-flex align-items-center justify-content-center cartel-descuento';

                        const pDescuento = document.createElement('p');
                        pDescuento.className = 'mb-0 text-cartel-descuento';
                        pDescuento.textContent = `- ${descuentoTotal} €`;

                        divCartelDescuento.appendChild(pDescuento);
                        divDescuento.appendChild(divCartelDescuento);
                        divPrincipal.appendChild(divDescuento);

                        // Creamos y agregamos el segundo div
                        const divPrecios = document.createElement('div');
                        divPrecios.className = 'd-flex align-items-baseline';

                        const pPrecioTachado = document.createElement('p');
                        pPrecioTachado.className = 'mb-0 me-4 text text-precio-tachado-carrito';
                        pPrecioTachado.textContent = `${precioTachado} €`;

                        const pPrecioFinal = document.createElement('p');
                        pPrecioFinal.id = `precio-producto-${producto.producto.producto_id}`;
                        pPrecioFinal.className = 'mb-0 text text-precio color-descuento';
                        pPrecioFinal.textContent = `${precioFinal} €`;

                        divPrecios.appendChild(pPrecioTachado);
                        divPrecios.appendChild(pPrecioFinal);
                        divPrincipal.appendChild(divPrecios);

                        divSegundaFila.appendChild(divPrincipal);
                    }

                    divContenido.appendChild(divSegundaFila);
                    divFlex.appendChild(divContenido);
                    divRow.appendChild(divFlex);
                    productosCarrito.appendChild(divRow);
                });

                //Manejador de eventos para sumar y restar cantidad de producto
                productosCarrito.addEventListener('click', function(event) {
                    if (event.target.matches('.sumar, .sumar *')) {
                        // Manejar clic en sumar
                        const pos = parseInt(event.target.closest('button').id.split('-')[1]);
                        modificarCantidad(carrito, pos, 1);
                    } else if (event.target.matches('.restar, .restar *')) {
                        // Manejar clic en restar
                        const pos = parseInt(event.target.closest('button').id.split('-')[1]);
                        modificarCantidad(carrito, pos, -1);
                    }
                });
            }
        }

        function modificarCantidad(carrito, pos, cambio) {
            // Cambiar la cantidad del producto en la posición dada
            let producto = carrito[pos];
            producto.cantidad += cambio;

            // Actualizar la interfaz de usuario
            const inputCantidad = document.querySelector(`input[name='cantidad-${pos}']`);
            inputCantidad.value = producto.cantidad;

            // Actualizar el carrito y la interfaz de usuario
            actualizarCarritoUI(carrito);

            // Aquí puedes agregar código para actualizar el carrito en el servidor
            // Por ejemplo, haciendo una solicitud fetch para actualizar la cantidad
        }

        function actualizarCarritoUI(carrito) {
            // Actualizar Subtotal, Total, Descuentos, etc.
            let subtotal = 0;

            carrito.forEach(producto => {
                let precioProducto = producto.producto.coste_base;
                let cantidadProducto = producto.cantidad;
                let descuentoProducto = producto.producto.descuento;

                // Calcula el subtotal por producto (teniendo en cuenta el descuento si existe)
                let subtotalProducto = cantidadProducto * (precioProducto * descuentoProducto);
                subtotal += subtotalProducto;

                // Actualiza el detalle del producto en el carrito
                const divPrecioProducto = document.querySelector(`#precio-producto-${producto.producto.producto_id}`);
                divPrecioProducto.textContent = `${subtotalProducto.toFixed(2)} €`;

                // Aquí puedes agregar cualquier otra actualización que dependa de la cantidad del producto
            });

            // Actualizar subtotal en la UI
            const divSubtotal = document.getElementById('subtotal');
            divSubtotal.textContent = `${subtotal.toFixed(2)} €`;

            // Actualizar total (subtotal + envío)
            const divTotal = document.getElementById('total');
            divTotal.textContent = `${(subtotal + envio(carrito)).toFixed(2)} €`;
        }

        //Función para mostrar el subtotal
        function subtotal(carrito) {

        }

        //Función para mostrar el coste de envío
        function envio(carrito) {
            const precioEnvio = document.getElementById('coste-envio');
            precioEnvio.innerHTML = '';

            let coste = 0;

            for (const producto of carrito) {
                if (producto.producto.envio === 0) {
                    coste = 3;
                    break;
                }
            }

            precioEnvio.textContent = `${coste} €`;
        }

        //Función para msotrar el coste total del pedido
        function costeTotal(carrito) {

        }
    </script>
</body>

</html>