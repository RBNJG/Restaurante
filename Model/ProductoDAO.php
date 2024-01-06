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

    // Función para obtener todos los productos de la base de datos
    public static function getProductsWithFilter($estrellas4, $estrellas3, $precioMin, $precioMax, $envio, $descuento)
    {
        $connection = DataBase::connect();

        // Preparar y ejecutar la consulta, el WHERE 1 = 1 es para facilitar la adición de condiciones
        $query = "SELECT * FROM producto WHERE 1 = 1";

        $parametros = [];
        $tipos = "";

        if ($estrellas4) {
            $query .= " AND estrellas = 4";
        }

        if ($estrellas3) {
            $query .= " AND estrellas = 3";
        }

        if ($precioMin !== "") {
            $query .= " AND coste_base >= ?";
            $parametros[] = $precioMin;
            $tipos .= "d";
        }

        if ($precioMax !== "") {
            $query .= " AND coste_base <= ?";
            $parametros[] = $precioMax;
            $tipos .= "d";
        }

        if ($envio) {
            $query .= " AND envio_gratis = 1";
        }

        if ($descuento) {
            $query .= " AND descuento <> 0";
        }

        $query .= " ORDER BY categoria_id, coste_base";


        $stmt = $connection->prepare($query);
        // Comprobar si la preparación de la sentencia ha sido correcta
        if (!$stmt) {
            die("Error de preparación: " . $connection->error);
        }

        if (!empty($parametros)) {
            $stmt->bind_param($tipos, ...$parametros);
        }

        // Ejecutar la consulta
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . $stmt->error);
        }

        // Obtener el resultado
        $result = $stmt->get_result();

        //Guardamos los resultados en un array de productos
        if ($result) {
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
    public static function modifyProduct($producto_id, $categoria_id, $nombre_producto, $descripcion, $coste_base, $imagen, $envio_gratis)
    {
        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "UPDATE producto SET categoria_id = ?, nombre_producto = ?, descripcion = ?, coste_base = ?, imagen = ?, envio_gratis = ? WHERE producto_id = ?";
        $stmt = $connection->prepare($query);

        // Comprobar si la preparación de la sentencia ha sido correcta
        if (!$stmt) {
            die("Error de preparación: " . $connection->error);
        }

        // Enlazar los parámetros
        $stmt->bind_param("issssii", $categoria_id, $nombre_producto, $descripcion, $coste_base, $imagen, $envio_gratis, $producto_id);

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
    public static function newProduct($categoria_id, $nombre_producto, $descripcion, $coste_base, $imagen, $envio_gratis)
    {
        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "INSERT INTO producto (categoria_id, nombre_producto, descripcion, coste_base, imagen, envio_gratis) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($query);

        // Comprobar si la preparación de la sentencia ha sido correcta
        if (!$stmt) {
            die("Error de preparación: " . $connection->error);
        }

        // Enlazar los parámetros
        $stmt->bind_param("issssi", $categoria_id, $nombre_producto, $descripcion, $coste_base, $imagen, $envio_gratis);

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

    // Función para obtener el precio más bajo de los productos
    public static function getCheaperPrice()
    {
        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "SELECT MIN(coste_base) AS precio_minimo FROM producto WHERE categoria_id != 7 AND categoria_id != 8";
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
            $fila = $result->fetch_assoc();
            if ($fila) {
                $precio = $fila['precio_minimo'];
            }
            $result->free();
        } else {
            echo "Error en la consulta: " . $connection->error;
        }

        // Cerrar la conexión
        $stmt->close();
        $connection->close();

        return $precio;
    }
}
