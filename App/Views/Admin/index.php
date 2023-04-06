<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/admin.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <title>Shop</title>
</head>

<body>
    <header>
        <div class="container-header">
            <div class="logo">
                <img id="img-logo" src="https://raw.githubusercontent.com/bystack/.github/main/bannerWB.png" alt="logo">
            </div>
            <div class="user">
                <?php if (isset($_SESSION['authenticated'])) { ?>
                    <p id="drop"> <?= $_SESSION['usuario']['nome'] ?></p>
                <?php } ?>
            </div>
            <div class="dropdown">
                <p id="sair">Sair</p>
            </div>
        </div>
    </header>
    <main>
        <div class="container-main">
            <div class="container-user">
                <div class="options">
                    <h2>Usuario</h2>
                    <div class="options-btn">
                        <button onclick="change15User()">15</button>
                        <button onclick="change50User()">50</button>
                        <button onclick="change100User()">100</button>
                        <button id="cadastro-usuario-btn" class="cadastro-btn">Cadastrar</button>
                    </div>
                </div>
                <table>
                    <tr>
                        <th class="first">Nome</th>
                        <th>Email</th>
                        <th>Data de Criação</th>
                        <th>Data de Alteração</th>
                        <th class="last">Ações</th>
                    </tr>
                    <?php foreach($_SESSION['usuarios'] as $usuario) { ?>
                        <tr>
                            <td><?= $usuario['nome'] ?></td>
                            <td><?= $usuario['email'] ?></td>
                            <td><?= $usuario['data_criacao'] ?></td>
                            <td><?= $usuario['data_alteracao'] ?></td>
                            <td>
                                <button onclick="editarUsuario(<?=$usuario['id']?>)">Editar</button>
                                <button onclick="showModalUsuario(<?=$usuario['id']?>)">Deletar</button>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="modal-delete-usuario">
                <div class="modal-delete-usuario-content">
                    <h2>Deletar Usuário</h2>
                    <p>Tem certeza que deseja deletar o usuário?</p>
                    <div class="modal-delete-usuario-btn">
                        <button id="btn-sim-usuario" onclick>Sim</button>
                        <button onclick="closeModalUsuario()">Não</button>
                    </div>
                </div>
            </div>
            <div class="container-product">
                <div class="options">
                    <h2>Produtos</h2>
                    <div class="options-btn">
                        <button onclick="change15Product()">15</button>
                        <button onclick="change50Product()">50</button>
                        <button onclick="change100Product()">100</button>
                        <button id="cadastro-produto-btn" class="cadastro-btn">Cadastrar</button>
                    </div>
                </div>
                <table>
                    <tr>
                        <th class="first">Id</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Data de Criação</th>
                        <th>Data de Alteração</th>
                        <th class="last">Ações</th>
                    </tr>
                    <?php foreach($_SESSION['produtos'] as $produto) { ?>
                        <tr>
                            <td><?= $produto['id'] ?></td>
                            <td><?= $produto['nome'] ?></td>
                            <td><?= (number_format($produto['preco'], 2, ',', '')) ?></td>
                            <td><?= $produto['data_criacao'] ?></td>
                            <td><?= $produto['data_alteracao'] ?></td>
                            <td>
                                <button onclick="editarProduto(<?=$produto['id']?>)">Editar</button>
                                <button onclick="showModalProduto(<?=$produto['id']?>)">Deletar</button>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <div class="modal-delete-produto">
                    <div class="modal-delete-produto-content">
                        <h2>Deletar Produto</h2>
                        <p>Tem certeza que deseja deletar o produto?</p>
                        <div class="modal-delete-produto-btn">
                            <button id="btn-sim-produto" onclick>Sim</button>
                            <button onclick="closeModalProduto()">Não</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>

        <div class="container-footer">
            <div class="footer-copy">
                <p>© 2021 - ByStack</p>
            </div>
            <div class="footer-logo">
                <img src="https://raw.githubusercontent.com/bystack/.github/main/bannerWB.png" alt="logo">
            </div>
            <div class="footer-a">
                <a href="/">ByStack</a>
            </div>
        </div>

    </footer>
</body>

</html>

<script src="./js/script.js"></script>