<?php

// Creamos el controlador de la página de opiniones

class OpinionesController
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