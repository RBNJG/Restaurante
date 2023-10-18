<?php

class Producto
{

    private $producto_id;
    private $categoria_id;
    private $nombre_producto;
    private $descripcion;
    private $coste_base;

    public function __construct($producto_id, $categoria_id, $nombre_producto, $descripcion, $coste_base)
    {
        $this->producto_id = $producto_id;
        $this->categoria_id = $categoria_id;
    }



    
}
