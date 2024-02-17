let estrellasGlobal;
let usuario_idGlobal;
let mensajeUsuario = "";
let totalOpiniones = [];

//Función para obtener la información de las opiniones en JSON
function cargarOpiniones(orden, estrellasFiltradas = [], textoBusqueda) {
    fetch('http://www.leroymerlin.com/?controller=API&action=api', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'accion=buscar_opiniones'
    })
        .then(response => response.json())
        .then(opiniones => {
            totalOpiniones = opiniones;
            let opinionesFiltradas = filtrarOpiniones(opiniones, orden, estrellasFiltradas, textoBusqueda);
            let paginas = paginarOpiniones(opinionesFiltradas, 3);
            informacionOpiniones(opiniones);
            mostrarOpiniones(paginas[0]);
            agregarControlesPaginacion(paginas);
            estiloPaginacion(0, paginas.length);
            obtenerUsuario();
        })
        .catch(error => console.error('Error:', error));
}

//Función para obtener el usuario actual y sus pedidos
function obtenerUsuario() {
    fetch('http://www.leroymerlin.com/?controller=API&action=api', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'accion=obtener_usuario_opiniones'
    })
        .then(response => response.json())
        .then(pedidos => {
            if (pedidos.error) {
                console.error("Error:", pedidos.error);
            } else if (pedidos.mensaje) {
                mensajeUsuario = pedidos.mensaje;
            } else {
                actualizarSelectPedidos(pedidos)
                usuario_idGlobal = pedidos.usuario_id;   
            }
        })
        .catch(error => console.error('Error al obtener los datos:', error));
}

function actualizarSelectPedidos(pedidos) {
     // Asumiendo que totalOpiniones ya está definido y lleno con las opiniones obtenidas previamente
     if (!Array.isArray(totalOpiniones)) {
        console.error('totalOpiniones no está definido o no es un array.');
        return;
    }

    // Filtrar los pedidos para excluir aquellos que ya tienen opiniones
    let pedidosSinOpiniones = pedidos.pedidos_usuario.filter(pedido => 
        !totalOpiniones.some(opinion => opinion.pedido_id === pedido.pedido_id)
    );


    console.log(pedidosSinOpiniones);
    console.log(totalOpiniones);

    // Seleccionar el elemento select de pedidos
    var selectPedidos = document.getElementById('lista-pedidos');

    //Eliminamos el contenido
    selectPedidos.innerHTML = '';

    //Agregamos cada pedido como opción del select
    pedidosSinOpiniones.forEach(function (pedido) {
        var opcion = document.createElement('option');
        opcion.textContent = 'Pedido nº' + pedido.pedido_id;
        opcion.value = pedido.pedido_id;
        selectPedidos.appendChild(opcion);
    });
}

