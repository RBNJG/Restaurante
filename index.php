<?php


include_once 'Controller/CartaController.php';
include_once 'Controller/CarritoController.php';
include_once 'Controller/HomeController.php';
include_once 'Controller/LoginController.php';
include_once 'Controller/RegistroController.php';
include_once 'Controller/PasswordController.php';
include_once 'Controller/PanelController.php';
include_once 'Controller/OpinionesController.php';
include_once 'Controller/APIController.php';
include_once 'config/parameters.php';

//Iniciamos sesión
session_start();

// Verificar si existe una cookie del carrito
if (isset($_COOKIE['carrito']) && !isset($_SESSION['carrito'])) {
    $datosCarrito = json_decode($_COOKIE['carrito'], true);

    // Reconstruir el carrito basado en los datos de la cookie
    $_SESSION['carrito'] = array();
    foreach ($datosCarrito as $item) {
        $producto = ProductoDAO::getProduct($item['producto_id']);
        $pedido = new Carrito($producto);
        $pedido->setCantidad($item['cantidad']);
        array_push($_SESSION['carrito'], $pedido);
    }
} else {
    // Si no hay cookie, inicializar el carrito como un array vacío
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }
}

if(isset($_COOKIE['usuario'])){
    $_SESSION['usuario_id'] = UsuarioDAO::getUser($_COOKIE['usuario'])->getUsuario_id();
}

if (!isset($_GET['controller'])) {
    // Si no se pasa nada se mostrará página principal de pedidos
    header("Location:" . url . '?controller=Home');
} else {
    $nombre_controller = $_GET['controller'] . 'Controller';

    if (class_exists($nombre_controller)) {
        // Miramos si nos pasa una acción
        // en caso contrario mostramos acción por defecto

        $controller = new $nombre_controller;

        if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
            $action = $_GET['action'];
        } else {
            $action = 'index';
        }

        $controller->$action();
    } else {
        header("Location:" . url . '?controller=Home');
    }
}
