<?php

class Producto
{

    private $producto_id;
    private $categoria_id;
    private $nombre_producto;
    private $descripcion;
    private $coste_base;
    private $imagen;
    private $descuento;
    private $envio_gratis;
    private $opiniones;
    private $estrellas; 


    public function __construct(){}


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

    /**
     * Get the value of imagen
     */ 
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set the value of imagen
     *
     * @return  self
     */ 
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get the value of descuento
     */ 
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set the value of descuento
     *
     * @return  self
     */ 
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;

        return $this;
    }

    /**
     * Get the value of envio_gratis
     */ 
    public function getEnvio_gratis()
    {
        return $this->envio_gratis;
    }

    /**
     * Set the value of envio_gratis
     *
     * @return  self
     */ 
    public function setEnvio_gratis($envio_gratis)
    {
        $this->envio_gratis = $envio_gratis;

        return $this;
    }

    /**
     * Get the value of opiniones
     */ 
    public function getOpiniones()
    {
        return $this->opiniones;
    }

    /**
     * Set the value of opiniones
     *
     * @return  self
     */ 
    public function setOpiniones($opiniones)
    {
        $this->opiniones = $opiniones;

        return $this;
    }

    /**
     * Get the value of estrellas
     */ 
    public function getEstrellas()
    {
        return $this->estrellas;
    }

    /**
     * Set the value of estrellas
     *
     * @return  self
     */ 
    public function setEstrellas($estrellas)
    {
        $this->estrellas = $estrellas;

        return $this;
    }


}
