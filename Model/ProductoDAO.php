<?php

include_once 'config/DataBase.php';
include_once 'Producto.php';

class ProductoDAO
{
    // Función para obtener todos los productos de la base de datos
    public static function getAllProducts()
    {
        $connection = DataBase::connect();

        // Preparar y ejecutar la consulta
        $query = "SELECT * FROM producto ORDER BY categoria_id, coste_base";
        $stmt = $connection->prepare($query);
        // Comprobar si la preparación de la sentencia ha sido correcta
        if (!$stmt) {
            die("Error de preparación: " . $connection->error);
        }

        // Ejecutar la consulta
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . $stmt->error);
        }

        // Obtener el resultado
        $result = $stmt->get_result();


        if ($result) {
            // Mientras haya productos en la base de datos, los voy creando y guardando en un array
            // Con fectch_object le decimos el objeto de la base de datos que queremos, y si los atributos 
            // son iguales que en la base de datos y el constructor está vacío, los crea automáticamente.
            while ($producto = $result->fetch_object('Producto')) {
                $productos[] = $producto;
            }

            $result->free();
        } else {
            echo "Error en la consulta: " . $connection->error;
        }

        $connection->close();
        return $productos;
    }

    // Función para obtener los datos de un producto en concreto pasando si id
    public static function getProduct($id)
    {
        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "SELECT * FROM producto WHERE producto_id = ?";
        $stmt = $connection->prepare($query);

        // Comprobar si la preparación de la sentencia ha sido correcta
        if (!$stmt) {
            die("Error de preparación: " . $connection->error);
        }

        // Enlazar los parámetros
        $stmt->bind_param("i", $id);

        // Ejecutar la consulta
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . $stmt->error);
        }

        // Obtener el resultado
        $result = $stmt->get_result();
        $producto = null;

        if ($result) {
            $producto = $result->fetch_object('Producto');
            $result->free();
        } else {
            echo "Error en la consulta: " . $connection->error;
        }

        // Cerrar la conexión
        $stmt->close();
        $connection->close();

        return $producto;
    }

    // Función para modificar los atributos de un producto en la base de datos
    public static function modifyProduct($producto_id, $categoria_id, $nombre_producto, $descripcion, $coste_base,$imagen)
    {
        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "UPDATE producto SET categoria_id = ?, nombre_producto = ?, descripcion = ?, coste_base = ?, imagen = ? WHERE producto_id = ?";
        $stmt = $connection->prepare($query);

        // Comprobar si la preparación de la sentencia ha sido correcta
        if (!$stmt) {
            die("Error de preparación: " . $connection->error);
        }

        // Enlazar los parámetros
        $stmt->bind_param("issssi", $categoria_id, $nombre_producto, $descripcion, $coste_base, $imagen, $producto_id);

        // Ejecutar la consulta
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . $stmt->error);
        }

        // Obtener el número de filas afectadas
        $affected_rows = $stmt->affected_rows;

        // Cerrar la conexión
        $stmt->close();
        $connection->close();

        return $affected_rows;
    }

    // Función para eliminar un producto en la base de datos pasando su id
    public static function deleteProduct($id)
    {
        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "DELETE FROM producto WHERE producto_id = ?";
        $stmt = $connection->prepare($query);

        // Comprobar si la preparación de la sentencia ha sido correcta
        if (!$stmt) {
            die("Error de preparación: " . $connection->error);
        }

        // Enlazar los parámetros
        $stmt->bind_param("i", $id);

        // Ejecutar la consulta
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . $stmt->error);
        }

        // Obtener el número de filas afectadas
        $result = $stmt->affected_rows;

        // Cerrar la conexión
        $stmt->close();
        $connection->close();

        return $result;
    }

    // Función para modificar los atributos de un producto en la base de datos
    public static function newProduct($categoria_id, $nombre_producto, $descripcion, $coste_base,$imagen)
    {
        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "INSERT INTO producto (categoria_id, nombre_producto, descripcion, coste_base, imagen) VALUES (?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($query);

        // Comprobar si la preparación de la sentencia ha sido correcta
        if (!$stmt) {
            die("Error de preparación: " . $connection->error);
        }

        // Enlazar los parámetros
        $stmt->bind_param("issss", $categoria_id, $nombre_producto, $descripcion, $coste_base, $imagen);

        // Ejecutar la consulta
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . $stmt->error);
        }

        // Obtener el número de filas afectadas
        $affected_rows = $stmt->affected_rows;

        // Cerrar la conexión
        $stmt->close();
        $connection->close();

        return $affected_rows;
    }
    
}
