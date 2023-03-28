<?php

    header('Content-Type: application/json');
    
    $usuario = Container::getModel('Usuario');

    $usuario->__set('email', $_POST['email']);
    $usuario->__set('senha', $_POST['password']);
    
    if($usuario->validarLogin()) {
        $_SESSION['authenticated'] = true;
        $_SESSION['nome'] = $usuario->__get('nome');
        $_SESSION['id'] = $usuario->__get('id');
        echo json_encode(['success' => true]);
    } else {
        unset($_SESSION['authenticated']);
        echo json_encode(['success' => false]);
    }
?>