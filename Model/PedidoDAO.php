<?php

include_once 'config/DataBase.php';
include_once 'Pedido.php';

class PedidoDAO
{

    //Función para obtener un pedido desde su id
    public static function getPedido($id)
    {

        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "SELECT * FROM pedido WHERE pedido_id = ?";
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
        $pedido = null;

        if ($result) {
            $pedido = $result->fetch_object('Pedido');
            $result->free();
        } else {
            echo "Error en la consulta: " . $connection->error;
        }

        // Cerrar la conexión
        $stmt->close();
        $connection->close();

        return $pedido;
    }

    //Función para obtener los pedidos de un usuario
    public static function getPedidos($id)
    {

        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "SELECT * FROM pedido WHERE usuario_id = ? ORDER BY fecha DESC";
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
            while ($pedido = $result->fetch_object('Pedido')) {
                $pedidos[] = $pedido;
            }

            $result->free();
        } else {
            echo "Error en la consulta: " . $connection->error;
        }

        // Cerrar la conexión
        $stmt->close();
        $connection->close();

        return $pedidos;
    }

    public static function newPedido($usuario_id, $fecha, $coste_total, $estado)
    {

        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "INSERT INTO pedido (usuario_id,fecha,coste_total,estado) VALUES (?,?,?,?)";
        $stmt = $connection->prepare($query);

        // Comprobar si la preparación de la sentencia ha sido correcta
        if (!$stmt) {
            die("Error de preparación: " . $connection->error);
        }

        // Enlazar los parámetros
        $stmt->bind_param("isds", $usuario_id, $fecha, $coste_total, $estado);

        // Ejecutar la consulta
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . $stmt->error);
        }

        // Obtener el ID del pedido insertado
        $pedidoId = $connection->insert_id;

        // Cerrar la conexión
        $stmt->close();
        $connection->close();

        return $pedidoId;
    }
}
