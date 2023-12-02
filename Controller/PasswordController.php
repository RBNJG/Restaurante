<?php
include_once 'Model/ProductoDAO.php';
include_once 'Model/CategoriaDAO.php';
include_once 'Model/Carrito.php';
include_once 'utils/Calculadora.php';
include_once 'Model/UsuarioDAO.php';

// Creamos el controlador del login

class PasswordController
{

    public function index()
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
        include_once 'Views/password.php';
        //Footer
        include_once 'Views/footer.php';
    }

    public function verificar()
    {
        session_start();

        $password = $_POST['password'];

        $user = UsuarioDAO::getUserByMail($_SESSION['mail']);

        $hashedPassword = $user->getPassword();

       
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['usuario_id'] = $user->getUsuario_id();
            header("Location:" . url . "?controller=Home");
        } else {
            $_SESSION['errorpassword'] = "Lo sentimos, la contraseña no és válida.";
            header("Location:" . url . "?controller=Password");
        }
        
    }
}
