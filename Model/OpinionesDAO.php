<?php

include_once 'config/DataBase.php';
include_once 'Opiniones.php';

class OpinionesDAO
{
    //Función para obtener todas las opiniones
    public static function getAllOpiniones()
    {
        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "SELECT * FROM opiniones ORDER BY fecha DESC";
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
        $opiniones = null;

        if ($result) {
            while ($opinion = $result->fetch_object('Opiniones')) {
                $opiniones[] = $opinion;
            }

            $result->free();
        } else {
            echo "Error en la consulta: " . $connection->error;
        }

        // Cerrar la conexión
        $stmt->close();
        $connection->close();

        return $opiniones;
    }

    //Función para obtener opiniones con ciertas estrellas
    public static function getOpinionesByStars($estrellas)
    {

        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "SELECT * FROM opiniones WHERE estrellas = ?";
        $stmt = $connection->prepare($query);

        // Comprobar si la preparación de la sentencia ha sido correcta
        if (!$stmt) {
            die("Error de preparación: " . $connection->error);
        }

        // Enlazar los parámetros
        $stmt->bind_param("i", $estrellas);

        // Ejecutar la consulta
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . $stmt->error);
        }

         // Obtener el resultado
         $result = $stmt->get_result();
         $opiniones = null;
 
         if ($result) {
             while ($opinion = $result->fetch_object('Opiniones')) {
                 $opiniones[] = $opinion;
             }
 
             $result->free();
         } else {
             echo "Error en la consulta: " . $connection->error;
         }
 
         // Cerrar la conexión
         $stmt->close();
         $connection->close();
 
         return $opiniones;
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
        $pedidos = null;

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

    //Función para eliminar un pedido a través de su id
    public static function deletePedido($pedido_id)
    {
        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "DELETE FROM pedido WHERE pedido_id = ?";
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

    // Función para modificar los atributos de un producto en la base de datos
    public static function modifyPedido($coste_total,$estado,$pedido_id)
    {
        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "UPDATE pedido SET coste_total = ?, estado = ? WHERE pedido_id = ?";
        $stmt = $connection->prepare($query);

        // Comprobar si la preparación de la sentencia ha sido correcta
        if (!$stmt) {
            die("Error de preparación: " . $connection->error);
        }

        // Enlazar los parámetros
        $stmt->bind_param("dsi", $coste_total, $estado, $pedido_id);

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
