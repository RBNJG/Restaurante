<?php
include_once 'Model/ProductoDAO.php';
include_once 'Model/CategoriaDAO.php';
include_once 'Model/Carrito.php';
include_once 'utils/Calculadora.php';
include_once 'Model/UsuarioDAO.php';
include_once 'Model/PedidoDAO.php';
include_once 'Model/DetallePedidoDAO.php';

// Creamos el controlador del panel de usuario

class PanelController
{
    // Muestra la página principal del panel de usuario
    public function index()
    {
        $usuario = UsuarioDAO::getUser($_SESSION['usuario_id']);

        /*
        $pedidosUser = PedidoDAO::getPedidos($_SESSION['usuario_id']);
        */

        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/panelUsuario.php';
        //Footer
        include_once 'Views/footer.php';
    }

    // Muestra los datos del usuario para modificar
    public function modificarDatos()
    {
        $usuario = UsuarioDAO::getUser($_SESSION['usuario_id']);

        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/panelUsuarioDatos.php';
        //Footer
        include_once 'Views/footer.php';
    }

    // Muestra el listado de productos actuales al administrador
    public function listadoProductos()
    {
        $usuario = UsuarioDAO::getUser($_SESSION['usuario_id']);
        $productos = ProductoDAO::getAllProducts();
        $categorias = CategoriaDAO::getAllCategories();

        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/panelProductos.php';
        //Footer
        include_once 'Views/footer.php';
    }

    // Muestra los datos de un producto a modificar por el administrador
    public function modificarProducto()
    {
        $id = $_POST['producto_id'];
        $categorias = CategoriaDAO::getAllCategories();
        $usuario = UsuarioDAO::getUser($_SESSION['usuario_id']);
        $producto = ProductoDAO::getProduct($id);

        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/panelModProducto.php';
        //Footer
        include_once 'Views/footer.php';
    }

    // Muestra la lista de pedidos de un usuario
    public function verPedidos()
    {
        $usuario = UsuarioDAO::getUser($_SESSION['usuario_id']);
        $pedidosUser = PedidoDAO::getPedidos($_SESSION['usuario_id']);

        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/panelPedidos.php';
        //Footer
        include_once 'Views/footer.php';
    }

    // Muestra un pedido en detalle al usuario
    public function detallePedido()
    {
        $usuario = UsuarioDAO::getUser($_SESSION['usuario_id']);
        $pedidoId = $_POST['pedido'];
        $pedido = PedidoDAO::getPedido($pedidoId);
        $detallesPedido = DetallePedidoDAO::getDetallePedido($pedidoId);
        $fechaString = $pedido->getFecha();
        $fecha = new DateTime($fechaString);

        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/panelDetallePedido.php';
        //Footer
        include_once 'Views/footer.php';
    }

    // Muestra el listado de todos los pedidos al administrador
    public function revisarPedidos()
    {
        $usuario = UsuarioDAO::getUser($_SESSION['usuario_id']);
        $pedidos = PedidoDAO::getAllPedidos();

        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/panelPedidosAdmin.php';
        //Footer
        include_once 'Views/footer.php';
    }

    // Función para eliminar un pedido y sus detalles
    public function eliminarPedido()
    {
        DetallePedidoDAO::deleteDetalleByPedido($_POST['pedido']);
        PedidoDAO::deletePedido($_POST['pedido']);

        header("Location:" . $_SERVER['HTTP_REFERER']);

        exit;
    }

    //Función para eliminar un producto
    public function eliminarProducto()
    {

        $producto_id = $_POST['producto_id'];
        ProductoDAO::deleteProduct($producto_id);

        header("Location:" . $_SERVER['HTTP_REFERER']);

        exit;
    }

    // Muestra la pantalla para modificar un pedido, solamente accesible para administradores
    public function modificarPedido()
    {
        $usuario = UsuarioDAO::getUser($_SESSION['usuario_id']);

        // Si no accedemos desde la lista de pedidos usamos la variable de sesión para seguir modificando el pedido
        if (!isset($_POST['pedido'])) {
            $pedido = PedidoDAO::getPedido($_SESSION['pedidoActual']);
        } else {
            $pedido = PedidoDAO::getPedido($_POST['pedido']);
        }

        if (!isset($_SESSION['pedidoActual']) || $_SESSION['pedidoActual'] != $pedido->getPedido_id()) {
            $_SESSION['pedidoActual'] = $pedido->getPedido_id();
            $_SESSION['detallesPedido'] = DetallePedidoDAO::getDetallePedido($pedido->getPedido_id());
        }

        $detallesPedido = $_SESSION['detallesPedido'];

        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/panelModPedido.php';
        //Footer
        include_once 'Views/footer.php';
    }

    // Función para añadir al carrito todos los productos y en la misma cantidad que en pedidos anteriores
    public function repetirPedido()
    {
        $pedido = $_POST['repetirpedido'];

        $detallesPedido = DetallePedidoDAO::getDetallePedido($pedido);

        //Buscamos el producto en el carrito 
        foreach ($detallesPedido as $productoDetalle) {

            $producto_existente = false;

            foreach ($_SESSION['carrito'] as $producto) {
                if ($productoDetalle->getProducto_id() == $producto->getProducto()->getProducto_id()) {
                    //Si el producto ya está en el carrito, incrementa la cantidad
                    $producto->setCantidad($producto->getCantidad() + $productoDetalle->getCantidad_producto());
                    $producto_existente = true;

                    //Después de encontrar el producto salimos del bucle
                    break;
                }
            }

            //Si el producto no está en el carrito lo añade
            if (!$producto_existente) {
                $producto = new Carrito(ProductoDAO::getProduct($productoDetalle->getProducto_id()));
                $producto->setCantidad($productoDetalle->getCantidad_producto());
                array_push($_SESSION['carrito'], $producto);
            }
        }

        //Preparamos el carrito para las cookies
        $carritoParaJson = array_map(function ($pedido) {
            return [
                'producto_id' => $pedido->getProducto()->getProducto_id(),
                'cantidad' => $pedido->getCantidad(),
            ];
        }, $_SESSION['carrito']);

        $cookiesCarrito = json_encode($carritoParaJson);

        //Guardamos el carrito en las cookies
        setcookie('carrito', $cookiesCarrito, time() + (3600 * 48));

        //Redirigimos al carrito
        header('Location: ' . url . "?controller=Carrito");
        exit;
    }

