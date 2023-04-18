<?php 

    namespace App;
    include '../App/Controllers/AuthController.php';
    include '../App/Controllers/AppController.php';

    $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $authController = new \App\Controllers\AuthController();
    $appController = new \App\Controllers\AppController();

    switch($urlPath) {
        // Auth routes
        case '/': {
            if(!isset($_SESSION['usuario']['id']) || $_SESSION['usuario']['id'] == null) {
                if(!isset($_SESSION['produtos']) || $_SESSION['produtos'] == null) {
                    $_SESSION['produtos'] = $appController->listarProdutos();
                }
            } 
            if(isset($_SESSION['usuario']['id'])) {
                if(!isset($_SESSION['produtos']) || $_SESSION['produtos'] == null) {
                    $_SESSION['produtos'] = $appController->listarProdutosLogado();
                }
                $_SESSION['carrinho'] = $appController->listarCarrinho();
                $_SESSION['favoritos'] = $appController->listarFavoritos();
                $appController->listarQuantidade();
                $_SESSION['precoTotal'] = $appController->listarPrecoTotal();
            }
            $_SESSION['produto_sequencia1'] = $appController->listarProdutoRecomendadoSequencia1();
            $_SESSION['produto_sequencia2'] = $appController->listarProdutoRecomendadoSequencia2();
            $_SESSION['produto_sequencia3'] = $appController->listarProdutoRecomendadoSequencia3();
            include '../App/Views/Home/index.php';
            $_SESSION['produtos'] = null;
            break;
        }
        case '/login': {
            include '../App/Views/Login/index.php';
            break;
        }
        case '/auth': {
            $authController->autenticar();
            break;
        }
        case '/logout': {
            session_destroy();
            $_SESSION['produtos'] = null;
            json_encode(['success' => true]);
            break;
        }
        case '/admin': {
            $_SESSION['usuarios'] = $appController->listarUsuariosAdmin($_SESSION['pageNumberUser']);
            $_SESSION['produtos'] = $appController->listarProdutosAdmin($_SESSION['pageNumberProduct']);
            $_SESSION['favoritos'] = $appController->listarFavoritosAdmin($_SESSION['pageNumberFavorite']);
            $_SESSION['pedidos'] = $appController->getPedidosAdmin($_SESSION['pageNumberPedido']);
            $_SESSION['produtos_recomendados'] = $appController->listarProdutosRecomendados();
            $_SESSION['mostFavoritos'] = $appController->listarMaisFavoritados();
            include '../App/Views/Admin/index.php';
            break;
        }

        case '/pedidoProdutoRed': {
            $_SESSION['pedidoProduto'] = $appController->listarPedidoProduto();
            $array = array();
            foreach($_SESSION['pedidoProduto'] as $pedidoProduto => $value) {
                $array[$pedidoProduto]['nome'] = $value['nome'];
                $array[$pedidoProduto]['quantidade'] = $value['quantidade'];
                $array[$pedidoProduto]['preco'] = $value['preco'];
                
            }
            header('Content-Type: application/json');
            echo json_encode($array);
            break;
        }

        case '/exportarPedidosCSV': {
            $appController->exportarPedidosCSV();
            break;
        }

        // User routes
        case '/cadastroUsuarioView': {
            include '../App/Views/Admin/Usuario/CadastroUsuario/index.php';
            break;
        }
        case '/cadastroUsuario': {
            $appController->cadastrarUsuario();
            echo json_encode(['success' => true]);
            break;
        }
        case '/editarUsuarioView': {
            include '../App/Views/Admin/Usuario/EditarUsuario/index.php';
            break;
        }
        case '/editarUsuarioRed': {
            $_SESSION['usuarioEditar'] = $appController->listarUsuario();
            echo json_encode(['success' => true]);
            break;
        }
        case '/editarProdutoRecomendadoRed': {
            $_SESSION['produtoRecomendadoEditar'] = $appController->listarProdutoRecomendado();
            echo json_encode(['success' => true]);
            break;
        }
        case '/editarProdutoRecomendadoView': {
            include '../App/Views/Admin/Produto/EditarRecomendado/index.php';
            break;
        }
        case '/editarProdutoRecomendado': {
            $appController->editarProdutoRecomendado();
            echo json_encode(['success' => true]);
            break;
        }
        case '/editarUsuario': {
            $appController->editarUsuario();
            echo json_encode(['success' => true]);
            break;
        }
        case '/deleteUsuario': {
            $appController->deletarUsuario();
            echo json_encode(['success' => true]);
            break;
        }
        case '/deleteRecomendadoProduto': {
            $appController->deletarRecomendadoProduto();
            echo json_encode(['success' => true]);
            break;
        }
        case '/exportarUsuariosCSV': {
            $appController->exportarUsuariosCSV();
            break;
        }

        case '/importarUsuariosCSV': {
            $appController->importarUsuariosCSV();
            break;
        }

        // Product routes
        case '/cadastroProdutoView': {
            include '../App/Views/Admin/Produto/CadastroProduto/index.php';
            break;
        }
        case '/cadastroProduto': {
            $appController->cadastrarProduto();
            echo json_encode(['success' => true]);
            break;
        }
        case '/cadastroRecommendedProdutoView': {
            include '../App/Views/Admin/Produto/CadastroRecomendado/index.php';
            break;
        }
        case '/cadastroRecommendedProduto': {
            $appController->cadastrarProdutoRecomendado();
            echo json_encode(['success' => true]);
            break;
        }
        case '/pesquisar': {
            $_SESSION['produtos'] = $appController->pesquisarProduto();
            if($_SESSION['produtos'] != null) {
                echo json_encode(['success' => true]);
            }
            if($_SESSION['produtos'] == null) {
                echo json_encode(['success' => false]);
            }
            break;
        }
        case '/editarProdutoView': {
            include '../App/Views/Admin/Produto/EditarProduto/index.php';
            break;
        }
        case '/editarProdutoRed': {
            $_SESSION['produtoEditar'] = $appController->listarProduto();
            echo json_encode(['success' => true]);
            break;
        }
        case '/editarProduto': {
            $appController->editarProduto();
            echo json_encode(['success' => true]);
            break;
        }
        case '/deleteProduto': {
            $appController->deletarProduto();
            echo json_encode(['success' => true]);
            break;
        }
        case '/produtoRed': {
            $_SESSION['produto'] = $appController->listarProduto();
            echo json_encode(['success' => true]);
            break;
        }
        case '/produtoView': {
            if(isset($_SESSION['usuario']['id']) && $_SESSION['usuario']['id'] != "") {
                $_SESSION['carrinho'] = $appController->listarCarrinho();
                $appController->listarQuantidade();
                $_SESSION['favoritos'] = $appController->listarFavoritos();
                $_SESSION['precoTotal'] = $appController->listarPrecoTotal();
            }
            include '../App/Views/Produto/index.php';
            break;
        }

        case '/exportarProdutosCSV': {
            $appController->exportarProdutosCSV();
            break;
        }

        case '/importarProdutosCSV': {
            $appController->importarProdutosCSV();
            break;
        }

        // Carrinho routes

        case '/adicionarCarrinho': {
            $appController->adicionarCarrinho();
            echo json_encode(['success' => true]);
            break;
        }
        case '/comprarCarrinho': {
            $appController->comprarCarrinho();
            echo json_encode(['success' => true]);
            break;
        }
        case '/alterarCarrinhoMax': {
            $appController->alterarCarrinhoMax();
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'valorTotal' => $appController->listarPrecoTotal()]);
            break;
        }
        case '/alterarCarrinhoMin': {
            $appController->alterarCarrinhoMin();
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'valorTotal' => $appController->listarPrecoTotal()]);
            break;
        }
        case '/removerItemCarrinho': {
            $appController->removerItemCarrinho();
            echo json_encode(['success' => true]);
            break;
        }
        case '/deletarCarrinho': {
            $appController->deletarCarrinho();
            echo json_encode(['success' => true]);
            break;
        }

        // Compra rout

        case '/compraFinalizada': {
            $_SESSION['pedido'] = $appController->compraFinalizada();
            include '../App/Views/Pedido/index.php';
            break;
        }

        // Admin Table

        case '/refreshTableUser': {
            if(!isset($_POST['qtdUser']) || $_POST['qtdUser'] == null) {
                $_SESSION['pageNumberUser'] = 15;
            } else {
                $_SESSION['pageNumberUser'] = $_POST['qtdUser'];
            }
            break;
        }
        case '/refreshTableProduct': {
            if(!isset($_POST['qtdProduct']) || $_POST['qtdProduct'] == null) {
                $_SESSION['pageNumberProduct'] = 15;
            } else {
                $_SESSION['pageNumberProduct'] = $_POST['qtdProduct'];
            }
            break;
        }

        case '/refreshTableFavorite': {
            if(!isset($_POST['qtdFavorite']) || $_POST['qtdFavorite'] == null) {
                $_SESSION['pageNumberFavorite'] = 15;
            } else {
                $_SESSION['pageNumberFavorite'] = $_POST['qtdFavorite'];
            }
            break;
        }

        case '/refreshTablePedido': {
            if(!isset($_POST['qtdPedido']) || $_POST['qtdPedido'] == null) {
                $_SESSION['pageNumberPedido'] = 15;
            } else {
                $_SESSION['pageNumberPedido'] = $_POST['qtdPedido'];
            }
            break;
        }

        // Favoritos routes

        case '/adicionarFavorito': {
            $appController->adicionarFavorito();
            echo json_encode(['success' => true]);
            break;
        }

        case '/removerItemFavorito': {
            $appController->removerFavorito();
            echo json_encode(['success' => true]);
            break;
        }

        case '/removerFavorito': {
            $appController->deletarFavoritos();
            echo json_encode(['success' => true]);
            break;
        }

        case '/exportarFavoritoCSV': {
            $appController->exportarFavoritoCSV();
            break;
        }

        // move csv

        case '/moverUsuarioCSV': {
            $appController->moverUsuarioCSV();
            break;
        }

        case '/moverProdutoCSV': {
            $appController->moverProdutoCSV();
            break;
        }

        case '/moverFavoritoCSV': {
            $appController->moverFavoritoCSV();
            break;
        }

        case '/moverPedidoCSV': {
            $appController->moverPedidoCSV();
            break;
        }
    }

?>