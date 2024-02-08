<?php


class Pedido{

    private $pedido_id;
    private $usuario_id;
    private $fecha;
    private $coste_total;
    private $estado;
    private $descuento_aplicado;
    private $propina;

    public function __construct(){}


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
     * Get the value of coste_total
     */ 
    public function getCoste_total()
    {
        return $this->coste_total;
    }

    /**
     * Set the value of coste_total
     *
     * @return  self
     */ 
    public function setCoste_total($coste_total)
    {
        $this->coste_total = $coste_total;

        return $this;
    }

    /**
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get the value of descuento_aplicado
     */ 
    public function getDescuento_aplicado()
    {
        return $this->descuento_aplicado;
    }

    /**
     * Set the value of descuento_aplicado
     *
     * @return  self
     */ 
    public function setDescuento_aplicado($descuento_aplicado)
    {
        $this->descuento_aplicado = $descuento_aplicado;

        return $this;
    }

    /**
     * Get the value of propina
     */ 
    public function getPropina()
    {
        return $this->propina;
    }

    /**
     * Set the value of propina
     *
     * @return  self
     */ 
    public function setPropina($propina)
    {
        $this->propina = $propina;

        return $this;
    }
}