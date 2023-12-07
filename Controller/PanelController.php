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

    public function index()
    {
        $usuario = UsuarioDAO::getUser($_SESSION['usuario_id']);

        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/panelUsuario.php';
        //Footer
        include_once 'Views/footer.php';
    }

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

    public function guardarCambios()
    {
        session_start();

        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];

        UsuarioDAO::modifyUser($nombre, $apellidos, $direccion, $email, $telefono, $_SESSION['usuario_id']);

        header("Location: " . url . "?controller=Panel");
        exit;
    }
}
