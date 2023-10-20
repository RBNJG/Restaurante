<?php
include_once 'Model/ProductoDAO.php';

// Creamos el controlador de pedidos

class pedidoController{

    public function index(){
        //Cabecera

        //Panel
        $productos = ProductoDAO::getAllProducts();
        
        foreach ($productos as $producto) {
            echo $producto ->getNombre_producto() . "<br>";
        }
        //Footer
    }

    public function compra(){
        echo 'Página de compras';
    }
}