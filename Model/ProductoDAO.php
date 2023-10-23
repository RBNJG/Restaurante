<?php

include_once 'config/dataBase.php';
include_once 'Producto.php';

class ProductoDAO
{

    public static function getAllProducts()
    {
        $connection = DataBase::connect();


        if ($result = $connection->query("SELECT * FROM producto")) {

            // De esta manera crea manualmente los productos a partir de los set
            /*while ($row = $result->fetch_assoc()) {
                $producto = new Producto();
                $producto->setProducto_id($row['producto_id'])
                        ->setCategoria_id($row['categoria_id'])
                        ->setNombre_producto($row['nombre_producto'])
                        ->setDescripcion($row['descripcion'])
                        ->setCoste_base($row['coste_base']);

                $productos[] = $producto;
            }*/

            // Mientras haya productos en la base de datos, los voy creando y guardando en un array
            // Con fectch_object le decimos el objeto de la base de datos que queremos, y si los atributos 
            // son iguales que en la base de datos y el constructor está vacío, los crea automáticamente.
            while ($producto = $result->fetch_object('producto')) {
                

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
