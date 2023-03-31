<?php 


    $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    require_once "../App/Controllers/AppController.php";
    $ProdutoController = new ProdutoController();
    $UsuarioController = new UsuarioController();
    $CarrinhoController = new CarrinhoController();
    $PedidoController = new PedidoController();
    
    switch($urlPath) {
        case '/':
            if(!isset($_SESSION['id'])) {
                $ProdutoController->listarProdutos();
                if(isset($_SESSION['pesquisar']) && $_SESSION['pesquisar'] != null) {
                    $_SESSION['produtos'] = $_SESSION['pesquisar'];
                } else {
                    $ProdutoController->listarProdutos();
                }
            } else {
            if(isset($_SESSION['id'])) {
                if(isset($_SESSION['pesquisar']) && $_SESSION['pesquisar'] != null) {
                    $_SESSION['produtos'] = $_SESSION['pesquisar'];
                } else {
                    $ProdutoController->listarProdutos();
                }
                $CarrinhoController->listarQuantidadeDeProdutos();
                $CarrinhoController->listarCarrinho();
                $CarrinhoController->getPrecoCarrinho();
            }
            }
            include "../App/Views/Home/index.php";
            break;
        case '/login':     
            include "../App/Views/Login/index.php";
            break;
        case '/auth':
            include "../App/Controllers/AuthController.php";
            break;
        case '/logout':
            session_destroy();
            echo json_encode(['success' => true]);
            break;
        case '/admin':
            $_SESSION['produtos'] = $ProdutoController->listarProdutosAdmin($_SESSION['pageNumber']);
            $_SESSION['usuarios'] = $UsuarioController->listarUsuariosAdmin($_SESSION['pageNumber']);
            include "../App/Views/Admin/index.php";
            break;
        case '/refreshTable':
            if(!isset($_REQUEST['qtd']) || $_REQUEST['qtd'] == null) {
                $_SESSION['pageNumber'] = 15;
            } else {
                $_SESSION['pageNumber'] = $_REQUEST['qtd'];
            }
            break;
        case '/cadastroProduto':
            include "../App/Views/Produto/cadastro.php";
            break;
        case '/updateProduto':
            $ProdutoController->alterarProduto();
            include "../App/Views/Admin/index.php";
            break;
        case '/cadastroUsuario':
            include "../App/Views/Admin/cadastro.php";
            break;
        case '/editarUsuario':
            include "../App/Views/Admin/editar.php";
            break;
        case '/updateProduto':
            $ProdutoController->alterarProduto();
            include "../App/Views/Admin/index.php";
            break;
        case '/editarProduto':
            include "../App/Views/Produto/editar.php";
            break;
        case '/deleteProduto':
            $ProdutoController->deletarProduto();
            include "../App/Views/Admin/index.php";
            break;
        case '/updateUsuario':
            $UsuarioController->alterarUsuario();
            include "../App/Views/Admin/index.php";
            break;
        case '/createUsuario':
            $UsuarioController->createUsuario();
            include "../App/Views/Admin/index.php";
            break;
        case '/createProduto':
            $ProdutoController->createProduto();
            echo json_encode(['success' => true]);
            include "../App/Views/Admin/index.php";
            break;
        case '/deleteUsuario':
            $UsuarioController->deletarUsuario();
            include "../App/Views/Admin/index.php";
            break;
        case '/adicionarCarrinho':
            $CarrinhoController->adicionarCarrinho();
            break;
        case '/produtoRed':
            $_SESSION['idProdutoSolo'] = $_REQUEST['idProdutoSolo'];
            echo json_encode(['success' => true]);
            break;
        case '/produtoRedEdit':
            $_SESSION['idProdutoEdit'] = $_REQUEST['idProdutoEdit'];
            echo json_encode(['success' => true]);
            break;
        case '/usuarioRedEdit':
            $_SESSION['idUsuarioEdit'] = $_REQUEST['idUsuarioEdit'];
            echo json_encode(['success' => true]);
            break;
        case '/produto':
            $id = $_SESSION['idProdutoSolo'];
            $ProdutoController->listarProduto($id);
            if(isset($_SESSION['id']) && $_SESSION['id'] != null ) {        
                $CarrinhoController->listarQuantidadeDeProdutos();
                $CarrinhoController->listarCarrinho();
                $CarrinhoController->getPrecoCarrinho();
            }
            include "../App/Views/Produto/index.php";
            break;
        case '/limparCarrinho':
            $CarrinhoController->limparCarrinho();
            break;
        case '/pesquisar':
            $ProdutoController->pesquisarProduto($_REQUEST['pesquisar']);
            break;
        case '/removerItemCarrinho':
            $CarrinhoController->removerItemCarrinho($_REQUEST['idProdutoRemover'], $_REQUEST['idUsuarioRemover']);
            break;
        case '/finalizarCompra':
            $CarrinhoController->finalizarCompra($_REQUEST['idUsuarioFinal']);
            break;
        case '/compraFinalizada': 
            $PedidoController->listarPedido($_SESSION['id']);
            include "../App/Views/Home/compraFinalizada.php";
            break;
    }
