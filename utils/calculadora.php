<?php
include_once 'Model/Carrito.php';
include_once 'Model/producto.php';

class Calculadora
{

    public static function cantidadCarrito($carrito)
    {
        $cantidad = 0;
        foreach ($carrito as $producto) {
            $cantidad = $cantidad + $producto->getCantidad();
        }

        return $cantidad;
    }

    /**
     * Devuelve el coste total de un producto según la cantidad de este
     *
     * @return  subtotal
     */
    public static function totalProducto($producto,$desc)
    {
        $total = 0;
        if($producto->getProducto()->getDescuento() == 0 or $desc == 1){
            $total = round($producto->getProducto()->getCoste_base() * $producto->getCantidad(), 2);
        } else{
            $total = round(Calculadora::precioDescuento($producto) * $producto->getCantidad(), 2);
        }
        

        return number_format($total, 2);
    }

    /**
     * Devuelve el coste de los productos del carrito sin sumar el envío
     *
     * @return  subtotal
     */
    public static function subtotal($carrito)
    {
        $subtotal = 0;

        foreach ($carrito as $producto) {
            if ($producto->getProducto()->getDescuento() == 0) {
                $subtotal = $subtotal + $producto->getProducto()->getCoste_base() * $producto->getCantidad();
            } else {
                $subtotal = $subtotal + Calculadora::precioDescuento($producto) * $producto->getCantidad();
            }
        }

        return $subtotal;
    }

    /**
     * Comprueba si alguno de los artículos del carrito no tiene envío gratis para sumar el coste de envío
     *
     * @return  costeEnvio
     */
    public static function costeEnvio($carrito)
    {
        $coste = 0;

        foreach ($carrito as $producto) {
            if ($producto->getProducto()->getEnvio_gratis() == 0) {
                $coste = 3;
            }
        }

        return $coste;
    }

    /**
     * Devuelve el coste de los productos del carrito sumando el envío
     *
     * @return  total
     */
    public static function total($carrito)
    {
        $total = Calculadora::subtotal($carrito) + Calculadora::costeEnvio($carrito);

        return $total;
    }

    public static function countEstrellas($productos, $estrellas)
    {
        $total = 0;

        foreach ($productos as $producto) {
            if ($producto->getEstrellas() == $estrellas) {
                $total++;
            }
        }

        return $total;
    }

    public static function descuento($producto)
    {
        $descuento = round($producto->getProducto()->getCoste_base() - ($producto->getProducto()->getCoste_base() * $producto->getProducto()->getDescuento()), 2);

        return $descuento;
    }

    public static function precioDescuento($producto)
    {
        $precioDescuento = number_format($producto->getProducto()->getCoste_base() - Calculadora::descuento($producto), 2);

        return $precioDescuento;
    }
}