<?php

include_once 'config/DataBase.php';
include_once 'Usuario.php';

class UsuarioDAO
{
    // Función para obtener todos los productos de la base de datos
    public static function getAllUsers()
    {
        $connection = DataBase::connect();

        // Preparar y ejecutar la consulta
        $query = "SELECT * FROM usuario";
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
            while ($usuario = $result->fetch_object('Usuario')) {
                $usuarios[] = $usuario;
            }

            $result->free();
        } else {
            echo "Error en la consulta: " . $connection->error;
        }

        $connection->close();
        return $usuarios;
    }

    // Función para obtener los datos de un producto en concreto pasando si id
    public static function getUser($id)
    {
        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "SELECT * FROM usuario WHERE usuario_id = ?";
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
        $usuario = null;

        if ($result) {
            $usuario = $result->fetch_object('Usuario');
            $result->free();
        } else {
            echo "Error en la consulta: " . $connection->error;
        }

        // Cerrar la conexión
        $stmt->close();
        $connection->close();

        return $usuario;
    }

    // Función para comprobar si el usuario ya tiene cuenta a través del email
    public static function getUserByMail($mail)
    {
        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "SELECT * FROM usuario WHERE email = ?";
        $stmt = $connection->prepare($query);

        // Comprobar si la preparación de la sentencia ha sido correcta
        if (!$stmt) {
            die("Error de preparación: " . $connection->error);
        }

        // Enlazar los parámetros
        $stmt->bind_param("s", $mail);

        // Ejecutar la consulta
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . $stmt->error);
        }

        // Obtener el resultado
        $result = $stmt->get_result();
        $usuario = null;

        if ($result && $result->num_rows > 0) {
            $usuario = $result->fetch_object('Usuario');
            $result->free();
        }
        
        //Cerramos la conexión
        $stmt->close();
        $connection->close();
        
        return $usuario;
    }

    //Función para registrar a un nuevo usuario
    public static function newUser($nombre,$apellidos,$direccion,$email,$telefono,$password,$rol)
    {
        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "INSERT INTO usuario (rol_id,nombre,apellidos,direccion,email,telefono,password) VALUES (?,?,?,?,?,?,?)";
        $stmt = $connection->prepare($query);

        // Comprobar si la preparación de la sentencia ha sido correcta
        if (!$stmt) {
            die("Error de preparación: " . $connection->error);
        }

        // Enlazar los parámetros
        $stmt->bind_param("issssis", $rol, $nombre, $apellidos, $direccion, $email,$telefono,$password);

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
