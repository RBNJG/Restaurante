<?php
include_once 'Model/ProductoDAO.php';
include_once 'Model/CategoriaDAO.php';
include_once 'Model/Carrito.php';
include_once 'utils/Calculadora.php';

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
}
