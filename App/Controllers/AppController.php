<?php

    $product = include "../App/Models/Produto.php";

    class Container {

        public static function getModel($product) {
            $class = $product;
            $pdo = new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'root', '');
    
            return new $class($pdo);
        }
    }
    
    $produto = Container::getModel('Produto');

    $_SESSION['produtos'] = $produto->listar();

?>