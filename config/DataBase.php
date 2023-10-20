<?php

class DataBase{
    public static function connect($host='localhost',$user='root',$pwd='',$db='restaurante'){
        $connection = new mysqli($host,$user,$pwd,$db);

        if ($connection == false) {
            die('Error de conexión:' . $connection->connect_error);
        }else{
            return $connection;
        }
    }
}