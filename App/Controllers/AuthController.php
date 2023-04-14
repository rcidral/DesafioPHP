<?php

    namespace App\Controllers;
    use App\Models\Container;
    require_once "../App/Models/Container.php";
    require_once "../App/Models/Usuario.php";
    
    class AuthController {
        public function autenticar() {
            header('Content-Type: application/json');

            $usuario = Container::getModel('App\Models\Usuario');
            $usuario->__set('email', $_POST['email']);
            $usuario->__set('senha', $_POST['senha']);
            if($usuario->validarLogin() != null) {
                echo json_encode(['success' => true]);
                $_SESSION['authenticated'] = true;
                $_SESSION['pageNumberUser'] = 15;
                $_SESSION['pageNumberProduct'] = 15;
                $_SESSION['pageNumberFavorite'] = 15;
                $_SESSION['pageNumberPedido'] = 15;
                $_SESSION['produtos'] = null;
                $_SESSION['usuario'] = $usuario->getUsuario();
            } else {
                unset($_SESSION['authenticated']);
                echo json_encode(['success' => false]);
            }
        }
    }
?>