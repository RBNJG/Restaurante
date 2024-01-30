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
                    'pedido_id' => $opinion->getPedido_id()
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
                    $pedidosUsuario = [
                        'mensaje' => 'Todavía no has realizado ningún pedido'
                    ];

                    //El usuario no ha realizado ningún pedido
                    echo json_encode($pedidosUsuario, JSON_UNESCAPED_UNICODE);
                    return;
                } else {
                    $idPedidos = [];

                    foreach ($pedidos as $pedido) {
                        $idPedidos[] = [
                            'pedido_id' => $pedido->getPedido_id()
                        ];
                    }

                    $pedidosUsuario = [
                        'usuario_id' => $usuario_id,
                        'pedidos_usuario' => $idPedidos
                    ];

                    //Devolvemos a JS los pedidos del usuario
                    echo json_encode($pedidosUsuario, JSON_UNESCAPED_UNICODE);

                    return;
                }
            } else {
                $pedidosUsuario = [
                    'mensaje' => 'Has de iniciar sesión para dejar tu opinión.'
                ];

                //El usuario no ha realizado ningún pedido
                echo json_encode($pedidosUsuario, JSON_UNESCAPED_UNICODE);
                return;
            }

            return;
        } else if ($_POST['accion'] == "guardar_opinion") {

            $usuario_id = $_POST['usuario_id'];
            $opinion = $_POST['opinion'];
            $estrellas = $_POST['estrellas'];
            $pedido_id = $_POST['pedido_id'];
            $fechaActual = new DateTime();
            $fechaActualString = $fechaActual->format("Y-m-d H:i:s");

            // Actualizamos el valor en la base de datos
            $resultado = OpinionesDAO::newOpinion($usuario_id,$opinion,$estrellas,$pedido_id,$fechaActualString);

            if ($resultado) {
                echo json_encode(["success" => "Contador actualizado con éxito"]);
            } else {
                echo json_encode(["error" => "Error al actualizar el contador"]);
            }

            return;
        } else if ($_POST['accion'] == "obtener_carrito") {

            // Especificar el tipo de contenido para la respuesta
            header('Content-Type: application/json');

            //Recuperamos el carrito
            $carrito = $_SESSION['carrito'];

            $carritoJson = [];

            foreach ($carrito as $producto) {
                $productoCompleto = $producto->getProducto();

                $productoJson = [
                    'producto_id' => $productoCompleto->getProducto_id(),
                    'nombre_producto' => $productoCompleto->getNombre_producto(),
                    'coste_base' => $productoCompleto->getCoste_base(),
                    'imagen' => $productoCompleto->getImagen(),
                    'descuento' => $productoCompleto->getDescuento(),
                    'envio_gratis' => $productoCompleto->getEnvio_gratis(),
                ];

                $carritoJson [] = [
                    'producto' => $productoJson,
                    'cantidad' => $producto->getCantidad()
                ];
            }


            //Devolvemos a JS el carrito en JSON
            echo json_encode($carritoJson, JSON_UNESCAPED_UNICODE);

            return;
        } else {
            echo json_encode(["error" => "Acción no definida o no válida"]);
            return;
        }
    }
}
