let carritoGlobal;
let costeEnvioGlobal = 0;
let usuario_idGlobal;
let mensajeUsuario = "";
let puntosUsuario = 0;

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
            carritoGlobal = carrito;
            mostrarCarrito(carrito),
                envio(carrito),
                getCoste(carrito);
        })
        .catch(error => console.error('Error:', error));
}

//Función para verificar si el usuario está conectado y obtener sus puntos de fidelidad
function obtenerUsuario() {
    fetch('http://www.leroymerlin.com/?controller=API&action=api', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'accion=obtener_usuario_carrito'
    })
        .then(response => response.json())
        .then(usuario => {
            if (usuario.error) {
                console.error("Error:", usuario.error);
            } else if (usuario.mensaje) {
                mensajeUsuario = usuario.mensaje;
            } else {
                puntosUsuario = usuario.puntos_fidelidad;
                usuario_idGlobal = usuario.usuario_id;
                mostrarPuntos(puntosUsuario);
                console.log("Puntos_fidelidad:", usuario.puntos_fidelidad);
            }
        })
        .catch(error => console.error('Error al obtener los datos:', error));
}

//Función para mostrar los puntos acumulados del usuario
function mostrarPuntos($puntosUsuario) {
    const puntosMax = document.getElementById('puntos-acumulados');
    puntosMax.textContent = $puntosUsuario;

    // Seleccionar el elemento input y el elemento p
    const inputPuntosAplicados = document.getElementById('puntos-aplicados');
    const puntosAcumulados = document.getElementById('puntos-acumulados');

    inputPuntosAplicados.max = puntosUsuario;

    //Nos asguramos de que el usuario no ponga valores negativos o mayores a la cantidad de puntos acumulados
    inputPuntosAplicados.addEventListener('input', function () {
        const valorActual = parseInt(inputPuntosAplicados.value, 10);
        if (valorActual < 0) {
            inputPuntosAplicados.value = '0';
        } else if (valorActual > parseInt(inputPuntosAplicados.max, 10)) {
            inputPuntosAplicados.value = inputPuntosAplicados.max;
        }
    });
}

//Función para calcular los puntos de fidelidad que generará la compra
function calcularPuntosFidelidad($valorCompra) {
    let puntosFidelidad;

    puntosFidelidad = Math.trunc($valorCompra / 10);

    return puntosFidelidad;
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
            divRow.id = `producto-${pos}`;

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
            botonEliminar.id = `eliminar-${pos}`;

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
    mostrarCarrito(carrito);
    getCoste(carrito)

    //Preparamos los datos que enviaremos a la API
    let datos = new URLSearchParams({
        accion: "actualizar_carrito",
        producto_id: producto.producto.producto_id,
        cantidad: cambio,
    }).toString();

    //Método de envío
    let opciones = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: datos
    };

    // Enviar el carrito actualizado al servidor para actualizar $_SESSION['carrito']
    fetch('http://www.leroymerlin.com/?controller=API&action=api', opciones)
        .then(response => response.json())
        .then(data => {
            console.log('Respuesta del servidor:', data);
        })
        .catch(error => {
            console.error('Error al enviar datos:', error);
        });
}

function eliminarProducto(carrito, pos) {

    //Preparamos los datos que enviaremos a la API
    let datos = new URLSearchParams({
        accion: "eliminar_producto_carrito",
        pos_producto: pos,
    }).toString();

    //Método de envío
    let opciones = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: datos
    };

    // Enviar el carrito actualizado al servidor para actualizar $_SESSION['carrito']
    fetch('http://www.leroymerlin.com/?controller=API&action=api', opciones)
        .then(response => response.json())
        .then(data => {
            console.log('Respuesta del servidor:', data);
        })
        .catch(error => {
            console.error('Error al enviar datos:', error);
        });

    // Actualizar el carrito y la interfaz de usuario
    cargarCarrito();
}

//Función para obtener los costes del pedido
function getCoste(carrito) {
    let subtotal = 0;

    carrito.forEach(producto => {
        let precio = producto.producto.coste_base;
        let cantidad = producto.cantidad;
        let descuento = producto.producto.descuento;

        let precioTotalProducto = precio * cantidad * (1 - descuento);
        subtotal += precioTotalProducto;
    });

    let divSubtotal = document.getElementById('subtotal');
    if (divSubtotal) {
        divSubtotal.textContent = `${subtotal.toFixed(2)} €`;
    }

    let divTotal = document.getElementById('total');
    if (divTotal) {
        divTotal.textContent = `${(subtotal + costeEnvioGlobal).toFixed(2)} €`;
    }

    let puntosFidelidad = document.getElementById('puntos-generados');
    if (puntosFidelidad) {
        puntosFidelidad.innerHTML = `Con esta compra obtendrás <b>${calcularPuntosFidelidad(subtotal)}</b> puntos de fidelidad.`;
    }
}

//Función para mostrar el coste de envío
function envio(carrito) {
    const precioEnvio = document.getElementById('coste-envio');
    precioEnvio.innerHTML = '';

    let coste = 0;

    for (const producto of carrito) {
        if (producto.producto.envio_gratis === 0) {
            coste = 3;
            costeEnvioGlobal = coste;
            break;
        }
    }

    precioEnvio.textContent = `${coste} €`;
}

//Manejador de eventos para sumar y restar cantidad de producto
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('productos-carrito').addEventListener('click', function (event) {
        if (event.target.matches('.sumar, .sumar *')) {
            // Manejar clic en sumar
            const pos = parseInt(event.target.closest('button').id.split('-')[1]);
            modificarCantidad(carritoGlobal, pos, 1);
        } else if (event.target.matches('.restar, .restar *')) {
            // Manejar clic en restar
            const pos = parseInt(event.target.closest('button').id.split('-')[1]);
            modificarCantidad(carritoGlobal, pos, -1);
        }

        if (event.target.matches('.contenedor-basura, .contenedor-basura *')) {
            // Manejar clic en eliminar
            const pos = parseInt(event.target.closest('button').id.split('-')[1]);
            eliminarProducto(carritoGlobal, pos);
        }
    });
});

//Muestra u oculta la sección para aplicar puntos de fidelidad
document.getElementById('aplicar-puntos').addEventListener('click', function () {
    //Si el usuario no cumple las condiciones le mostramos el mensaje y no abrimos el formulario
    if (mensajeUsuario != "") {
        notie.alert({
            type: 'error',
            text: mensajeUsuario
        })

        return;
    }

    var puntos = document.getElementById('asignar-puntos');
    if (puntos.style.display === "none") {
        puntos.style.display = "block";
        setTimeout(function () {
            puntos.style.opacity = 1;
            puntos.style.maxHeight = "500px";
        }, 10);
    } else {
        puntos.style.opacity = 0;
        puntos.style.maxHeight = "0";
        setTimeout(function () {
            puntos.style.display = "none";
        }, 500);
    }
});