<?php 


    $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    require_once "../App/Controllers/AppController.php";
    $ProdutoController = new ProdutoController();
    $UsuarioController = new UsuarioController();
    $CarrinhoController = new CarrinhoController();

    
    switch($urlPath) {
        case '/':
            $ProdutoController->listarProdutos();
            if(isset($_SESSION['id'])) {
                $CarrinhoController->listarQuantidadeDeProdutos();
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
            $ProdutoController->listarProdutos();
            $UsuarioController->listarUsuarios();
            include "../App/Views/Admin/index.php";
            break;
        case '/updateProduto':
            $ProdutoController->alterarProduto();
            include "../App/Views/Admin/index.php";
            break;
        case '/createProduto':
            $ProdutoController->createProduto();
            include "../App/Views/Admin/index.php";
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
        case '/deleteUsuario':
            $UsuarioController->deletarUsuario();
            include "../App/Views/Admin/index.php";
            break;
        case '/adicionarCarrinho':
            $CarrinhoController->adicionarCarrinho();
            break;
            break;
        case '/produto':
            $ProdutoController->listarProduto();
            include "../App/Views/Produto/index.php";
            break;

    }

    

?>