function generarUrlQR(datosPedido) {
    //Construimos la URL para generar el código QR
    const baseUrl = "https://api.qrserver.com/v1/create-qr-code/";
    const tamaño = "150x150"; 
    const data = encodeURIComponent(datosPedido); 

    //Devolvemos la URL que genera el código QR
    return `${baseUrl}?size=${tamaño}&data=${data}`;
}

// Función para mostrar el código QR en la página web
function mostrarQR(datosPedido) {
    // Obtener el URL del código QR
    const urlQR = generarUrlQR(datosPedido);

    //Asignamos al elemento de imagen la URL del código QR
    const imagenQR = document.getElementById("qr-pedido");
    imagenQR.src = urlQR;
    imagenQR.alt = "Código QR del Pedido";
}