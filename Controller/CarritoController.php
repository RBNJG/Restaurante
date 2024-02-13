<?php
include_once 'Model/ProductoDAO.php';
include_once 'Model/CategoriaDAO.php';
include_once 'Model/PedidoDAO.php';
include_once 'Model/DetallePedidoDAO.php';
include_once 'Model/Carrito.php';
include_once 'utils/Calculadora.php';

// Creamos el controlador del carrito
class CarritoController
{

    public function index()
    {
        $carrito = $_SESSION['carrito'];

        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/carrito.php';
        //Footer
        include_once 'Views/footer.php';
    }

    //Se muestra un mensaje al usuario para informarle de que el pedido se ha realizado
    public function pedidoRealizado()
    {

        $pedidoId = $_SESSION['pedidoId-qr'];

        unset($_SESSION['pedidoId-qr']);

        $urlPedido = url . "?controller=Carrito&action=infoPedido&pedidoId=" . $pedidoId;

        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/pedidoRealizado.php';
        //Footer
        include_once 'Views/footer.php';
    }

    //Función para eliminar un producto o conjunto de productos del carrito
    public function eliminar()
    {

        //Eliminamos el producto del array del carrito
        unset($_SESSION['carrito'][$_POST['pos_producto']]);

        //Reordenamos el array
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);

        header("Location:" . url . "?controller=Carrito");
        exit;
    }

    //Función para aumentar o disminuir la cantidad de un producto del carrito
    public function modificarCantidad()
    {

        if (isset($_POST['sumar'])) {
            $producto = $_SESSION['carrito'][$_POST['sumar']];

            $producto->setCantidad($producto->getCantidad() + 1);
        } else if (isset($_POST['restar'])) {
            $producto = $_SESSION['carrito'][$_POST['restar']];

            $producto->setCantidad($producto->getCantidad() - 1);
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);

        exit;
    }

    //Función que registra la compra de un usuario
    public function compra()
    {

        $fechaActual = new DateTime();
        $fechaActualString = $fechaActual->format("Y-m-d H:i:s");

        $carrito = $_SESSION['carrito'];
        $descuento_aplicado = $_POST['descuento'];
        $coste_total = $_POST['coste_total'];
        $puntos_generados = $_POST['puntos_generados'];
        $propina = $_POST['propina'];

        $pedidoId = PedidoDAO::newPedido($_SESSION['usuario_id'], $fechaActualString, $coste_total, "En preparación", $descuento_aplicado, $propina);

        //Guardamos el id del pedido en una sesión para luego generar el QR
        $_SESSION['pedidoId-qr'] = $pedidoId;

        //Sumamos puntos de fidelidad al usuario, 1 punto por cada 10€ gastados
        $usuario = UsuarioDAO::getUser($_SESSION['usuario_id']);

        //Primero restamos los puntos de fidelidad utilizados y luego sumamos los generados
        $usuario->sumarPuntos(-$descuento_aplicado);
        $usuario->sumarPuntos($puntos_generados);
        UsuarioDAO::SavePoints($usuario->getPuntos_fidelidad(), $_SESSION['usuario_id']);

        foreach ($carrito as $producto) {

            $productoId = $producto->getProducto()->getProducto_id();
            $cantidadProducto = $producto->getCantidad();
            $subtotal = Calculadora::totalProducto($producto, 0, 0);

            DetallePedidoDAO::newDetallePedido($pedidoId, $productoId, $cantidadProducto, $subtotal);
        }

        unset($_SESSION['carrito']);
        setcookie('carrito', '', time() - (3600 * 48));

        header("Location:" . url . "?controller=Carrito&action=pedidoRealizado");

        exit;
    }

    //Función para mostrar los datos de un pedido a través de un QR
    public function infoPedido()
    {
        $pedido = PedidoDAO::getPedido($_GET['pedidoId']);
        $detallesPedido = DetallePedidoDAO::getDetallePedido($_GET['pedidoId']);
        $fechaString = $pedido->getFecha();
        $fecha = new DateTime($fechaString);

        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/infoPedido.php';
        //Footer
        include_once 'Views/footer.php';
    }
}