    // Función para eliminar un producto de los detalles de un pedido
    public function eliminarProductoPedido()
    {
        //Eliminamos el producto del array del pedido
        unset($_SESSION['detallesPedido'][$_POST['pos_producto']]);

        //Reordenamos el array
        $_SESSION['detallesPedido'] = array_values($_SESSION['detallesPedido']);

        header("Location:" . $_SERVER['HTTP_REFERER']);

        exit;
    }

    // Función para modificar la cantidad de un producto de un pedido
    public function modificarCantidad()
    {
        if (isset($_POST['sumar'])) {
            $producto = $_SESSION['detallesPedido'][$_POST['sumar']];

            $producto->setCantidad_producto($producto->getCantidad_producto() + 1);
        } else if (isset($_POST['restar'])) {
            $producto = $_SESSION['detallesPedido'][$_POST['restar']];

            $producto->setCantidad_producto($producto->getCantidad_producto() - 1);
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);

        exit;
    }

    // Función para guardar la modificación de datos del usuario
    public function guardarCambios()
    {
        session_start();

        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        //Si el usuario no es administrador pasaremos area cómo nulo
        if (isset($_POST['area'])) {
            $area = $_POST['area'];
        } else {
            $area = null;
        }

        UsuarioDAO::modifyUser($nombre, $apellidos, $direccion, $email, $telefono, $area,  $_SESSION['usuario_id']);

        header("Location: " . url . "?controller=Panel");
        exit;
    }

    //Función que guarda los cambios realizados en un producto
    public function guardarCambiosProducto()
    {
        $producto_id = $_POST['producto_id'];
        $nombre_producto = $_POST['nombre_producto'];
        $descripcion = $_POST['descripcion'];
        $categoria_id = $_POST['categoria_id'];
        $coste_base = $_POST['coste_base'];
        //$imagen = $_POST['imagen'];
        if (basename($_FILES["imagen"]["name"] == "")) {
            $imagen = ProductoDAO::getProduct($producto_id)->getImagen();
        } else {
            $nombre_imagen = basename($_FILES["imagen"]["name"]);
            $imagen = "assets/images/carta/" . $nombre_imagen;
        }


        if ($_POST['envio_gratis'] == 1) {
            $envio_gratis = 1;
        } else {
            $envio_gratis = 0;
        }

        ProductoDAO::modifyProduct($producto_id, $categoria_id, $nombre_producto, $descripcion, $coste_base, $imagen, $envio_gratis);

        header("Location:" . url . "?controller=Panel&action=listadoProductos");

        exit;
    }

    public function nuevoProducto()
    {
        $nombre_producto = $_POST['nombre_producto'];
        $descripcion = $_POST['descripcion'];
        $categoria_id = $_POST['categoria_id'];
        $coste_base = $_POST['coste_base'];
        $nombre_imagen = basename($_FILES["imagen"]["name"]);
        $imagen = "assets/images/carta/" . $nombre_imagen;

        if ($_POST['envio_gratis'] == 1) {
            $envio_gratis = 1;
        } else {
            $envio_gratis = 0;
        }

        ProductoDAO::newProduct($categoria_id, $nombre_producto, $descripcion, $coste_base, $imagen, $envio_gratis);

        header("Location:" . $_SERVER['HTTP_REFERER']);

        exit;
    }

    public function guardarCambiosPedido()
    {
        $detalles = $_SESSION['detallesPedido'];

        // Modificamos los detalles del pedido y creamos un array con los id de los detalles
        foreach ($detalles as $detalle) {
            $producto = ProductoDAO::getProduct($detalle->getProducto_id());
            $subtotal = Calculadora::totalProducto($producto, $detalle->getCantidad_producto(), 0);
            DetallePedidoDAO::modifyDetallePedido($detalle->getDetalle_pedido_id(), $detalle->getCantidad_producto(), $subtotal);
            $idDetalles[] = $detalle->getDetalle_pedido_id();
        }

        // Borraremos todos los detalles del pedido que no tengan la id del array de ids que hemos creado anteriormente
        DetallePedidoDAO::deleteDetalle($idDetalles, $_POST['pedido']);

        $coste_total = $_POST['coste'];
        $estado = $_POST['estado'];
        $pedido_id = $_POST['pedido'];

        // Finalmente modificamos los datos del pedido
        PedidoDAO::modifyPedido($coste_total, $estado, $pedido_id);

        // Liberamos las variables de sesión una vez realizados los cambios
        unset($_SESSION['detallesPedido']);
        unset($_SESSION['pedidoActual']);

        header("Location:" . url . "?controller=Panel&action=revisarPedidos");

        exit;
    }

    public function desconectar()
    {
        session_start();

        //Eliminamos las variables de sesión
        $_SESSION = array();

        //Destruimos la sesión
        session_destroy();

        setcookie('usuario', '', time() - (3600 * 48));

        //Redirigimos al usuario a Home
        header("Location: " . url);
        exit;
    }
}
