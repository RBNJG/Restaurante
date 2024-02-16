let productosGlobal = [];
let productosActuales = [];
let filtro = false;

//Función que carga el carrito
function cargarCarta() {
    //Primero intentamos cargar los productos de localStorage para agilizar la carga
    let productosLocalStorage = localStorage.getItem('productos');

    if (productosLocalStorage) {
        //Parseamos los productos y los usamos directamente
        productosGlobal = JSON.parse(productosLocalStorage);
        productosActuales = [...productosGlobal];
        mostrarCarta(productosGlobal, filtro);
    } else {
        //Si no hay productos en localStorage, realizamos la solicitud al servidor
        fetch('http://www.leroymerlin.com/?controller=API&action=api', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'accion=obtener_carta'
        })
            .then(response => response.json())
            .then(productos => {
                //Guardamos los productos obtenidos en localStorage
                localStorage.setItem('productos', JSON.stringify(productos));
                productosGlobal = productos;
                productosActuales = [...productosGlobal];
                mostrarCarta(productos, filtro);
            })
            .catch(error => console.error('Error:', error));
    }
}

//Función que genera la estructura del HTML de la carta
function mostrarCarta(productos, filtro) {
    const contenedorPrincipal = document.getElementById('productos-carta');
    document.getElementById('contador-productos').textContent = productos.length;
    contenedorPrincipal.innerHTML = '';

    if (!productos || productos.length === 0) {
        contenedorPrincipal.innerHTML = '<h2 class="mt-3 text-h2">Ningún producto cumple los requisitos</h2>';
        return;
    }

    let categoriaActual = "";

    // Si no se aplicaron filtros, manejar categorías, de lo contrario, omitir las categorías
    if (!filtro) {

        let htmlCategoria = '';

        productos.forEach((producto, index) => {
            if (categoriaActual !== producto.categoria) {
                if (categoriaActual !== "") {
                    //Cerramos el contendor antes de empezar uno nuevo
                    htmlCategoria += '</div>';
                    contenedorPrincipal.innerHTML += htmlCategoria;
                    htmlCategoria = '';
                }
                categoriaActual = producto.categoria;

                //Iniciamos nuevo bloque de categoría
                htmlCategoria += `
                    <div class="row mt-4" id="${categoriaActual}">
                        <div class="col-12">
                            <h3 class="text-h2">${categoriaActual}</h3>
                        </div>
                    </div>
                    <div class="row mt-2 mb-2">`;
            }

            //Añadimos los productos al HTML
            htmlCategoria += generarProducto(producto);

            //Si es el último producto cerramos el contenedor
            if (index === productos.length - 1) {
                htmlCategoria += '</div>';
                contenedorPrincipal.innerHTML += htmlCategoria;
            }
        });
    } else {
        //Cuando se aplican filtros u orden mostramos todos los productos sin categorias
        let htmlProductos = '<div class="row mt-2 mb-2">';
        productos.forEach(producto => {
            htmlProductos += generarProducto(producto);
        });
        htmlProductos += '</div>';
        contenedorPrincipal.innerHTML = htmlProductos;
    }
}

