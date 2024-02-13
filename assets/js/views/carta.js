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
        .then(carrito => {
            mostrarCarta(carrito)
        })
        .catch(error => console.error('Error:', error));
}