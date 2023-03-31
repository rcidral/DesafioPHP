<?php

    $product = include "../App/Models/Produto.php";
    $user = include "../App/Models/Usuario.php";
    $cart = include "../App/Models/Carrinho.php";
    $container = include "../App/Controllers/Container.php";
    

    class UsuarioController {
        public function createUsuario() {
            $usuario = Container::getModel('Usuario');
            $usuario->__set('nome', $_REQUEST['nome']);
            $usuario->__set('nascimento', $_REQUEST['nascimento']);
            $usuario->__set('telefone', $_REQUEST['telefone']);
            $usuario->__set('email', $_REQUEST['email']);
            $usuario->__set('senha', $_REQUEST['senha']);
            $usuario->__set('foto', $_REQUEST['foto']);
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
            $produto->__set('img', $_POST['img']);
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
        public function listarProduto($id) {
            $produto = Container::getModel('Produto');
            $produto->__set('id', $id);
            $_SESSION['produto'] = $produto->listarProduto();
        }
        public function pesquisarProduto($pesquisa) {
            $produto = Container::getModel('Produto');
            $produto->__set('nome', $pesquisa);
            if($produto->pesquisarProduto() == null) {
                echo json_encode(['success' => false]);
            } else {
                $_SESSION['pesquisar'] = $produto->pesquisarProduto();
                echo json_encode(['success' => true]);
            }
        }
        public function listarProdutosAdmin($qtd) {
            $produto = Container::getModel('Produto');
            return $produto->listarProdutosAdmin($qtd);
        }
    }

    class CarrinhoController {
        public function listarCarrinho() {
            $carrinho = Container::getModel('Carrinho');
            $_SESSION['carrinho'] = $carrinho->listarCarrinhoUsuarioProdutos($_SESSION['id']);
        }
        public function listarQuantidadeDeProdutos() {
            $carrinho = Container::getModel('Carrinho');
            $_SESSION['quantidade'] = $carrinho->listarQuantidadeDeProdutos($_SESSION['id']);
        }
        public function adicionarCarrinho() {
            $carrinho = Container::getModel('Carrinho');
            $carrinho->__set('id_usuario', $_REQUEST['id_usuario']);
            $carrinho->__set('id_produto', $_REQUEST['id_produto']);
            $carrinho->adicionarCarrinho();
            echo json_encode(['success' => true]);
        }
        public function limparCarrinho() {
            $carrinho = Container::getModel('Carrinho');
            $carrinho->__set('id_usuario', $_SESSION['id']);
            $carrinho->limparCarrinho();
            echo json_encode(['success' => true]);
        }
        public function getPrecoCarrinho() {
            $carrinho = Container::getModel('Carrinho');
            $_SESSION['total'] = $carrinho->getPrecoCarrinho($_SESSION['id']);
        }
    }

?>