//Función que genera el HTML de los productos de la carta
function generarProducto(producto) {
    //Determinar la imagen de las estrellas
    let estrellasImagen = '';
    switch (producto.estrellas) {
        case 3:
            estrellasImagen = 'assets/images/carta/3_estrellas.svg';
            break;
        case 4:
            estrellasImagen = 'assets/images/carta/4_estrellas.svg';
            break;
        case 0:
        default:
            estrellasImagen = 'assets/images/carta/0_estrellas.svg';
            break;
    }

    //Determinar si mostrar el precio más bajo
    let precioMasBajoImagen = producto.coste_base === producto.precio_mas_bajo ? '<img src="assets/images/carta/precio_mas_bajo.svg" alt="precio más bajo" class="mb-2 precio-bajo">' : '';

    //Calcular el precio final con descuento si aplica
    let precioFinal = producto.descuento > 0 ? producto.coste_base * producto.descuento : producto.coste_base;
    let precioConDescuento = producto.descuento > 0 ? `
                                                        <div class="d-flex align-items-center justify-content-center mb-2 cartel-descuento">
                                                            <p class="mb-0 text text-cartel-descuento">- ${(producto.coste_base - precioFinal).toFixed(2)} €</p>
                                                        </div>
                                                        <div class="mb-1">
                                                            <p class="mb-0 text text-precio-tachado">${producto.coste_base.toFixed(2)} €</p>
                                                        </div>
                                                        <div class="mb-1">
                                                            <p class="mb-0 text text-precio color-descuento">${precioFinal.toFixed(2)} €</p>
                                                        </div>` : `<p class="text-precio">${producto.coste_base.toFixed(2)} €</p>`;

    //Determinar si el envío es gratis
    let envioGratis = producto.envio_gratis ? `<div class="d-flex justify-content-start align-items-center">
                                                    <picture>
                                                        <img src="assets/images/carta/tick_envio.svg" alt="envío gratis">
                                                    </picture>
                                                    <p class="mb-0 ms-1 mt-1 text-envio-gratis">Envío gratis</p>
                                                </div>` : '';

    //Construir el HTML del producto
    let productoHTML = `
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="h-carta">
                <div class="h-100">
                    <div class="img-carta" style="background-image: url(${producto.imagen});"></div>
                    <div class="d-flex flex-column justify-content-between h-texto-carta">
                        <div>
                            <p class="mb-0 text subrayado">${producto.nombre_producto}</p>
                            <div class="d-flex justify-content-start align-items-center mb-3">
                                <picture>
                                    <img src="${estrellasImagen}" alt="calificación" class="pt-0 estrella">
                                </picture>
                                <p class="mb-0 mt-1 ms-2 text-opiniones">${producto.opiniones} opiniones</p>
                            </div>
                            ${precioMasBajoImagen}
                            ${precioConDescuento}
                            ${envioGratis}
                        </div>
                        <div>
                            <form action="url_para_añadir_al_carrito" method="post">
                                <input name="producto_id" value="${producto.producto_id}" hidden />
                                <button class="btn-anadir-carrito" type="button">Añadir al carrito</button>
                            </form>
                            <hr class="w-100 mb-0 mt-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>`;

    return productoHTML;
}

//Función que aplica filtros a los productos de la carta
function aplicarFiltros() {
    //Hacemos una copia del array de productos
    let productosFiltrados = [...productosGlobal];

    //Filtro estrellas
    const filtro4Estrellas = document.querySelector('input[name="4estrellas"]:checked') ? true : false;
    const filtro3Estrellas = document.querySelector('input[name="3estrellas"]:checked') ? true : false;

    if (filtro4Estrellas && filtro3Estrellas) {
        productosFiltrados = productosFiltrados.filter(producto => producto.estrellas >= 3);
    } else if (filtro4Estrellas) {
        productosFiltrados = productosFiltrados.filter(producto => producto.estrellas === 4);
    } else if (filtro3Estrellas) {
        productosFiltrados = productosFiltrados.filter(producto => producto.estrellas === 3);
    }

    //Filtro por precio
    const precioMin = parseFloat(document.querySelector('input[name="minimo"]').value) || 0;
    const precioMax = parseFloat(document.querySelector('input[name="maximo"]').value) || Infinity;

    productosFiltrados = productosFiltrados.filter(producto => {
        const precioFinal = producto.coste_base * (1 - producto.descuento);
        return precioFinal >= precioMin && precioFinal <= precioMax;
    });

    //Filtro por envío gratuito
    if (document.querySelector('input[name="envio"]:checked')) {
        productosFiltrados = productosFiltrados.filter(producto => producto.envio_gratis);
    }

    //Filtro por descuento
    if (document.querySelector('input[name="descuento"]:checked')) {
        productosFiltrados = productosFiltrados.filter(producto => producto.descuento > 0);
    }

    productosActuales = productosFiltrados;

    //Volvemos a mostrar los productos filtrados
    mostrarCarta(productosFiltrados, true);
}

