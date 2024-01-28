<?php

class Opiniones {

    private $opinion_id;
    private $usuario_id;
    private $opinion;
    private $estrellas;
    private $util_si;
    private $util_no;
    private $fecha;
    private $pedido_id;

    /**
     * Get the value of opinion_id
     */ 
    public function getOpinion_id()
    {
        return $this->opinion_id;
    }

    /**
     * Set the value of opinion_id
     *
     * @return  self
     */ 
    public function setOpinion_id($opinion_id)
    {
        $this->opinion_id = $opinion_id;

        return $this;
    }

    /**
     * Get the value of usuario_id
     */ 
    public function getUsuario_id()
    {
        return $this->usuario_id;
    }

    /**
     * Set the value of usuario_id
     *
     * @return  self
     */ 
    public function setUsuario_id($usuario_id)
    {
        $this->usuario_id = $usuario_id;

        return $this;
    }

    /**
     * Get the value of opinion
     */ 
    public function getOpinion()
    {
        return $this->opinion;
    }

    /**
     * Set the value of opinion
     *
     * @return  self
     */ 
    public function setOpinion($opinion)
    {
        $this->opinion = $opinion;

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

    /**
     * Get the value of util_si
     */ 
    public function getUtil_si()
    {
        return $this->util_si;
    }

    /**
     * Set the value of util_si
     *
     * @return  self
     */ 
    public function setUtil_si($util_si)
    {
        $this->util_si = $util_si;

        return $this;
    }

    /**
     * Get the value of util_no
     */ 
    public function getUtil_no()
    {
        return $this->util_no;
    }

    /**
     * Set the value of util_no
     *
     * @return  self
     */ 
    public function setUtil_no($util_no)
    {
        $this->util_no = $util_no;

        return $this;
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of pedido_id
     */ 
    public function getPedido_id()
    {
        return $this->pedido_id;
    }

    /**
     * Set the value of pedido_id
     *
     * @return  self
     */ 
    public function setPedido_id($pedido_id)
    {
        $this->pedido_id = $pedido_id;

        return $this;
    }
}