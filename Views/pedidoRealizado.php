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
    <title>Leroy Merlin</title>
</head>

<body onload="mostrarQR('<?= $urlPedido ?>')">
    <div class="d-flex flex-column align-items-center mt-2 rellenar">
        <div class="d-flex flex-column align-items-center">
            <h2 class="text-h1">Pedido realizado con éxito</h2>
            <hr class="linea-carrito">
            <img id="qr-pedido" src="" alt="" class="mb-2">
            <p class="text-h3">Escanea éste código QR para acceder a los detalles de tu pedido</p>
            <form action=<?= url . "?controller=Home" ?> method='post' class="d-flex flex-column">
                <button type="submit" class="mb-5 btn-compra">Continuar</button>
            </form>
        </div>
    </div>
</body>
<script src="assets/js/views/qr.js"></script>

</html>