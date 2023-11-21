<?php
include_once 'Model/ProductoDAO.php';
include_once 'Model/CategoriaDAO.php';
include_once 'Model/Carrito.php';

// Creamos el controlador de pedidos

class ProductoController
{

    public function index()
    {
        //Iniciamos sesión
        session_start();

        //Creamos el array dónde se guardan los productos seleccionados
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = array();
        }


        //Obtenemos los productos y categorias para mostrar en carta
        $productos = ProductoDAO::getAllProducts();
        $categorias = CategoriaDAO::getAllCategories();

        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/panelPedido.php';
        //Footer
        include_once 'Views/footer.php';
    }

    public function anadir()
    {
        // Iniciar sesión si no se ha iniciado
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Inicializar 'carrito' como un array si aún no se ha hecho
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = array();
        }

        $pedido = new Carrito(ProductoDAO::getProduct($_POST['producto_id']));

        array_push($_SESSION['carrito'], $pedido);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function eliminar()
    {
        echo 'Producto eliminado';

        //$producto_id = $_POST['producto_id'];
        //ProductoDAO::deleteProduct($producto_id);

        header("Location:" . url);
    }

    public function modificar()
    {
        include_once 'Views/modificarProducto.php';
    }

    public function guardarCambios()
    {

        $producto_id = $_POST['producto_id'];
        $nombre_producto = $_POST['nombre_producto'];
        $descripcion = $_POST['descripcion'];
        $categoria_id = $_POST['categoria_id'];
        $coste_base = $_POST['coste_base'];

        ProductoDAO::modifyProduct($producto_id, $categoria_id, $nombre_producto, $descripcion, $coste_base);

        include_once 'Views/productoModificado.php';
    }
}
