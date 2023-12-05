<?php

include_once 'config/DataBase.php';
include_once 'DetallePedido.php';

class DetallePedidoDAO{

    //Función para obtener los detalles de un pedido
    public static function getDetallePedido($id)
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
        $stmt->bind_param("i", $id);

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

    public static function newDetallePedido($pedido_id,$producto_id,$modificacion_id,$cantidad_producto,$subtotal)
    {

        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "INSERT INTO detalles_pedido (pedido_id,producto_id,modificacion_id,cantidad_producto,subtotal) VALUES (?,?,?,?,?)";
        $stmt = $connection->prepare($query);

        // Comprobar si la preparación de la sentencia ha sido correcta
        if (!$stmt) {
            die("Error de preparación: " . $connection->error);
        }

        // Enlazar los parámetros
        $stmt->bind_param("iiiid", $pedido_id, $producto_id, $modificacion_id, $cantidad_producto,$subtotal);

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