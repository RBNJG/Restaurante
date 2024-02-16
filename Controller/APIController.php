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
        } else if ($_POST['accion'] == "obtener_usuario_opiniones") {

            //Comprobamos si el usuario ha iniciado sesión y si ha realizado algún pedido
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
        } else if ($_POST['accion'] == "obtener_usuario_carrito") {

            //Comprobamos si el usuario ha iniciado sesión y que tipo de usuario és
            if (isset($_SESSION['usuario_id'])) {
                // El usuario ha iniciado sesión
                $usuario_id = $_SESSION['usuario_id'];

                //Obtenemos el usuario
                $usuario = UsuarioDAO::getUser($usuario_id);

                if ($usuario instanceof Administrador) {
                    $admin = [
                        'mensaje' => 'No puedes acumular puntos de fidelidad cómo administrador'
                    ];

                    //El administrador no puede tener puntos de fidelidad
                    echo json_encode($admin, JSON_UNESCAPED_UNICODE);
                    return;
                } else {

                    $puntosUsuario = [
                        'usuario_id' => $usuario_id,
                        'puntos_fidelidad' => (int) $usuario->getPuntos_fidelidad()
                    ];

                    //Devolvemos a JS los puntos del usuario
                    echo json_encode($puntosUsuario, JSON_UNESCAPED_UNICODE);

                    return;
                }
            } else {
                $sinUsuario = [
                    'mensaje' => 'Has de iniciar sesión para canjear tus puntos.'
                ];

                //El usuario no ha realizado ningún pedido
                echo json_encode($sinUsuario, JSON_UNESCAPED_UNICODE);
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
            $resultado = OpinionesDAO::newOpinion($usuario_id, $opinion, $estrellas, $pedido_id, $fechaActualString);

            if ($resultado) {
                echo json_encode(["success" => "Contador actualizado con éxito"]);
            } else {
                echo json_encode(["error" => "Error al actualizar el contador"]);
            }

            return;
        } else if ($_POST['accion'] == "obtener_carrito") {

            //Recuperamos el carrito
            $carrito = $_SESSION['carrito'];

            $carritoJson = [];

            foreach ($carrito as $producto) {
                $productoCompleto = $producto->getProducto();

                $productoJson = [
                    'producto_id' => (int) $productoCompleto->getProducto_id(),
                    'nombre_producto' => $productoCompleto->getNombre_producto(),
                    'coste_base' => floatval($productoCompleto->getCoste_base()),
                    'imagen' => $productoCompleto->getImagen(),
                    'descuento' => floatval($productoCompleto->getDescuento()),
                    'envio_gratis' => (int) $productoCompleto->getEnvio_gratis(),
                ];

                $carritoJson[] = [
                    'producto' => $productoJson,
                    'cantidad' => $producto->getCantidad()
                ];
            }


            //Devolvemos a JS el carrito en JSON
            echo json_encode($carritoJson, JSON_UNESCAPED_UNICODE);

            return;
        } else if ($_POST['accion'] == "actualizar_carrito") {

            $producto_id = $_POST['producto_id'];
            $cantidad = $_POST['cantidad'];

            //Buscamos el producto en el carrito 
            foreach ($_SESSION['carrito'] as $pedido) {
                if ($pedido->getProducto()->getProducto_id() == $producto_id) {
                    //Buscamos el producto para asignar la cantidad
                    $pedido->setCantidad($pedido->getCantidad() + $cantidad);

                    //Después de encontrar el producto salimos del bucle
                    break;
                }
            }

            $carritoParaJson = array_map(function ($pedido) {
                return [
                    'producto_id' => $pedido->getProducto()->getProducto_id(),
                    'cantidad' => $pedido->getCantidad(),
                ];
            }, $_SESSION['carrito']);

            $cookiesCarrito = json_encode($carritoParaJson);

            //Guardamos el carrito en las cookies
            setcookie('carrito', $cookiesCarrito, time() + (3600 * 48));

            $cantidad = Calculadora::cantidadCarrito($_SESSION['carrito']);

            echo json_encode(["success" => $cantidad]);

            return;
        } else if ($_POST['accion'] == "eliminar_producto_carrito") {

            //Eliminamos el producto del array del carrito
            unset($_SESSION['carrito'][$_POST['pos_producto']]);

            //Reordenamos el array
            $_SESSION['carrito'] = array_values($_SESSION['carrito']);

            $carritoParaJson = array_map(function ($pedido) {
                return [
                    'producto_id' => $pedido->getProducto()->getProducto_id(),
                    'cantidad' => $pedido->getCantidad(),
                ];
            }, $_SESSION['carrito']);

            $cookiesCarrito = json_encode($carritoParaJson);

            //Guardamos el carrito en las cookies
            setcookie('carrito', $cookiesCarrito, time() + (3600 * 48));

            $cantidad = Calculadora::cantidadCarrito($_SESSION['carrito']);

            echo json_encode(["success" => $cantidad]);

            return;
        } else if ($_POST['accion'] == "obtener_carta") {

            //Recuperamos los productos
            $productosDAO = ProductoDAO::getAllProducts();

            $precioMasBajo = ProductoDAO::getCheaperPrice();

            foreach ($productosDAO as $producto) {
                $categoria = CategoriaDAO::getCategoryName($producto->getCategoria_id());

                $productos[] = [
                    'producto_id' => (int) $producto->getProducto_id(),
                    'categoria' => $categoria,
                    'nombre_producto' => $producto->getNombre_producto(),
                    'descripcion' => $producto->getDescripcion(),
                    'coste_base' => floatval($producto->getCoste_base()),
                    'imagen' => $producto->getImagen(),
                    'descuento' => floatval($producto->getDescuento()),
                    'envio_gratis' => (bool) $producto->getEnvio_gratis(),
                    'opiniones' => (int) $producto->getOpiniones(),
                    'estrellas' => (int) $producto->getEstrellas(),
                    'precio_mas_bajo' => floatval($precioMasBajo)
                ];
            }


            //Devolvemos a JS las opiniones en JSON
            echo json_encode($productos, JSON_UNESCAPED_UNICODE);

            return;
        } else if ($_POST['accion'] == "anadir_producto") {

            $producto_id = $_POST['producto_id'];
            $producto_existente = false;

            //Buscamos el producto en el carrito 
            foreach ($_SESSION['carrito'] as $pedido) {
                if ($pedido->getProducto()->getProducto_id() == $producto_id) {
                    //Buscamos el producto para asignar la cantidad
                    $pedido->setCantidad($pedido->getCantidad() + 1);
                    $producto_existente = true;

                    //Después de encontrar el producto salimos del bucle
                    break;
                }
            }

            //Si el producto no está en el carrito lo añade
            if (!$producto_existente) {
                $pedido = new Carrito(ProductoDAO::getProduct($producto_id));
                array_push($_SESSION['carrito'], $pedido);
            }

            $carritoParaJson = array_map(function ($pedido) {
                return [
                    'producto_id' => $pedido->getProducto()->getProducto_id(),
                    'cantidad' => $pedido->getCantidad(),
                ];
            }, $_SESSION['carrito']);

            $cookiesCarrito = json_encode($carritoParaJson);

            //Guardamos el carrito en las cookies
            setcookie('carrito', $cookiesCarrito, time() + (3600 * 48));

            $cantidad = Calculadora::cantidadCarrito($_SESSION['carrito']);

            echo json_encode(["success" => $cantidad]);

            return;
        } else {
            echo json_encode(["error" => "Acción no definida o no válida"]);
            return;
        }
    }
}
