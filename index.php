<?php
include_once 'Controller/ProductoController.php';
include_once 'Controller/HomeController.php';
include_once 'config/parameters.php';

if (!isset($_GET['controller'])) {
    // Si no se pasa nada se mostrará página principal de pedidos
    header("Location:" . url . '?controller=Home');
} else {
    $nombre_controller = $_GET['controller'] . 'Controller';

    if (class_exists($nombre_controller)) {
        // Miramos si nos pasa una acción
        // en caso contrario mostramos acción por defecto

        $controller = new $nombre_controller;

        if(isset($_GET['action']) && method_exists($controller,$_GET['action'])){
            $action = $_GET['action'];
        }else{
            $action = 'index';
        }

        $controller->$action();

    } else {
        header("Location:" . url . '?controller=Home');
    }
}
