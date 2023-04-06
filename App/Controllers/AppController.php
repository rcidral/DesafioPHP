<?php

    namespace App\Controllers;
    use App\Models\Container;
    require_once "../App/Models/Container.php";
    require_once "../App/Models/Usuario.php";
    require_once "../App/Models/Produto.php";
    require_once "../App/Models/Carrinho.php";
    require_once "../App/Models/Pedido.php";

    class AppController {

        // User methods

        public function cadastrarUsuario() {
            $usuario = Container::getModel('App\Models\Usuario');
            $usuario->__set('nome', $_POST['nome']);
            $usuario->__set('nascimento', $_POST['nascimento']);
            $usuario->__set('telefone', $_POST['telefone']);
            $usuario->__set('email', $_POST['email']);
            $usuario->__set('senha', $_POST['senha']);
            $usuario->__set('foto', $_POST['foto']);

            $usuario->createUsuario();
        }

        public function listarUsuarios() {
            $usuario = Container::getModel('App\Models\Usuario');
            return $usuario->getUsuarios();
        }

        public function listarUsuario() {
            $usuario = Container::getModel('App\Models\Usuario');
            $usuario->__set('id', $_POST['id']);
            return $usuario->getUsuarioById();
        }

        public function listarUsuariosAdmin($qtd) {
            $usuario = Container::getModel('App\Models\Usuario');
            return $usuario->listarUsuariosAdmin($qtd);
        }

        public function editarUsuario() {
            $usuario = Container::getModel('App\Models\Usuario');
            $usuario->__set('id', $_POST['id']);
            $usuario->__set('nome', $_POST['nome']);
            $usuario->__set('nascimento', $_POST['nascimento']);
            $usuario->__set('telefone', $_POST['telefone']);
            $usuario->__set('email', $_POST['email']);
            $usuario->__set('senha', $_POST['senha']);
            $usuario->__set('foto', $_POST['foto']);

            $usuario->updateUsuario();
        }

        public function deletarUsuario() {
            $usuario = Container::getModel('App\Models\Usuario');
            $usuario->__set('id', $_POST['id']);
            $usuario->deleteUsuario();
        }

        // Product methods

        public function cadastrarProduto() {
            $produto = Container::getModel('App\Models\Produto');
            $produto->__set('nome', $_POST['nome']);
            $produto->__set('descricao', $_POST['descricao']);
            $produto->__set('preco', $_POST['preco']);
            $produto->__set('img', $_POST['img']);
            $produto->__set('img1', $_POST['img1']);
            $produto->__set('img2', $_POST['img2']);
            $produto->__set('img3', $_POST['img3']);

            $produto->createProduto();
        }

        public function listarProdutos() {
            $produto = Container::getModel('App\Models\Produto');
            return $produto->getProdutos();
        }

        public function listarProduto() {
            $produto = Container::getModel('App\Models\Produto');
            $produto->__set('id', $_POST['id']);
            return $produto->getProdutoById();
        }

        public function listarProdutosAdmin($qtd) {
            $produto = Container::getModel('App\Models\Produto');
            return $produto->listarProdutosAdmin($qtd);
        }
        public function pesquisarProduto() {
            $produto = Container::getModel('App\Models\Produto');
            $produto->__set('nome', $_POST['textoPesquisa']);
            $produto->__set('descricao', $_POST['textoPesquisa']);
            return $produto->getProdutoByName();
        }

        public function editarProduto() {
            $produto = Container::getModel('App\Models\Produto');
            $produto->__set('id', $_POST['id']);
            $produto->__set('nome', $_POST['nome']);
            $produto->__set('descricao', $_POST['descricao']);
            $produto->__set('preco', $_POST['preco']);
            $produto->__set('img', $_POST['img']);
            $produto->__set('img1', $_POST['img1']);
            $produto->__set('img2', $_POST['img2']);
            $produto->__set('img3', $_POST['img3']);

            $produto->updateProduto();
        }

        public function deletarProduto() {
            $produto = Container::getModel('App\Models\Produto');
            $produto->__set('id', $_POST['id']);
            $produto->deleteProduto();
        }

        // Carrinho methods

        public function adicionarCarrinho() {
            $carrinho = Container::getModel('App\Models\Carrinho');
            $carrinho->__set('id_usuario', $_SESSION['usuario']['id']);
            $carrinho->__set('id_produto', $_POST['id_produto']);
            $carrinho->__set('quantidade', $_POST['quantidade']);

            $carrinho->createCarrinho();
        }
        public function comprarCarrinho() {
            $carrinho = Container::getModel('App\Models\Carrinho');
            $carrinho->__set('id_usuario', $_SESSION['usuario']['id']);
            $carrinho->comprarCarrinho();
        }

        public function listarCarrinho() {
            $carrinho = Container::getModel('App\Models\Carrinho');
            $carrinho->__set('id_usuario', $_SESSION['usuario']['id']);
            return $carrinho->getCarrinho();
        }
        public function listarQuantidade() {
            $carrinho = Container::getModel('App\Models\Carrinho');
            $carrinho->__set('id_usuario', $_SESSION['usuario']['id']);
            $_SESSION['quantidade'] = $carrinho->getQuantidade();
        }
        public function alterarCarrinhoMax() {
            $carrinho = Container::getModel('App\Models\Carrinho');
            $carrinho->__set('id_usuario', $_SESSION['usuario']['id']);
            $carrinho->__set('id_produto', $_POST['id_produto']);
            $carrinho->__set('quantidade', $_POST['quantidade']);
            $carrinho->updateCarrinhoMax();
        }
        public function alterarCarrinhoMin() {
            $carrinho = Container::getModel('App\Models\Carrinho');
            $carrinho->__set('id_usuario', $_SESSION['usuario']['id']);
            $carrinho->__set('id_produto', $_POST['id_produto']);
            $carrinho->__set('quantidade', $_POST['quantidade']);
            $carrinho->updateCarrinhoMin();
        }
        public function removerItemCarrinho() {
            $carrinho = Container::getModel('App\Models\Carrinho');
            $carrinho->__set('id_usuario', $_POST['id_usuario']);
            $carrinho->__set('id_produto', $_POST['id_produto']);
            $carrinho->removerItemCarrinho();
        }
        public function deletarCarrinho() {
            $carrinho = Container::getModel('App\Models\Carrinho');
            $carrinho->__set('id_usuario', $_SESSION['usuario']['id']);
            $carrinho->deleteCarrinho();
        }

        // Pedido methods

        public function compraFinalizada() {
            $pedido = Container::getModel('App\Models\Pedido');
            $pedido->__set('id_usuario', $_SESSION['usuario']['id']);
            return $pedido->getPedido();
        }

        
    }