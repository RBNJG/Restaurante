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
    <link href="assets/css/header.css" rel="stylesheet" type="text/css" media="screen">
    <title>Leroy Merlin</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg py-0">
            <div class="container-fluid px-0">
                <div class="logo">
                    <a href="<?= url . "?controller=Home" ?>" class="logo-enlace"></a>
                </div>
                <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="w-100 d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between">
                        <div class="carta">
                            <ul class="navbar-nav me-auto mb-lg-0">
                                <li class="nav-item me-4">
                                    <a href="<?= url . "?controller=Carta" ?>" class="text-menu">
                                        <div class="d-flex align-items-center ms-2">
                                            <img src="assets/images/header/carta.svg" alt="carta" class="me-2 imagen-carta">
                                            <p class="mb-0 text">Carta</p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= url . "?controller=Resenyas" ?>" class="text-menu">
                                        <div class="d-flex align-items-center ms-2">
                                            <img src="assets/images/header/opiniones.svg" alt="reseñas" class="me-2 logo-opiniones">
                                            <p class="mb-0 text">Reseñas</p>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex align-items-center my-2 px-2 ms-2 buscador-header">
                            <form class="d-flex justify-content-between w-100" role="search">
                                <input class="w-100 buscador text" type="search" placeholder="Buscar un producto, una marca..." aria-label="Search">
                                <button type="submit" class="sin-estilo">
                                    <img src="assets/images/header/lupa.svg" alt="">
                                </button>
                            </form>
                        </div>
                        <div class="d-flex flex-column flex-lg-row align-items-start">
                            <a href="<?php if (!isset($_SESSION['usuario_id'])) {
                                            echo url . "?controller=Login";
                                        } else {
                                            echo url . "?controller=Panel";
                                        } ?>" class="text-user-header">
                                <div class="d-flex flex-column align-items-center justify-content-center py-2 px-2">
                                    <div class="mb-1 logo-user"></div>
                                    <?php
                                    if (!isset($_SESSION['usuario_id'])) {
                                    ?>
                                        <p class="mb-0 text-h3">Iniciar sesión
                                        <?php
                                    } else {
                                        ?>
                                        <p class="mb-0 text-h3"><?= UsuarioDAO::getUser($_SESSION['usuario_id'])->getNombre() . " " . UsuarioDAO::getUser($_SESSION['usuario_id'])->getApellidos() ?></p>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </a>
                            <a href="<?= url . "?controller=Carrito" ?>" class="text-carrito-header">
                                <div class="d-flex flex-column align-items-center justify-content-center py-2 px-2 background-verde">
                                    <div class="mb-1 logo-carrito"></div>
                                    <p class="mb-0 text-h3">Carrito <?= Calculadora::cantidadCarrito($_SESSION['carrito']) ?></p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <hr class="my-0 linea-header">
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>