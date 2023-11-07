<?php
include_once 'Model/ProductoDAO.php';
include_once 'Model/CategoriaDAO.php';

// Creamos el controlador de la página home

class HomeController
{

    public function index()
    {
        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/home.php';
        //Footer
        include_once 'Views/footer.php';
    }

    public function compra()
    {
        echo 'Página de compras';
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