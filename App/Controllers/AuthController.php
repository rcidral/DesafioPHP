<?php

    header('Content-Type: application/json');
    
    $usuario = Container::getModel('Usuario');

    $UsuarioController = new UsuarioController();


    $usuario->__set('email', $_POST['email']);
    $usuario->__set('senha', $_POST['password']);
        if($usuario->validarLogin()) {
            $_SESSION['authenticated'] = true;
            $_SESSION['nome'] = $usuario->__get('nome');
            $_SESSION['id'] = $usuario->__get('id'); 
            $_SESSION['pageNumberUser'] = 15;
            $_SESSION['pageNumberProduct'] = 15;
            $_SESSION['idProdutosCarrinhoBy'] = [];
            $_SESSION['compraFinalizada'] = "";
            echo json_encode(['success' => true]);
        } else {
            unset($_SESSION['authenticated']);
            echo json_encode(['success' => false]);
        }
?>