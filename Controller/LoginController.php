<?php
include_once 'Model/ProductoDAO.php';
include_once 'Model/CategoriaDAO.php';
include_once 'Model/Carrito.php';
include_once 'utils/Calculadora.php';
include_once 'Model/UsuarioDAO.php';

// Creamos el controlador del login

class LoginController
{

    public function index()
    {
        //Cabecera
        include_once 'Views/header.php';
        //Panel
        include_once 'Views/login.php';
        //Footer
        include_once 'Views/footer.php';
    }

    //Función para comprovar si ya existe el usuario en la base de datos
    public function verificarMail()
    {
        session_start();

        $mail = $_POST['mail'];
        echo $mail;

        
        if (UsuarioDAO::getUserByMail($mail) == null) {
            $_SESSION['mail'] = $mail;
            header("Location:" . url . "?controller=Registro");
            
        } else {
            $_SESSION['mail'] = $mail;
            header("Location:" . url . "?controller=Password");
        }
        
    }

}
