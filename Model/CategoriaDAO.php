<?php

include_once __DIR__ . '/../config/DataBase.php';
include_once 'Categoria.php';

class CategoriaDAO
{
    // Funcion para obtener todas las categorias de la base de datos
    public static function getAllCategories()
    {
        $connection = DataBase::connect();

        // Preparar y ejecutar la consulta
        $query = "SELECT * FROM categoria";
        $stmt = $connection->prepare($query);
        $stmt->execute();

        // Obtener el resultado
        $result = $stmt->get_result();

        if ($result) {
            // Mientras haya productos en la base de datos, los voy creando y guardando en un array
            // Con fectch_object le decimos el objeto de la base de datos que queremos, y si los atributos 
            // son iguales que en la base de datos y el constructor está vacío, los crea automáticamente.
            while ($categoria = $result->fetch_object('Categoria')) {
                $categorias[] = $categoria;
            }

            $result->free();
        } else {
            echo "Error en la consulta: " . $connection->error;
        }

        $connection->close();
        return $categorias;
    }

    // Función para obtener el nombre de una categoría a través de su id
    public static function getCategoryName($id)
    {
        $connection = DataBase::connect();

        // Preparar y ejecutar la consulta
        $query = "SELECT nombre_categoria FROM categoria WHERE categoria_id = $id";
        $stmt = $connection->prepare($query);
        $stmt->execute();

        // Obtener el resultado
        $result = $stmt->get_result();
        //$nombre_categoria = null;

        if ($categoria = $result->fetch_object('categoria')) {
            $nombre_categoria = $categoria->getNombre_categoria();
        } else {
            echo "Error en la consulta: " . $connection->error;
        }

        // Cerrar la conexión
        $stmt->close();
        $connection->close();

        return $nombre_categoria;
    }
}