//Listeners de los eventos de la página
document.addEventListener('DOMContentLoaded', function () {

    //Definimos los contenedor en los que hacer clic para ocultar filtros
    const triggerCategorias = document.getElementById('desplegable-categorias');
    const triggerValoraciones = document.getElementById('desplegable-valoraciones');
    const triggerPrecio = document.getElementById('desplegable-precio');

    const categorias = document.getElementById('categorias');
    const valoraciones = document.getElementById('valoraciones');
    const precio = document.getElementById('precio');

    //Asignamos la clase transicion a los contenedores que queremos que se oculten
    categorias.classList.add('transicion');
    valoraciones.classList.add('transicion');
    precio.classList.add('transicion');

    //Al hacer clic ocultamos los filtros
    triggerCategorias.addEventListener('click', function () {
        categorias.classList.toggle('oculto');
    });

    triggerValoraciones.addEventListener('click', function () {
        valoraciones.classList.toggle('oculto');
    });

    triggerPrecio.addEventListener('click', function () {
        precio.classList.toggle('oculto');
    });


    //Utilizamos la delegación de eventos 
    document.getElementById('productos-carta').addEventListener('click', function (e) {
        //Comprobamos si el click ha ocurrido en un elemento con clase .btn-anadir-carrito
        if (e.target && e.target.matches('.btn-anadir-carrito')) {
            //Encontramos el producto_id del input dentro del formulario del producto
            const producto_id = e.target.closest('form').querySelector('input[name="producto_id"]').value;

            //Preparamos los datos que enviaremos a la API
            let datos = new URLSearchParams({
                accion: "anadir_producto",
                producto_id: producto_id,
            }).toString();

            //Realizamos la petición fetch para añadir el producto al carrito
            fetch('http://www.leroymerlin.com/?controller=API&action=api', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: datos,
            })
                .then(response => response.json())
                .then(data => {
                    //Avisamos al cliente de que el producto se ha añadido al carrito
                    notie.alert({
                        type: 'success',
                        text: 'El producto se ha añadido al carrito'
                    })
                    console.log('Producto añadido con éxito:', data);

                    //Actualización del carrito
                    const contadorCarrito = document.getElementById('carrito-header');
                    contadorCarrito.textContent = "Carrito " + data.success;
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }
    });

    //Al apretar el botón de aplicar filtros
    document.getElementById('aplicar-filtros').addEventListener('click', aplicarFiltros);

    document.getElementById('restablecer-filtros').addEventListener('click', function () {
        //Restablece los checkboxes de los filtros
        document.querySelectorAll('#filtros-carta input[type="checkbox"]').forEach(checkbox => {
            checkbox.checked = false;
        });

        //Restablece los inputs de rango de precio
        document.querySelector('input[name="minimo"]').value = null; // Ajusta según el valor por defecto
        document.querySelector('input[name="maximo"]').value = null; // Ajusta según el valor por defecto

        //Volvemos a cargar la carta  
        cargarCarta();
    });

    //Ordenación de los productos
    document.getElementById('select-filtro').addEventListener('change', function () {
        const seleccion = this.value;
        let productosOrdenados = productosActuales;

        switch (seleccion) {
            case 'menos_mas':
                productosOrdenados.sort((a, b) => a.coste_base - b.coste_base);
                break;
            case 'mas_menos':
                productosOrdenados.sort((a, b) => b.coste_base - a.coste_base);
                break;
            case 'vendidos':
                productosOrdenados.sort((a, b) => b.opiniones - a.opiniones);
                break;
        }

        //Mostramos la carta ordenada
        mostrarCarta(productosOrdenados, true);
    });
});

//Definimos la mediaQuery para esconder los filtros en pantallas pequeñas
const mediaQuery = window.matchMedia('(max-width: 768px)');

//Con esta función escondemos los filtros en pantallas pequeñas
function manejarCambioMediaQuery(e) {
    const categorias = document.getElementById('categorias');
    const valoraciones = document.getElementById('valoraciones');
    const precio = document.getElementById('precio');

    if (categorias && valoraciones && precio) {
        //Si se cumple la mediaQuery aplicamos la clase
        if (e.matches) {
            categorias.classList.add('oculto');
            valoraciones.classList.add('oculto');
            precio.classList.add('oculto');
        } else {
            categorias.classList.remove('oculto');
            valoraciones.classList.remove('oculto');
            precio.classList.remove('oculto');
        }
    }
}

mediaQuery.addEventListener('change', manejarCambioMediaQuery);

//Ejecutamos la función
manejarCambioMediaQuery(mediaQuery);