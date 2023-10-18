<?php

include_once 'config/dataBase.php';

class ProductoDAO{

    public static function getAllProducts(){
        $connection = DataBase::connect();


        if($result = $connection->query("SELECT * FROM producto")){
            while($producto = $result->fetch_array()){
                echo $producto-> getnNombre_producto;
            }
        }
    }
}