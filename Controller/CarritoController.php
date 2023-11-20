<?php
include_once 'Model/ProductoDAO.php';
include_once 'Model/CategoriaDAO.php';

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

}
