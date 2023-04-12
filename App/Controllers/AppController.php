<?php

    namespace App\Controllers;
    use App\Models\Container;
    require_once "../App/Models/Container.php";
    require_once "../App/Models/Usuario.php";
    require_once "../App/Models/Produto.php";
    require_once "../App/Models/ProdutoRecomendado.php";
    require_once "../App/Models/Carrinho.php";
    require_once "../App/Models/Pedido.php";
    require_once "../App/Models/Favorito.php";

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
            $produto->__set('img', $_FILES['img']['name']);
            $produto->__set('img1', $_FILES['img1']['name']);
            $produto->__set('img2', $_FILES['img2']['name']);
            $produto->__set('img3', $_FILES['img3']['name']);

            $destino = __DIR__.'\..\..\Public\assets\product/'.$_FILES['img']['name'];
            move_uploaded_file($_FILES['img']['tmp_name'], $destino);

            $destino = __DIR__.'\..\..\Public\assets\product/'.$_FILES['img1']['name'];
            move_uploaded_file($_FILES['img1']['tmp_name'], $destino);

            $destino = __DIR__.'\..\..\Public\assets\product/'.$_FILES['img2']['name'];
            move_uploaded_file($_FILES['img2']['tmp_name'], $destino);

            $destino = __DIR__.'\..\..\Public\assets\product/'.$_FILES['img3']['name'];
            move_uploaded_file($_FILES['img3']['tmp_name'], $destino);

            $produto->createProduto();
        }

        public function cadastrarProdutoRecomendado() {
            $produto = Container::getModel('App\Models\ProdutoRecomendado');
            $produto->__set('nome', $_POST['nome']);
            $produto->__set('sequencia', $_POST['sequencia']);
            $produto->__set('img', $_FILES['img']['name']);

            $destino = __DIR__.'\..\..\Public\assets\product-recommended/'.$_FILES['img']['name'];
            move_uploaded_file($_FILES['img']['tmp_name'], $destino);

            $produto->createProdutoRecomendado();
        }

        public function listarProdutosRecomendados() {
            $produto = Container::getModel('App\Models\ProdutoRecomendado');
            return $produto->getProdutosRecomendados();
        }

        public function listarProdutoRecomendado() {
            $produto = Container::getModel('App\Models\ProdutoRecomendado');
            $produto->__set('id', $_POST['id']);
            return $produto->getProdutoRecomendadoById();
        }

        public function listarProdutosLogado() {
            $produto = Container::getModel('App\Models\Produto');
            return $produto->getProdutosLogado();
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

        public function listarProdutoRecomendadoSequencia1() {
            $produto = Container::getModel('App\Models\ProdutoRecomendado');
            return $produto->getProdutoRecomendadoSequencia1();
        }

        public function listarProdutoRecomendadoSequencia2() {
            $produto = Container::getModel('App\Models\ProdutoRecomendado');
            return $produto->getProdutoRecomendadoSequencia2();
        }

        public function listarProdutoRecomendadoSequencia3() {
            $produto = Container::getModel('App\Models\ProdutoRecomendado');
            return $produto->getProdutoRecomendadoSequencia3();
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
            $produto->__set('img', $_FILES['img']['name']);
            $produto->__set('img1', $_FILES['img1']['name']);
            $produto->__set('img2', $_FILES['img2']['name']);
            $produto->__set('img3', $_FILES['img3']['name']);

            $destino = __DIR__.'\..\..\Public\assets\product/'.$_FILES['img']['name'];
            move_uploaded_file($_FILES['img']['tmp_name'], $destino);

            $destino = __DIR__.'\..\..\Public\assets\product/'.$_FILES['img1']['name'];
            move_uploaded_file($_FILES['img1']['tmp_name'], $destino);

            $destino = __DIR__.'\..\..\Public\assets\product/'.$_FILES['img2']['name'];
            move_uploaded_file($_FILES['img2']['tmp_name'], $destino);

            $destino = __DIR__.'\..\..\Public\assets\product/'.$_FILES['img3']['name'];
            move_uploaded_file($_FILES['img3']['tmp_name'], $destino);

            $produto->updateProduto();
        }

        public function editarProdutoRecomendado() {
            $produto = Container::getModel('App\Models\ProdutoRecomendado');
            $produto->__set('id', $_POST['id']);
            $produto->__set('nome', $_POST['nome']);
            $produto->__set('sequencia', $_POST['sequencia']);
            $produto->__set('img', $_FILES['img']['name']);

            $destino = __DIR__.'\..\..\Public\assets\product-recommended/'.$_FILES['img']['name'];
            move_uploaded_file($_FILES['img']['tmp_name'], $destino);

            $produto->updateProdutoRecomendado();
        }

        public function deletarProduto() {
            $produto = Container::getModel('App\Models\Produto');
            $produto->__set('id', $_POST['id']);
            $produto->deleteProduto();
        }

        public function deletarRecomendadoProduto() {
            $produto = Container::getModel('App\Models\ProdutoRecomendado');
            $produto->__set('id', $_POST['id']);
            $produto->deleteProdutoRecomendado();
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
        public function listarPrecoTotal() {
            $carrinho = Container::getModel('App\Models\Carrinho');
            $carrinho->__set('id_usuario', $_SESSION['usuario']['id']);
            return $carrinho->getPrecoTotal();
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
        public function getPedidosAdmin() {
            $pedido = Container::getModel('App\Models\Pedido');
            return $pedido->getPedidosAdmin();
        }

        // Favoritos methods

        public function adicionarFavorito() {
            $favorito = Container::getModel('App\Models\Favorito');
            $favorito->__set('id_usuario', $_SESSION['usuario']['id']);
            $favorito->__set('id_produto', $_POST['id_produto']);

            $favorito->createFavorito();
        }

        public function listarFavoritos() {
            $favorito = Container::getModel('App\Models\Favorito');
            $favorito->__set('id_usuario', $_SESSION['usuario']['id']);
            return $favorito->getFavoritos();
        }

        public function listarFavoritosAdmin() {
            $favorito = Container::getModel('App\Models\Favorito');
            return $favorito->getFavoritosAdmin();
        }

        public function listarMaisFavoritados() {
            $favorito = Container::getModel('App\Models\Favorito');
            return $favorito->getMostFavoritos();
        }

        public function removerFavorito() {
            $favorito = Container::getModel('App\Models\Favorito');
            $favorito->__set('id_usuario', $_POST['id_usuario']);
            $favorito->__set('id_produto', $_POST['id_produto']);
            $favorito->deleteFavorito();
        }

        public function deletarFavoritos() {
            $favorito = Container::getModel('App\Models\Favorito');
            $favorito->__set('id_usuario', $_SESSION['usuario']['id']);
            $favorito->deleteFavoritos();
        }

        // Export methods

        public function exportarUsuariosCSV() {
            $usuario = Container::getModel('App\Models\Usuario');
            $usuario->exportarUsuariosCSV();
        }

        public function exportarProdutosCSV() {
            $produto = Container::getModel('App\Models\Produto');
            $produto->exportarProdutosCSV();
        }

        public function exportarFavoritoCSV() {
            $favorito = Container::getModel('App\Models\Favorito');
            $favorito->exportarFavoritoCSV();
        }

        // Import methods

        public function importarUsuariosCSV() {
            $usuario = Container::getModel('App\Models\Usuario');
            $usuario->importarUsuariosCSV();
        }

        public function importarProdutosCSV() {
            $produto = Container::getModel('App\Models\Produto');
            $produto->importarProdutosCSV();
        }
    }