<?php

include_once __DIR__ . '/../Model/OpinionesDAO.php';
include_once __DIR__ . '/../Model/CategoriaDAO.php';
include_once __DIR__ . '/../Model/PedidoDAO.php';
include_once __DIR__ . '/../Model/DetallePedidoDAO.php';
include_once __DIR__ . '/../Model/ProductoDAO.php';
include_once __DIR__ . '/../Model/UsuarioDAO.php';


class APIController
{

    public function api()
    {
        
        if ($_POST['accion'] == "buscar_opiniones") {
            // Especificar el tipo de contenido para la respuesta
            header('Content-Type: application/json');

            //Recuperamos las opiniones
            $opinionesDAO = OpinionesDAO::getAllOpiniones();

            foreach ($opinionesDAO as $opinion) {
                $user = UsuarioDAO::getUser($opinion->getUsuario_id());

                $opiniones[] = [
                    'opinion_id' => $opinion->getOpinion_id(),
                    'usuario_id' => $opinion->getUsuario_id(),
                    'nombre_usuario' => $user->getNombre(),
                    'apellidos_usuario' => $user->getApellidos(),
                    'opinion' => $opinion->getOpinion(),
                    'estrellas' => $opinion->getEstrellas(),
                    'util_si' => $opinion->getUtil_si(),
                    'util_no' => $opinion->getUtil_no(),
                    'fecha' => $opinion->getFecha(),
                ];
            }


            //Devolvemos a JS las opiniones en JSON
            echo json_encode($opiniones, JSON_UNESCAPED_UNICODE);

            return;
        } else if ($_POST['accion'] == "sumar_util") {

            $opinion_id = $_POST['opinion_id'];
            $tipo = $_POST['tipo'];

            // Actualizamos el valor en la base de datos
            $resultado = OpinionesDAO::sumarUtil($opinion_id, $tipo);

            if ($resultado) {
                echo json_encode(["success" => "Contador actualizado con éxito"]);
            } else {
                echo json_encode(["error" => "Error al actualizar el contador"]);
            }

            return;
        } else if ($_POST['accion'] == "obtener_usuario") {

            if (isset($_SESSION['usuario_id'])) {
                // El usuario ha iniciado sesión
                $usuario_id = $_SESSION['usuario_id'];

                //Obtenemos los pedidos del usuario
                $pedidos = PedidoDAO::getPedidos($usuario_id);

                if (empty($pedidos)) {
                    //El usuario no ha realizado ningún pedido
                    echo json_encode(["error" => "Usuario sin pedidos"]);
                    return;
                } else {
                    $idPedidos = [];

                    foreach ($pedidos as $pedido) {
                        $idPedidos[] = [
                            'pedido_id' => $pedido->getPedido_id()
                        ];
                    }

                    $pedidosUsuario[] = [
                        'usuario_id' => $usuario_id,
                        'pedidos_usuario' => $idPedidos
                    ];

                    //Devolvemos a JS los pedidos del usuario
                    echo json_encode($pedidosUsuario, JSON_UNESCAPED_UNICODE);
                }
            } else {
                // El usuario no ha iniciado sesión
                echo json_encode(["error" => "Usuario no autenticado"]);
            }

            return;
        } else {
            echo json_encode(["error" => "Acción no definida o no válida"]);
            return;
        }
    }
}