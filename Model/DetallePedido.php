<?php

class DetallesPedido{

    private $detalles_pedido_id;
    private $pedido_id;
    private $producto;
    private $modificacion_id;
    private $cantidad_producto;
    private $subtotal;

    public function __construct(){}

    /**
     * Get the value of detalles_pedido_id
     */ 
    public function getDetalles_pedido_id()
    {
        return $this->detalles_pedido_id;
    }

    /**
     * Set the value of detalles_pedido_id
     *
     * @return  self
     */ 
    public function setDetalles_pedido_id($detalles_pedido_id)
    {
        $this->detalles_pedido_id = $detalles_pedido_id;

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

    /**
     * Get the value of producto
     */ 
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set the value of producto
     *
     * @return  self
     */ 
    public function setProducto($producto)
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * Get the value of modificacion_id
     */ 
    public function getModificacion_id()
    {
        return $this->modificacion_id;
    }

    /**
     * Set the value of modificacion_id
     *
     * @return  self
     */ 
    public function setModificacion_id($modificacion_id)
    {
        $this->modificacion_id = $modificacion_id;

        return $this;
    }

    /**
     * Get the value of cantidad_producto
     */ 
    public function getCantidad_producto()
    {
        return $this->cantidad_producto;
    }

    /**
     * Set the value of cantidad_producto
     *
     * @return  self
     */ 
    public function setCantidad_producto($cantidad_producto)
    {
        $this->cantidad_producto = $cantidad_producto;

        return $this;
    }

    /**
     * Get the value of subtotal
     */ 
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * Set the value of subtotal
     *
     * @return  self
     */ 
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;

        return $this;
    }
}