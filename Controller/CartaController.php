<?php
include_once 'Model/ProductoDAO.php';
include_once 'Model/CategoriaDAO.php';
include_once 'Model/Carrito.php';
include_once 'utils/Calculadora.php';

// Creamos el controlador de pedidos

class CartaController
{

    public function index()
    {
        //Obtenemos los productos y categorias para mostrar en carta
        $productos = ProductoDAO::getAllProducts();
        $categorias = CategoriaDAO::getAllCategories();

        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/carta.php';
        //Footer
        include_once 'Views/footer.php';
    }

    //Función para añadir un producto al carrito
    public function anadir()
    {
        session_start();

        $producto_id = $_POST['producto_id'];
        $producto_existente = false;

        //Buscamos el producto en el carrito 
        foreach ($_SESSION['carrito'] as $pedido) {
            if ($pedido->getProducto()->getProducto_id() == $producto_id) {
                //Si el producto ya está en el carrito, incrementa la cantidad
                $pedido->setCantidad($pedido->getCantidad() + 1);
                $producto_existente = true;

                //Después de encontrar el producto salimos del bucle
                break;
            }
        }

        //Si el producto no está en el carrito lo añade
        if (!$producto_existente) {
            $pedido = new Carrito(ProductoDAO::getProduct($producto_id));
            array_push($_SESSION['carrito'], $pedido);
        }

        $carritoParaJson = array_map(function ($pedido) {
            return [
                'producto_id' => $pedido->getProducto()->getProducto_id(),
                'cantidad' => $pedido->getCantidad(),
            ];
        }, $_SESSION['carrito']);

        $cookiesCarrito = json_encode($carritoParaJson);

        //Guardamos el carrito en las cookies
        setcookie('carrito', $cookiesCarrito, time() + (3600 * 48));

        //Volvemos a la carta
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    //Función para eliminar un producto
    public function eliminar()
    {
        echo 'Producto eliminado';

        //$producto_id = $_POST['producto_id'];
        //ProductoDAO::deleteProduct($producto_id);

        header("Location:" . url);
    }

    
}
