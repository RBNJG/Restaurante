<?php
include_once 'Model/ProductoDAO.php';

// Creamos el controlador de pedidos

class pedidoController{

    public function index(){
        //Cabecera

        //Panel
        var_dump(ProductoDAO::getAllProducts());
        //Footer
    }

    public function compra(){
        echo 'Página de compras';
    }
}