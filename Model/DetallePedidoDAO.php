<?php

include_once 'config/DataBase.php';
include_once 'DetallePedido.php';

class DetallePedidoDAO
{

    //Función para obtener los detalles de un pedido
    public static function getDetallePedido($pedido_id)
    {

        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "SELECT * FROM detalles_pedido WHERE pedido_id = ?";
        $stmt = $connection->prepare($query);

        // Comprobar si la preparación de la sentencia ha sido correcta
        if (!$stmt) {
            die("Error de preparación: " . $connection->error);
        }

        // Enlazar los parámetros
        $stmt->bind_param("i", $pedido_id);

        // Ejecutar la consulta
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . $stmt->error);
        }

        // Obtener el resultado
        $result = $stmt->get_result();

        if ($result) {
            while ($detalles = $result->fetch_object('DetallePedido')) {
                $detallesPedido[] = $detalles;
            }

            $result->free();
        } else {
            echo "Error en la consulta: " . $connection->error;
        }

        // Cerrar la conexión
        $stmt->close();
        $connection->close();

        return $detallesPedido;
    }

    //Función para obtener un detalle de pedido a través de su id
    public static function getDetalle($detalle_id)
    {
        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "SELECT * FROM detalles_pedido WHERE detalle_pedido_id = ?";
        $stmt = $connection->prepare($query);

        // Comprobar si la preparación de la sentencia ha sido correcta
        if (!$stmt) {
            die("Error de preparación: " . $connection->error);
        }

        // Enlazar los parámetros
        $stmt->bind_param("i", $detalle_id);

        // Ejecutar la consulta
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . $stmt->error);
        }

        // Obtener el resultado
        $result = $stmt->get_result();
        $detalle = null;

        if ($result) {
            $detalle = $result->fetch_object('DetallePedido');
            $result->free();
        } else {
            echo "Error en la consulta: " . $connection->error;
        }

        // Cerrar la conexión
        $stmt->close();
        $connection->close();

        return $detalle;
    }

    //Función para crear un nuevo detalle de pedido
    public static function newDetallePedido($pedido_id, $producto_id, $cantidad_producto, $subtotal)
    {

        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "INSERT INTO detalles_pedido (pedido_id,producto_id,cantidad_producto,subtotal) VALUES (?,?,?,?)";
        $stmt = $connection->prepare($query);

        // Comprobar si la preparación de la sentencia ha sido correcta
        if (!$stmt) {
            die("Error de preparación: " . $connection->error);
        }

        // Enlazar los parámetros
        $stmt->bind_param("iiid", $pedido_id, $producto_id, $cantidad_producto, $subtotal);

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

    //Función para eliminar los detalles de un pedido a través de la id del pedido
    public static function deleteDetalleByPedido($pedido_id)
    {
        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "DELETE FROM detalles_pedido WHERE pedido_id = ?";
        $stmt = $connection->prepare($query);

        // Comprobar si la preparación de la sentencia ha sido correcta
        if (!$stmt) {
            die("Error de preparación: " . $connection->error);
        }

        // Enlazar los parámetros
        $stmt->bind_param("i", $pedido_id);

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

    //Función para eliminar los detalles de un pedido modificado
    public static function deleteDetalle($idDetalles, $pedido_id)
    {
        $connection = DataBase::connect();

        // Crea un string de placeholders para utilizar en el NOT IN de la consulta select
        $placeholders = implode(',', array_fill(0, count($idDetalles), '?'));

        // Preparar la consulta
        $query = "DELETE FROM detalles_pedido WHERE pedido_id = ? AND detalle_pedido_id NOT IN ($placeholders)";
        $stmt = $connection->prepare($query);

        // Comprobar si la preparación de la sentencia ha sido correcta
        if (!$stmt) {
            die("Error de preparación: " . $connection->error);
        }

        // Creo un array de tipos de parámetros con el número de valores del array más 1 para el id del pedido
        $types = str_repeat('i', count($idDetalles) + 1);
        // Los junto para utilizar después en Bind_param
        $values = array_merge(array($pedido_id), $idDetalles);

        // Enlazamos los tipos de parámetros con el array que hemos creado anteriormente
        $stmt->bind_param($types, ...$values);

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
    public static function modifyDetallePedido($detalle_pedido_id, $cantidad_producto, $subtotal)
    {
        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "UPDATE detalles_pedido SET cantidad_producto = ?, subtotal = ? WHERE detalle_pedido_id = ?";
        $stmt = $connection->prepare($query);

        // Comprobar si la preparación de la sentencia ha sido correcta
        if (!$stmt) {
            die("Error de preparación: " . $connection->error);
        }

        // Enlazar los parámetros
        $stmt->bind_param("idi", $cantidad_producto, $subtotal, $detalle_pedido_id);

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
