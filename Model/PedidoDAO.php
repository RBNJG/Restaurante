<?php

include_once 'config/DataBase.php';
include_once 'Pedido.php';

class PedidoDAO
{

    //Función para obtener los pedidos de un usuario
    public static function getPedidos($id)
    {

        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "SELECT * FROM pedido WHERE usuario_id = ?";
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

    public static function newPedido($usuario_id,$fecha,$coste_total,$estado)
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

        // Obtener el número de filas afectadas
        $affected_rows = $stmt->affected_rows;

        // Cerrar la conexión
        $stmt->close();
        $connection->close();

        return $affected_rows;
    }
}
