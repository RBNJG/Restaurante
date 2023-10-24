<?php
include_once 'Model/ProductoDAO.php';
include_once 'Model/CategoriaDAO.php';

// Creamos el controlador de pedidos

class pedidoController{

    public function index(){
        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/panelPedido.php';

        //Footer
    }

    public function compra(){
        echo 'Página de compras';
    }
}