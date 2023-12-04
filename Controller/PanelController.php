<?php
include_once 'Model/ProductoDAO.php';
include_once 'Model/CategoriaDAO.php';
include_once 'Model/Carrito.php';
include_once 'utils/Calculadora.php';
include_once 'Model/UsuarioDAO.php';

// Creamos el controlador del panel de usuario

class PanelController
{

    public function index()
    {
        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/panelUsuario.php';
        //Footer
        include_once 'Views/footer.php';
    }

    public function modificarDatos()
    {
        //Iniciamos sesión
        session_start();

        //Creamos el array dónde se guardan los productos seleccionados
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = array();
        }

        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/panelUsuarioDatos.php';
        //Footer
        include_once 'Views/footer.php';
    }

    public function verPedidos()
    {
        //Iniciamos sesión
        session_start();

        //Creamos el array dónde se guardan los productos seleccionados
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = array();
        }

        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/panelPedidos.php';
        //Footer
        include_once 'Views/footer.php';
    }

    public function desconectar()
    {
        session_start();

        //Eliminamos las variables de sesión
        $_SESSION = array();

        //Destruimos la sesión
        session_destroy();

        setcookie('usuario','', time() - (3600 * 48));

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