// Función para filtrar y ordenar opiniones
function filtrarOpiniones(opiniones, orden, estrellasFiltradas, textoBusqueda) {
    // Filtrar por estrellas, si se especifica
    if (estrellasFiltradas.length > 0) {
        opiniones = opiniones.filter(opinion => estrellasFiltradas.includes(opinion.estrellas));
    }

    //Filtrar por texto de opinión
    if (textoBusqueda) {
        opiniones = opiniones.filter(opinion =>
            opinion.opinion.toLowerCase().includes(textoBusqueda.toLowerCase())
        );
    }

    // Ordenar opiniones según el criterio
    switch (orden) {
        case "mas_reciente":
            opiniones.sort((a, b) => new Date(b.fecha) - new Date(a.fecha));
            break;
        case "mas_antigua":
            opiniones.sort((a, b) => new Date(a.fecha) - new Date(b.fecha));
            break;
        case "mas_valorada":
            opiniones.sort((a, b) => b.estrellas - a.estrellas);
            break;
        case "menos_valorada":
            opiniones.sort((a, b) => a.estrellas - b.estrellas);
            break;
    }

    return opiniones;
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
                    <div class="w-100 d-flex justify-content-between"> 
                        <div class="d-flex justify-content-start aling-items-center mb-2">
                            <img src="${urlImagenEstrellas}" alt="" class="img-estrellas">
                            <p class="ms-2 mb-0 text">${opinion.estrellas} / 5</p>
                        </div>
                        <p class="text">Pedido nº${opinion.pedido_id}</p>
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
    fetch('http://www.leroymerlin.com/?controller=API&action=api', opciones)
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

//Al apretar el botón "Filtrar" se muestran las opciones para aplicar filtros
document.getElementById('filtrar').addEventListener('click', function () {
    document.getElementById('panelFiltros').style.right = '0';
    document.getElementById('fondoOscuro').style.display = 'block';
});

//Si se hace click en el fondo oscuro o el botón de cerrar al mostrar los filtros, estos se cierran
document.querySelectorAll('#fondoOscuro, #cerrar-filtros').forEach(function (elemento) {
    elemento.addEventListener('click', function () {
        document.getElementById('panelFiltros').style.right = '-100%';
        document.getElementById('fondoOscuro').style.display = 'none';
    });
});

//Al hacer click en "filtrar" se aplican todos los filtros seleccionado en las opiniones
document.querySelectorAll('#aplicar-filtros, #buscar').forEach(elemento => {
    elemento.addEventListener('click', function () {
        event.preventDefault(); // Prevenir la acción por defecto

        // Obtener el valor ingresado en el campo de búsqueda
        let textoBusqueda = document.getElementById('texto-buscador').value.trim().toLowerCase();
        let orden = document.getElementById('select-order').value;
        let estrellasFiltradas = Array.from(document.querySelectorAll('[name="5estrellas"]:checked,[name="4estrellas"]:checked,[name="3estrellas"]:checked,[name="2estrellas"]:checked,[name="1estrella"]:checked')).map(el => parseInt(el.value));
        cargarOpiniones(orden, estrellasFiltradas, textoBusqueda);

        // Cerrar el panel de filtros
        document.getElementById('panelFiltros').style.right = '-100%';
        document.getElementById('fondoOscuro').style.display = 'none';
    })
});

//Quitar todo los filtros al hacer click en el botón "borrar todo"
document.getElementById('borrar-todo').addEventListener('click', function (event) {
    event.preventDefault(); // Prevenir la acción por defecto del botón (si está dentro de un formulario)

    // Desmarcar todos los checkboxes
    document.querySelectorAll('[name="5estrellas"],[name="4estrellas"],[name="3estrellas"],[name="2estrellas"],[name="1estrella"]').forEach(checkbox => {
        checkbox.checked = false;
    });

    // Restablecer el valor del select a su opción por defecto
    document.querySelector('.select-filtro').value = 'mas_reciente';

    //Restablecer el texto
    document.getElementById('texto-buscador').value = "";

    // Llamar a cargarOpiniones sin filtros para restablecer la lista de opiniones
    cargarOpiniones();

    // Cerrar el panel de filtros si es necesario
    document.getElementById('panelFiltros').style.right = '-100%';
    document.getElementById('fondoOscuro').style.display = 'none';
});

//Guardar nueva opinión
document.getElementById('guardar-opinion').addEventListener('click', function (event) {
    event.preventDefault();

    //Verificamos si se ha seleccionado una calificación
    if (!estrellasGlobal || estrellasGlobal === 0) {
        notie.alert({
            type: 'error',
            text: 'Por favor, selecciona una valoración.'
        })
        return;
    }

    //Verificamos si se ha seleccionado una calificación
    if (document.getElementById('opinion').value == "") {
        notie.alert({
            type: 'error',
            text: 'Por favor, escribe tu opinión.'
        })
        return;
    }

    //Preparamos los datos que enviaremos a la API
    let datos = new URLSearchParams({
        accion: "guardar_opinion",
        pedido_id: document.getElementById('lista-pedidos').value,
        estrellas: estrellasGlobal,
        usuario_id: usuario_idGlobal,
        opinion: document.getElementById('opinion').value
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
    fetch('http://www.leroymerlin.com/?controller=API&action=api', opciones)
        .then(response => response.json())
        .then(data => {
            notie.alert({
                type: 'success',
                text: 'Opinión guardada con éxito.'
            })
            //Volvemos a cargar las opiniones y reiniciamos los filtros
            cargarOpiniones();
            resetearFormulario();
            console.log('Respuesta del servidor:', data);
        })
        .catch(error => {
            console.error('Error al enviar datos:', error);
        });

    //Cerramos el espacio para la nueva opinión
    var formulario = document.getElementById('formulario-opinion');
    formulario.style.opacity = 0;
    formulario.style.maxHeight = "0";
    setTimeout(function () {
        formulario.style.display = "none";
    }, 500);
});

//Función para resetear los valores del formulario
function resetearFormulario() {
    //Resetear el select de pedidos
    let selectPedidos = document.getElementById('lista-pedidos');
    if (selectPedidos.options.length > 0) {
        selectPedidos.selectedIndex = 0;
    }

    //Resetear las estrellas
    let estrellas = document.querySelectorAll('#estrellas .estrella');
    estrellas.forEach(estrella => {
        estrella.classList.remove('resaltada', 'seleccionada');
    });
    estrellasGlobal = 0;

    //Limpiar el textarea de la opinión
    document.getElementById('opinion').value = '';
}

//Muestra u oculta el formulario para insertar una nueva opinión
document.getElementById('nueva-opinion').addEventListener('click', function () {
    //Si el usuario no cumple las condiciones le mostramos el mensaje y no abrimos el formulario
    if (mensajeUsuario != "") {
        notie.alert({
            type: 'error',
            text: mensajeUsuario
        })

        return;
    }

    var formulario = document.getElementById('formulario-opinion');
    if (formulario.style.display === "none") {
        formulario.style.display = "block";
        formulario.classList.add('mb-4');
        setTimeout(function () {
            formulario.style.opacity = 1;
            formulario.style.maxHeight = "1000px";
        }, 10);
    } else {
        formulario.style.opacity = 0;
        formulario.style.maxHeight = "0";
        setTimeout(function () {
            formulario.style.display = "none";
        }, 500);
    }
});

//Aspecto de las estrellas al insertar opinión
document.addEventListener('DOMContentLoaded', function () {
    let estrellas = document.querySelectorAll('.estrella-opinion');
    let calificacionSeleccionada = 0;

    estrellas.forEach(function (estrella) {
        estrella.addEventListener('mouseover', resaltarEstrellas);
        estrella.addEventListener('click', seleccionarCalificacion);
        estrella.addEventListener('mouseout', mantenerResaltado);
    });

    function resaltarEstrellas() {
        let valor = this.getAttribute('data-valor');
        resetearEstrellas();
        for (let i = 0; i < valor; i++) {
            estrellas[i].classList.add('resaltada');
        }
    }

    function seleccionarCalificacion() {
        calificacionSeleccionada = this.getAttribute('data-valor');
        console.log('Calificación seleccionada:', calificacionSeleccionada);
        resaltarSeleccion(calificacionSeleccionada);
        estrellasGlobal = calificacionSeleccionada;
    }

    function mantenerResaltado() {
        resaltarSeleccion(calificacionSeleccionada);
    }

    function resaltarSeleccion(valor) {
        resetearEstrellas();
        for (let i = 0; i < valor; i++) {
            estrellas[i].classList.add('resaltada');
        }
    }

    function resetearEstrellas() {
        estrellas.forEach(function (estrella) {
            estrella.classList.remove('resaltada');
        });
    }
});