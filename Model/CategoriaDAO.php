<?php

include_once 'config/DataBase.php';
include_once 'Categoria.php';

class CategoriaDAO
{

    public static function getAllCategories()
    {
        $connection = DataBase::connect();


        if ($result = $connection->query("SELECT * FROM categoria")) {


            // Mientras haya productos en la base de datos, los voy creando y guardando en un array
            // Con fectch_object le decimos el objeto de la base de datos que queremos, y si los atributos 
            // son iguales que en la base de datos y el constructor está vacío, los crea automáticamente.
            while ($categoria = $result->fetch_object('categoria')) {


                $categorias[] = $categoria;
            }




            $result->free();
        } else {
            echo "Error en la consulta: " . $connection->error;
        }

        $connection->close();
        return $categorias;
    }

    public static function getCategoryName($id)
    {
        $connection = DataBase::connect();


        // Preparar y ejecutar la consulta
        $query = "SELECT nombre_categoria FROM categoria WHERE categoria_id = $id";
        $stmt = $connection->prepare($query);
        $stmt->execute();

        // Obtener el resultado
        $result = $stmt->get_result();
        $nombre_categoria = null;
        if ($categoria = $result->fetch_object('categoria')) {
            $nombre_categoria = $categoria->getNombre_categoria();
        }

        // Cerrar la conexión
        $stmt->close();
        $connection->close();

        return $nombre_categoria;
    }
}
