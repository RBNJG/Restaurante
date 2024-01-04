<?php

include_once 'config/DataBase.php';
include_once 'Usuario.php';
include_once 'UsuarioComun.php';
include_once 'Administrador.php';

class UsuarioDAO
{
    // Función para obtener todos los usuarios de la base de datos
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
            while ($usuarioData = $result->fetch_assoc()) {

                if ($usuarioData) {
                    // Determinamos la clase segun el rol_id
                    if ($usuarioData['rol_id'] == 1) {
                        $usuario = new Administrador();
                        // establecemos las propiedades manualmente
                        $usuario->setUsuario_id($usuarioData['usuario_id']);
                        $usuario->setRol_id($usuarioData['rol_id']);
                        $usuario->setNombre($usuarioData['nombre']);
                        $usuario->setApellidos($usuarioData['apellidos']);
                        $usuario->setDireccion($usuarioData['direccion']);
                        $usuario->setEmail($usuarioData['email']);
                        $usuario->setTelefono($usuarioData['telefono']);
                        $usuario->setPassword($usuarioData['password']);
                        $usuario->setArea_responsable($usuarioData['area_responsable']);

                        $usuarios[] = $usuario;
                    } else {
                        $usuario = new UsuarioComun();
                        // establecemos las propiedades manualmente
                        $usuario->setUsuario_id($usuarioData['usuario_id']);
                        $usuario->setRol_id($usuarioData['rol_id']);
                        $usuario->setNombre($usuarioData['nombre']);
                        $usuario->setApellidos($usuarioData['apellidos']);
                        $usuario->setDireccion($usuarioData['direccion']);
                        $usuario->setEmail($usuarioData['email']);
                        $usuario->setTelefono($usuarioData['telefono']);
                        $usuario->setPassword($usuarioData['password']);
                        $usuario->setPuntos_fidelidad($usuarioData['puntos_fidelidad']);

                        $usuarios[] = $usuario;
                    }

                    $result->free();
                } else {
                    echo "Error en la consulta: " . $connection->error;
                }
            }
        }

        /*    
        if ($result) {
            // Mientras haya usuarios en la base de datos, los voy creando y guardando en un array
            // Con fetch_object le decimos el objeto de la base de datos que queremos, y si los atributos 
            // son iguales que en la base de datos y el constructor está vacío, los crea automáticamente.
            while ($usuario = $result->fetch_object('Usuario')) {
                $usuarios[] = $usuario;
            }

            $result->free();
        } else {
            echo "Error en la consulta: " . $connection->error;
        }
        */

        $connection->close();
        return $usuarios;
    }

    // Función para obtener los datos de un usuario en concreto pasando su id
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
            $usuarioData = $result->fetch_assoc();

            if ($usuarioData) {
                // Determinamos la clase segun el rol_id
                if ($usuarioData['rol_id'] == 1) {
                    $usuario = new Administrador();
                    // establecemos las propiedades manualmente
                    $usuario->setUsuario_id($usuarioData['usuario_id']);
                    $usuario->setRol_id($usuarioData['rol_id']);
                    $usuario->setNombre($usuarioData['nombre']);
                    $usuario->setApellidos($usuarioData['apellidos']);
                    $usuario->setDireccion($usuarioData['direccion']);
                    $usuario->setEmail($usuarioData['email']);
                    $usuario->setTelefono($usuarioData['telefono']);
                    $usuario->setPassword($usuarioData['password']);
                    $usuario->setArea_responsable($usuarioData['area_responsable']);

                } else {
                    $usuario = new UsuarioComun();
                    // establecemos las propiedades manualmente
                    $usuario->setUsuario_id($usuarioData['usuario_id']);
                    $usuario->setRol_id($usuarioData['rol_id']);
                    $usuario->setNombre($usuarioData['nombre']);
                    $usuario->setApellidos($usuarioData['apellidos']);
                    $usuario->setDireccion($usuarioData['direccion']);
                    $usuario->setEmail($usuarioData['email']);
                    $usuario->setTelefono($usuarioData['telefono']);
                    $usuario->setPassword($usuarioData['password']);
                    $usuario->setPuntos_fidelidad($usuarioData['puntos_fidelidad']);

                }

                $result->free();
            } else {
                echo "Error en la consulta: " . $connection->error;
            }
        }

        /*
        if ($result) {
            $usuario = $result->fetch_object('Usuario');
            $result->free();
        } else {
            echo "Error en la consulta: " . $connection->error;
        }
        */

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
    public static function newUser($nombre, $apellidos, $direccion, $email, $telefono, $password, $rol)
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
        $stmt->bind_param("issssis", $rol, $nombre, $apellidos, $direccion, $email, $telefono, $password);

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

    //Función para modificar los datos de un usuario
    public static function modifyUser($nombre, $apellidos, $direccion, $email, $telefono, $id)
    {
        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "UPDATE usuario SET nombre = ?, apellidos = ?, direccion = ?, email = ?, telefono = ? WHERE usuario_id = ?";
        $stmt = $connection->prepare($query);

        // Comprobar si la preparación de la sentencia ha sido correcta
        if (!$stmt) {
            die("Error de preparación: " . $connection->error);
        }

        // Enlazar los parámetros
        $stmt->bind_param("ssssii",  $nombre, $apellidos, $direccion, $email, $telefono, $id);

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

    //Función para sumar puntos de fidelidad a un usuario
    public static function savePoints($puntos_fidelidad, $id)
    {
        $connection = DataBase::connect();

        // Preparar la consulta
        $query = "UPDATE usuario SET puntos_fidelidad = ? WHERE usuario_id = ?";
        $stmt = $connection->prepare($query);

        // Comprobar si la preparación de la sentencia ha sido correcta
        if (!$stmt) {
            die("Error de preparación: " . $connection->error);
        }

        // Enlazar los parámetros
        $stmt->bind_param("ii",  $puntos_fidelidad, $id);

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
