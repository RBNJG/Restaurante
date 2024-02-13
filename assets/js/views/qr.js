function generarUrlQR(datosPedido) {
    const baseUrl = "https://api.qrserver.com/v1/create-qr-code/";
    const tamaño = "150x150"; // Puedes ajustar el tamaño aquí
    const data = encodeURIComponent(datosPedido); // Asegúrate de codificar los datos del pedido

    return `${baseUrl}?size=${tamaño}&data=${data}`;
}

// Función para mostrar el código QR en la página web
function mostrarQR(datosPedido) {
    // Obtener el URL del código QR
    const urlQR = generarUrlQR(datosPedido);

    // Crear un elemento de imagen para el código QR
    const imagenQR = document.getElementById("qr-pedido");
    imagenQR.src = urlQR;
    imagenQR.alt = "Código QR del Pedido";
}