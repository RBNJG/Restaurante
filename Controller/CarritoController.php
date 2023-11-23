<?php
include_once 'Model/ProductoDAO.php';
include_once 'Model/CategoriaDAO.php';
include_once 'Model/Carrito.php';
include_once 'utils/Calculadora.php';

// Creamos el controlador del carrito

class CarritoController
{

    public function index()
    {
        //Iniciamos sesión
        session_start();

        //Creamos el array dónde se guardan los productos seleccionados
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = array();
        }

        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/carrito.php';
        //Footer
        include_once 'Views/footer.php';
    }

    public function eliminar(){
        session_start();

        //Eliminamos el producto del array del carrito
        unset($_SESSION['carrito'][$_POST['pos_producto']]);

        //Reordenamos el array
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);

        header("Location:" . url. "?controller=Carrito");
        exit;
    }

}
