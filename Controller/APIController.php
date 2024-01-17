<?php

include_once __DIR__ . '/../Model/OpinionesDAO.php';
include_once __DIR__ . '/../Model/CategoriaDAO.php';
include_once __DIR__ . '/../Model/PedidoDAO.php';
include_once __DIR__ . '/../Model/DetallePedidoDAO.php';
include_once __DIR__ . '/../Model/ProductoDAO.php';


class APIController
{

    public function api()
    {

        if ($_POST["accion"] == 'buscar_opiniones') {
            // Especificar el tipo de contenido para la respuesta
            header('Content-Type: application/json');

            //$id_usuario = json_decode($_POST["id_usuario"]); se decodifican los datos JSON que se reciben desde JS
            $opinionesDAO = OpinionesDAO::getAllOpiniones(); //puedes hacer un select de pedidos aqui, o un insert o lo que quieras, utilizando el MODELO

            foreach ($opinionesDAO as $opinion) {
                $opiniones[] = [
                    'opinion_id' => $opinion->getOpinion_id(),
                    'usuario_id' => $opinion->getUsuario_id(),
                    'opinion' => $opinion->getOpinion(),
                    'estrellas' => $opinion->getEstrellas(),
                    'util_si' => $opinion->getUtil_si(),
                    'util_no' => $opinion->getUtil_no(),
                    'fecha' => $opinion->getFecha(),
                ];
            }


            // Si quieres devolverle información al JS, codificas en json un array con la información
            // y se los devuelves al JS
            echo json_encode($opiniones, JSON_UNESCAPED_UNICODE);

            return; //return para salir de la funcion
        } else {
            echo json_encode(["error" => "Acción no definida o no válida"]);
            return;
        }
    }
}