//Función que carga el carrito
function cargarCarta() {
    fetch('http://www.leroymerlin.com/?controller=API&action=api', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'accion=obtener_carta'
    })
        .then(response => response.json())
        .then(productos => {
            mostrarCarta(productos)
        })
        .catch(error => console.error('Error:', error));
}

function mostrarCarta(productos) {
    let categoriaActual = "";
    const contenedorPrincipal = document.getElementById('productos-carta');

    if (!productos || productos.length === 0) {
        contenedorPrincipal.innerHTML += '<h2 class="mt-3 text-h2">Ningún producto cumple los requisitos</h2>';
        return;
    }

    let htmlCategoria = ''; // Inicializar el HTML de la categoría actual

    productos.forEach((producto, index) => {
        if (categoriaActual !== producto.categoria) {
            if (categoriaActual !== "") {
                // Cerrar el contenedor .row anterior antes de comenzar uno nuevo
                htmlCategoria += '</div>';
                contenedorPrincipal.innerHTML += htmlCategoria;
                htmlCategoria = ''; // Reiniciar el HTML de la categoría
            }
            categoriaActual = producto.categoria;

            // Iniciar un nuevo bloque de categoría y .row
            htmlCategoria += `
                <div class="row mt-4" id="${categoriaActual}">
                    <div class="col-12">
                        <h3 class="text-h2">${categoriaActual}</h3>
                    </div>
                </div>
                <div class="row mt-2 mb-2">`;
        }

        // Añadir productos al HTML de la categoría actual
        htmlCategoria += generarProducto(producto);

        // Si es el último producto, asegúrate de cerrar el contenedor .row
        if (index === productos.length - 1) {
            htmlCategoria += '</div>';
            contenedorPrincipal.innerHTML += htmlCategoria;
        }
    });
}

function generarProducto(producto) {
    // Determinar la imagen de las estrellas basada en la calificación del producto
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

    // Determinar si mostrar el precio más bajo
    let precioMasBajoImagen = producto.coste_base === producto.precio_mas_bajo ? '<img src="assets/images/carta/precio_mas_bajo.svg" alt="precio más bajo" class="mb-2 precio-bajo">' : '';

    // Calcular el precio final con descuento si aplica
    let precioFinal = producto.descuento > 0 ? producto.coste_base * (1 - producto.descuento) : producto.coste_base;
    let precioConDescuento = producto.descuento > 0 ? `<div class="mb-1">
                                                            <p class="mb-0 text text-precio-tachado">${producto.coste_base.toFixed(2)} €</p>
                                                        </div>
                                                        <div class="mb-1">
                                                            <p class="mb-0 text text-precio color-descuento">${precioFinal.toFixed(2)} €</p>
                                                        </div>` : `<p class="text-precio">${producto.coste_base.toFixed(2)} €</p>`;

    // Determinar si el envío es gratis
    let envioGratis = producto.envio_gratis ? `<div class="d-flex justify-content-start align-items-center">
                                                    <picture>
                                                        <img src="assets/images/carta/tick_envio.svg" alt="envío gratis">
                                                    </picture>
                                                    <p class="mb-0 ms-1 mt-1 text-envio-gratis">Envío gratis</p>
                                                </div>` : '';

    // Construir el HTML del producto
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

document.addEventListener('DOMContentLoaded', function () {

    const triggerCategorias = document.getElementById('desplegable-categorias');
    const triggerValoraciones = document.getElementById('desplegable-valoraciones');
    const triggerPrecio = document.getElementById('desplegable-precio');

    const categorias = document.getElementById('categorias');
    const valoraciones = document.getElementById('valoraciones');
    const precio = document.getElementById('precio');

    // Asegurar que targetDiv tenga la clase para la transición
    categorias.classList.add('transicion');
    valoraciones.classList.add('transicion');
    precio.classList.add('transicion');

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
            let datos =  new URLSearchParams({
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
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }
    });
});