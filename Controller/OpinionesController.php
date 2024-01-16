<?php

include_once 'Model/OpinionesDAO.php';
include_once 'utils/Calculadora.php';

// Creamos el controlador de la página de reseñas

class OpinionesController
{

    public function index()
    {
        $opiniones = OpinionesDAO::getAllOpiniones();

        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/opiniones.php';
        //Footer
        include_once 'Views/footer.php';
    }
}