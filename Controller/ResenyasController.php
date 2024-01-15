<?php

// Creamos el controlador de la página de opiniones

class ResenyasController
{

    public function index()
    {
        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/resenyas.php';
        //Footer
        include_once 'Views/footer.php';
    }
}