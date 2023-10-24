<?php

class Categoria{

    private $categoria_id;
    private $nombre_categoria;

    public function __construct(){}
    

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
     * Get the value of nombre_categoria
     */ 
    public function getNombre_categoria()
    {
        return $this->nombre_categoria;
    }

    /**
     * Set the value of nombre_categoria
     *
     * @return  self
     */ 
    public function setNombre_categoria($nombre_categoria)
    {
        $this->nombre_categoria = $nombre_categoria;

        return $this;
    }
}