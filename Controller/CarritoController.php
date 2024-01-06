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
        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/pedidoRealizado.php';
        //Footer
        include_once 'Views/footer.php';
    }

    //Función para eliminar un producto o conjunto de productos del carrito
    public function eliminar(){
        session_start();

        //Eliminamos el producto del array del carrito
        unset($_SESSION['carrito'][$_POST['pos_producto']]);

        //Reordenamos el array
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);

        header("Location:" . url. "?controller=Carrito");
        exit;
    }

    //Función para aumentar o disminuir la cantidad de un producto del carrito
    public function modificarCantidad(){
        session_start();

        if(isset($_POST['sumar'])){
            $producto = $_SESSION['carrito'][$_POST['sumar']];

            $producto->setCantidad($producto->getCantidad()+1);
        }else if(isset($_POST['restar'])){
            $producto = $_SESSION['carrito'][$_POST['restar']];

            $producto->setCantidad($producto->getCantidad()-1);
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);

        exit;
    }

    //Función que registra la compra de un usuario
    public function compra(){

        $fechaActual = new DateTime();
        $fechaActualString = $fechaActual->format("Y-m-d H:i:s");


        $carrito = $_SESSION['carrito'];
        
        $pedidoId = PedidoDAO::newPedido($_SESSION['usuario_id'],$fechaActualString,Calculadora::total($carrito),"En preparación");

        //Sumamos puntos de fidelidad al usuario, 1 punto por cada 10€ gastados
        $usuario = UsuarioDAO::getUser($_SESSION['usuario_id']);
        $usuario->sumarPuntos(floor(Calculadora::total($carrito)/10));
        UsuarioDAO::SavePoints($usuario->getPuntos_fidelidad(), $_SESSION['usuario_id']);

        foreach($carrito as $producto){

            $productoId = $producto->getProducto()->getProducto_id();
            $cantidadProducto = $producto->getCantidad();
            $subtotal = Calculadora::totalProducto($producto,0, 0);

            DetallePedidoDAO::newDetallePedido($pedidoId,$productoId,$cantidadProducto,$subtotal);
        }

        unset($_SESSION['carrito']);
        setcookie('carrito', '', time() - (3600 * 48));

        header("Location:" . url . "?controller=Carrito&action=pedidoRealizado");
        
        exit;
    }

}
