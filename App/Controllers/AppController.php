<?php

    $product = include "../App/Models/Produto.php";
    $user = include "../App/Models/Usuario.php";

    class Container {

        public static function getModel($product) {
            $class = $product;
            $pdo = new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'root', '');
    
            return new $class($pdo);
        }
    }

    class UsuarioController {
        public function createUsuario() {
            $usuario = Container::getModel('Usuario');
            $usuario->__set('nome', $_REQUEST['nome']);
            $usuario->__set('email', $_REQUEST['email']);
            $usuario->__set('senha', $_REQUEST['senha']);
            $usuario->createUsuario();
        }
        public function listarUsuarios() {
            $usuario = Container::getModel('Usuario');
            $_SESSION['usuarios'] = $usuario->listar();
        }
        public function alterarUsuario() {
            $usuario = Container::getModel('Usuario');
            $usuario->__set('id', $_POST['id']);
            $usuario->__set('nome', $_POST['nome']);
            $usuario->__set('email', $_POST['email']);
            $usuario->__set('senha', $_POST['senha']);
            $usuario->alterar();
        }
        public function deletarUsuario() {
            $usuario = Container::getModel('Usuario');
            $usuario->__set('id', $_REQUEST['id']);
            $usuario->deletar();
        }
    }

    class ProdutoController {
        public function listarProdutos() {
            $produto = Container::getModel('Produto');
            $_SESSION['produtos'] = $produto->listar();
        }
        public function alterarProduto() {
            $produto = Container::getModel('Produto');
            $produto->__set('id', $_POST['id']);
            $produto->__set('nome', $_POST['nome']);
            $produto->__set('descricao', $_POST['descricao']);
            $produto->__set('preco', $_POST['preco']);
            $produto->__set('imagem', $_POST['imagem']);
            $produto->alterar();
        }
        public function deletarProduto() {
            $produto = Container::getModel('Produto');
            $produto->__set('id', $_REQUEST['id']);
            $produto->deletar();
        }

        public function createProduto() {
            $produto = Container::getModel('Produto');
            $produto->__set('nome', $_REQUEST['nome']);
            $produto->__set('descricao', $_REQUEST['descricao']);
            $produto->__set('preco', $_REQUEST['preco']);
            $produto->__set('img', $_REQUEST['img']);
            $produto->createProduto();
        }
    }

?>