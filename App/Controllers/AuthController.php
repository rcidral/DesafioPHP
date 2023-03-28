<?php

    header('Content-Type: application/json');

    $user = include "../App/Models/Usuario.php";

    class Container {

        public static function getModel($user) {
            $class = $user;
            $pdo = new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'root', '');
    
            return new $class($pdo);
        }
    }
    
    $usuario = Container::getModel('Usuario');

    $usuario->__set('email', $_POST['email']);
    $usuario->__set('senha', $_POST['password']);
    
    if($usuario->validarLogin()) {
        $_SESSION['authenticated'] = true;
        $_SESSION['nome'] = $usuario->__get('nome');
        echo json_encode(['success' => true]);
    } else {
        unset($_SESSION['authenticated']);
        echo json_encode(['success' => false]);
    }
?>