<?php

    $product = include "../App/Models/Produto.php";
    $pedido = include "../App/Models/Pedido.php";
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
            $usuario->__set('id', $_POST['idUsuarioEditFinal']);
            $usuario->__set('nome', $_POST['nome']);
            $usuario->__set('nascimento', $_POST['nascimento']);
            $usuario->__set('telefone', $_POST['telefone']);
            $usuario->__set('email', $_POST['email']);
            $usuario->__set('senha', $_POST['senha']);

            $usuario->alterar();
        }
        public function deletarUsuario() {
            $usuario = Container::getModel('Usuario');
            $usuario->__set('id', $_REQUEST['id']);
            $usuario->deletar();
        }

        public function listarUsuariosAdmin($qtd) {
            $usuario = Container::getModel('Usuario');
            return $usuario->listarUsuariosAdmin($qtd);
        }

        public function listarUsuario($id) {
            $usuario = Container::getModel('Usuario');
            $usuario->__set('id', $id);
            return $usuario->listarUsuario();
        }
    }

    class ProdutoController {
        public function listarProdutos() {
            $produto = Container::getModel('Produto');
            $_SESSION['produtos'] = $produto->listar();
        }
        public function alterarProduto() {
            $produto = Container::getModel('Produto');
            $produto->__set('id', $_POST['idProdutoEditFinal']);
            $produto->__set('nome', $_POST['nome']);
            $produto->__set('descricao', $_POST['descricao']);
            $produto->__set('preco', $_POST['preco']);
            if($_POST['img'] != "") {
                $produto->__set('img', $_POST['img']);
            }
            if($_POST['img1'] != "") {
                $produto->__set('img1', $_POST['img1']);
            }
            if($_POST['img2'] != "") {
                $produto->__set('img2', $_POST['img2']);
            }
            if($_POST['img3'] != "") {
                $produto->__set('img3', $_POST['img3']);
            }
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
            $produto->__set('img1', $_REQUEST['img1']);
            $produto->__set('img2', $_REQUEST['img2']);
            $produto->__set('img3', $_REQUEST['img3']);
            $produto->createProduto();
        }
        public function listarProduto($id) {
            $produto = Container::getModel('Produto');
            $produto->__set('id', $id);
            $_SESSION['produto'] = $produto->listarProduto();
        }

        public function listarProdutoEdit($id) {
            $produto = Container::getModel('Produto');
            $produto->__set('id', $id);
            return $produto->listarProduto();
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
            $carrinho->__set('quantidade', $_REQUEST['qtd']);
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
        public function removerItemCarrinho($id_produto, $id_usuario) {
            $carrinho = Container::getModel('Carrinho');
            $carrinho->__set('id_usuario', $id_usuario);
            $carrinho->__set('id_produto', $id_produto);
            $carrinho->removerItemCarrinho();
            echo json_encode(['success' => true]);
        }
        public function finalizarCompra($id_usuario) {
            $carrinho = Container::getModel('Carrinho');
            $carrinho->__set('id_usuario', $id_usuario);
            $carrinho->finalizarCompra();
            echo json_encode(['success' => true]);
        }

        public function plusCarrinho($id_produto, $value) {
            $carrinho = Container::getModel('Carrinho');
            $carrinho->__set('id_usuario', $_SESSION['id']);
            $carrinho->__set('id_produto', $id_produto);
            $carrinho->__set('quantidade', $value);
            $carrinho->plusCarrinho();
        }

        public function degreeCarrinho($id_produto, $value) {
            $carrinho = Container::getModel('Carrinho');
            $carrinho->__set('id_usuario', $_SESSION['id']);
            $carrinho->__set('id_produto', $id_produto);
            $carrinho->__set('quantidade', $value);
            $carrinho->degreeCarrinho();
        }
        
    }

    class PedidoController {
        public function listarPedido($id) {
            $pedido = Container::getModel('Pedido');
            $pedido->__set('id_usuario', $id);
            $_SESSION['pedidos'] = $pedido->listarPedido();
        }
    }

?>