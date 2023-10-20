<?php

include_once 'config/dataBase.php';
include_once 'Producto.php';

class ProductoDAO
{

    public static function getAllProducts()
    {
        $connection = DataBase::connect();


        if ($result = $connection->query("SELECT * FROM producto")) {
            while ($row = $result->fetch_assoc()) {
                $producto = new Producto();
                $producto->setProducto_id($row['producto_id'])
                        ->setCategoria_id($row['categoria_id'])
                        ->setNombre_producto($row['nombre_producto'])
                        ->setDescripcion($row['descripcion'])
                        ->setCoste_base($row['coste_base']);

                $productos[] = $producto;
            }
            $result->free();
        } else {
            echo "Error en la consulta: " . $connection->error;
        }

        $connection->close();
        return $productos;
    }
}
