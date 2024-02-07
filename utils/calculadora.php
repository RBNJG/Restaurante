<?php
include_once 'Model/Carrito.php';
include_once 'Model/Producto.php';
include_once 'Model/ProductoDAO.php';

class Calculadora
{
    /**
     * Devuelve la cantidad de productos que hay en el carrito
     */
    public static function cantidadCarrito($carrito)
    {
        $cantidad = 0;
        foreach ($carrito as $producto) {
            $cantidad = $cantidad + $producto->getCantidad();
        }

        return $cantidad;
    }

    /**
     * Devuelve la cantidad de productos en la carta con la cantidad de estrellas que recibe el método
     */
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

    /**
     * Devuelve el coste total de un producto según la cantidad de este
     *
     * 
     */
    public static function totalProducto($producto, $cantidad, $desc)
    {
        $total = 0;
        if (is_a($producto, 'Producto')) {
            if ($producto->getDescuento() == 0 or $desc == 1) {
                $total = round($producto->getCoste_base() * $cantidad, 2);
            } else {
                $total = round(Calculadora::precioDescuento($producto) * $cantidad, 2);
            }
        } elseif (is_a($producto, 'Carrito')) {
            if ($producto->getProducto()->getDescuento() == 0 or $desc == 1) {
                $total = round($producto->getProducto()->getCoste_base() * $producto->getCantidad(), 2);
            } else {
                $total = round(Calculadora::precioDescuento($producto) * $producto->getCantidad(), 2);
            }
        }


        return number_format($total, 2);
    }

    /**
     * Devuelve el la cantidad rebajada sobre un producto con descuento
     * 
     * 
     */
    public static function descuento($producto)
    {
        if (is_a($producto, 'Producto')) {
            $descuento = round($producto->getCoste_base() - ($producto->getCoste_base() * $producto->getDescuento()), 2);
        } elseif (is_a($producto, 'Carrito')) {
            $descuento = round($producto->getProducto()->getCoste_base() - ($producto->getProducto()->getCoste_base() * $producto->getProducto()->getDescuento()), 2);
        }

        return $descuento;
    }

    /**
     * Devuelve el precio de un producto con el descuento aplicado
     * 
     *
     */
    public static function precioDescuento($producto)
    {
        if (is_a($producto, 'Producto')) {
            $precioDescuento = number_format($producto->getCoste_base() - Calculadora::descuento($producto), 2);
        } elseif (is_a($producto, 'Carrito')) {
            $precioDescuento = number_format($producto->getProducto()->getCoste_base() - Calculadora::descuento($producto), 2);
        }

        return $precioDescuento;
    }

    /**
     * Comprueba si alguno de los artículos del carrito no tiene envío gratis para sumar el coste de envío
     *
     * 
     */
    public static function costeEnvio($carrito)
    {
        $coste = 0;

        foreach ($carrito as $producto) {
            if (is_a($producto, 'Carrito')) {
                if ($producto->getProducto()->getEnvio_gratis() == 0) {
                    $coste = 3;

                    break;
                }
            } else if (is_a($producto, 'DetallePedido')) {
                if (ProductoDAO::getProduct($producto->getProducto_id())->getEnvio_gratis() == 0) {
                    $coste = 3;

                    break;
                }
            }
        }

        return $coste;
    }

    /**
     * Devuelve el coste de los productos del carrito sin sumar el envío
     *
     * 
     */
    public static function subtotal($carrito)
    {
        $subtotal = 0;

        foreach ($carrito as $producto) {
            if (is_a($producto, 'Carrito')) {
                if ($producto->getProducto()->getDescuento() == 0) {
                    $subtotal = $subtotal + $producto->getProducto()->getCoste_base() * $producto->getCantidad();
                } else {
                    $subtotal = $subtotal + Calculadora::precioDescuento($producto) * $producto->getCantidad();
                }
            } else if (is_a($producto, 'DetallePedido')) {
                $productoPedido = ProductoDAO::getProduct($producto->getProducto_id());
                if ($productoPedido->getDescuento() == 0) {
                    $subtotal = $subtotal + $productoPedido->getCoste_base() * $producto->getCantidad_producto();
                } else {
                    $subtotal = $subtotal + Calculadora::precioDescuento($productoPedido) * $producto->getCantidad_producto();
                }
            }
        }

        return $subtotal;
    }

    /**
     * Devuelve el coste de los productos del carrito sumando el envío
     *
     * 
     */
    public static function total($carrito)
    {
        $total = Calculadora::subtotal($carrito) + Calculadora::costeEnvio($carrito);

        return $total;
    }
   

    public static function porcentajeOpiniones($total,$opiniones){
        if($opiniones == null || $total == null){
            $porcentaje = 0;
        }else{
            $porcentaje = round(($opiniones/$total)*100);
        }
        
        return $porcentaje;
    }
}
