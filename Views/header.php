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

<body>
    <header>
        <nav class="navbar navbar-expand-lg py-0">
            <div class="container-fluid">
                <div class="logo">
                    <a href="<?= url . "?controller=Home" ?>" class="logo-enlace"></a>
                </div>
                <div class="w-100 mb-0 ms-3">
                    <!-- Para el triangulo gris probar con ::before en CSS -->
                    <div class="w-100 d-flex justify-content-between align-items-center mb-2 background-gris">
                        <div class="d-flex align-items-center my-2 px-2 buscador-header">
                            <form class="d-flex justify-content-between w-100" role="search">
                                <input class="w-100 buscador text" type="search" placeholder="Buscar un producto, una marca..." aria-label="Search">
                                <button type="submit" class="sin-estilo">
                                    <img src="assets/images/header/lupa.svg" alt="">
                                </button>
                            </form>
                        </div>
                        <div class="d-flex">
                            <a href="<?php if(!isset($_SESSION['usuario_id'])){echo url . "?controller=Login";}else{echo url . "?controller=Panel";} ?>" class="text-user-header">
                                <div class="d-flex flex-column align-items-center justify-content-center py-2 px-2">
                                    <div class="mb-1 logo-user"></div>
                                    <?php
                                    if (!isset($_SESSION['usuario_id'])) {
                                    ?>
                                        Iniciar sesión
                                    <?php
                                    } else {
                                    ?>
                                        <?= UsuarioDAO::getUser($_SESSION['usuario_id'])->getNombre() . " " . UsuarioDAO::getUser($_SESSION['usuario_id'])->getApellidos() ?>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </a>
                            <a href="<?= url . "?controller=Carrito" ?>" class="text-carrito-header">
                                <div class="d-flex flex-column align-items-center justify-content-center py-2 px-2 background-verde">
                                    <div class="mb-1 logo-carrito"></div>
                                    Carrito <?= Calculadora::cantidadCarrito($_SESSION['carrito']) ?>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start my-0 my-3">
                        <a href="<?= url . "?controller=Producto" ?>" class="text-menu">
                            <div class="d-flex align-items-center ms-3">
                                <img src="assets/images/header/carta.svg" alt="" class="me-2">
                                <p class="mb-0">Carta</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
        <hr class="my-0 linea-header">
    </header>
</body>

</html>