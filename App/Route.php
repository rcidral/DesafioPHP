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
            if(!isset($_SESSION['produtos']) || $_SESSION['produtos'] == "") {
                $_SESSION['produtos'] = $appController->listarProdutos();
            }
            if(isset($_SESSION['usuario']['id'])) {
                $_SESSION['carrinho'] = $appController->listarCarrinho();
                $appController->listarQuantidade();
            }
            include '../App/Views/Home/index.php';
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
            json_encode(['success' => true]);
            break;
        }
        case '/admin': {
            $_SESSION['usuarios'] = $appController->listarUsuariosAdmin($_SESSION['pageNumberUser']);
            $_SESSION['produtos'] = $appController->listarProdutosAdmin($_SESSION['pageNumberProduct']);
            include '../App/Views/Admin/index.php';
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
            }
            include '../App/Views/Produto/index.php';
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
            echo json_encode(['success' => true]);
            break;
        }
        case '/alterarCarrinhoMin': {
            $appController->alterarCarrinhoMin();
            echo json_encode(['success' => true]);
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
        }
        case '/refreshTableProduct': {
            if(!isset($_POST['qtdProduct']) || $_POST['qtdProduct'] == null) {
                $_SESSION['pageNumberProduct'] = 15;
            } else {
                $_SESSION['pageNumberProduct'] = $_POST['qtdProduct'];
            }
        }

    }

?>