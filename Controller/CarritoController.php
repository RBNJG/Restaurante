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
        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/carrito.php';
        //Footer
        include_once 'Views/footer.php';
    }

    //Función para eliminar un producto o conjunto de productos del carrito
    public function eliminar(){
        session_start();

        //Eliminamos el producto del array del carrito
        unset($_SESSION['carrito'][$_POST['pos_producto']]);

        //Reordenamos el array
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);

        header("Location:" . url. "?controller=Carrito");
        exit;
    }

    //Función para aumentar o disminuir la cantidad de un producto del carrito
    public function modificarCantidad(){
        session_start();

        if(isset($_POST['sumar'])){
            $producto = $_SESSION['carrito'][$_POST['sumar']];

            $producto->setCantidad($producto->getCantidad()+1);
        }else if(isset($_POST['restar'])){
            $producto = $_SESSION['carrito'][$_POST['restar']];

            $producto->setCantidad($producto->getCantidad()-1);
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);

        exit;
    }

    public function compra(){
        echo "compra";
    }

}
