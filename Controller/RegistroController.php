<?php
include_once 'Model/ProductoDAO.php';
include_once 'Model/CategoriaDAO.php';
include_once 'Model/Carrito.php';
include_once 'utils/Calculadora.php';
include_once 'Model/UsuarioDAO.php';

// Creamos el controlador del registro

class RegistroController
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
        include_once 'Views/registro.php';
        //Footer
        include_once 'Views/footer.php';
    }

    public function registrarUsuario(){
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $password = $_POST['password'];

        //Encriptamos la contraseña para guardarla en la base de datos
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $_SESSION['mail'] = $email;

        UsuarioDAO::newUser($nombre,$apellidos,$direccion,$email,$telefono,$hashedPassword,2);

        //echo "Contraseña: " . $hashedPassword;

        header("Location:" . url . "?controller=Login");
        exit;
    }

}