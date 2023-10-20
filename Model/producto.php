<?php

class Producto
{

    private $producto_id;
    private $categoria_id;
    private $nombre_producto;
    private $descripcion;
    private $coste_base;


    public function __construct()
    {
    }


    /* Hay que hacer un constructor vacío para poder crear objetos con la base de datos
    public function __construct($producto_id, $categoria_id, $nombre_producto, $descripcion, $coste_base)
    {
        $this->producto_id = $producto_id;
        $this->categoria_id = $categoria_id;
    }
    */

    /**
     * Get the value of producto_id
     */ 
    public function getProducto_id()
    {
        return $this->producto_id;
    }

    /**
     * Set the value of producto_id
     *
     * @return  self
     */ 
    public function setProducto_id($producto_id)
    {
        $this->producto_id = $producto_id;

        return $this;
    }

    /**
     * Get the value of categoria_id
     */ 
    public function getCategoria_id()
    {
        return $this->categoria_id;
    }

    /**
     * Set the value of categoria_id
     *
     * @return  self
     */ 
    public function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $categoria_id;

        return $this;
    }

    /**
     * Get the value of nombre_producto
     */ 
    public function getNombre_producto()
    {
        return $this->nombre_producto;
    }

    /**
     * Set the value of nombre_producto
     *
     * @return  self
     */ 
    public function setNombre_producto($nombre_producto)
    {
        $this->nombre_producto = $nombre_producto;

        return $this;
    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of coste_base
     */ 
    public function getCoste_base()
    {
        return $this->coste_base;
    }

    /**
     * Set the value of coste_base
     *
     * @return  self
     */ 
    public function setCoste_base($coste_base)
    {
        $this->coste_base = $coste_base;

        return $this;
    }
}
