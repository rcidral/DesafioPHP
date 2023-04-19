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
        <div id="container-main" class="container-main">
            <div style="border-radius: 15px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); padding: 30px;" class="container-user">
                <h2>Usuários</h2>
                <div class="options">
                    <div class="options-btn">
                        <button onclick="showModalExportUsuario()">Importar</button>
                        <button id="export-user">Exportar</button>
                    </div>
                    <div class="options-btn">
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
                    <?php foreach ($_SESSION['usuarios'] as $usuario) { ?>
                        <tr>
                            <td><?= $usuario['nome'] ?></td>
                            <td><?= $usuario['email'] ?></td>
                            <td><?= date('d/m/Y',strtotime($usuario['data_criacao'])) ?></td>
                            <td><?php if($usuario['data_alteracao'] == null) { echo 'Não alterado'; } else { echo date('d/m/Y',strtotime($usuario['data_alteracao'])); } ?></td>
                            <td>
                                <button onclick="editarUsuario(<?= $usuario['id'] ?>)">Editar</button>
                                <button onclick="showModalUsuario(<?= $usuario['id'] ?>)">Deletar</button>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <div class="btn-page">
                    <button onclick="change15User()">15</button>
                    <button onclick="change50User()">50</button>
                    <button onclick="change100User()">100</button>
                </div>
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
            <div class="modal-export-usuario">
                <div class="modal-export-usuario-content">
                    <h2>Importar Usuários</h2>
                    <div class="text">
                        <p>Baixar</p>
                        <p id="template-user" class="p-template">template.csv</p>
                    </div>
                    <input id="csv-user" type="file" accept=".csv">
                    <div class="modal-export-usuario-btn">
                        <button onclick="closeModalExportUsuario()">Cancelar</button>
                        <button id="btn-import-user">Importar</button>
                    </div>
                </div>
            </div>
            <div style="border-radius: 15px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); padding: 30px;" class="container-product">
                <h2>Produtos</h2>
                <div class="options">
                    <div class="options-btn">
                        <button onclick="showModalExportProduto()">Importar</button>
                        <button id="export-produto">Exportar</button>
                    </div>
                    <button id="cadastro-produto-btn" class="cadastro-btn">Cadastrar</button>
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
                    <?php foreach ($_SESSION['produtos'] as $produto) { ?>
                        <tr>
                            <td><?= $produto['id'] ?></td>
                            <td><?= $produto['nome'] ?></td>
                            <td><?= (number_format($produto['preco'], 2, ',', '')) ?></td>
                            <td><?= date('d/m/Y',strtotime($produto['data_criacao'])) ?></td>
                            <td><?php if($produto['data_alteracao'] == null) { echo 'Não alterado'; } else { echo date('d/m/Y',strtotime($produto['data_alteracao'])); } ?></td>
                            <td>
                                <button onclick="editarProduto(<?= $produto['id'] ?>)">Editar</button>
                                <button onclick="showModalProduto(<?= $produto['id'] ?>)">Deletar</button>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <div class="btn-page">
                    <button onclick="change15Product()">15</button>
                    <button onclick="change50Product()">50</button>
                    <button onclick="change100Product()">100</button>
                </div>
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
                <div class="modal-export-produto">
                    <div class="modal-export-produto-content">
                        <h2>Importar Produtos</h2>
                        <div class="text">
                            <p>Baixar</p>
                            <p id="template-produto" class="p-template">template.csv</p>
                        </div>
                        <input id="csv-produto" type="file" accept=".csv">
                        <div class="modal-export-produto-btn">
                            <button onclick="closeModalExportProduto()">Cancelar</button>
                            <button id="btn-import-produto">Importar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-recommended-produto">
                <h2>Produtos Recomendados</h2>
                    <div class="options">
                        <div class="options-btn"></div>
                        <button id="cadastro-recommended-produto-btn" class="cadastro-btn">Cadastrar</button>
                    </div>
                <table>
                    <tr>
                        <th class="first">Nome</th>
                        <th>Número de Sequencia</th>
                        <th class="last">Ações</th>
                    </tr>
                        <?php foreach($_SESSION['produtos_recomendados'] as $produto_recomendado) { ?>
                            <tr>
                                <td><?= $produto_recomendado['nome'] ?></td>
                                <td><?= $produto_recomendado['sequencia'] ?></td>
                                <td>
                                    <button onclick="editarProdutoRecomendado(<?= $produto_recomendado['id'] ?>)">Editar</button>
                                    <button onclick="showModalRecomendado(<?= $produto_recomendado['id'] ?>)">Deletar</button>
                                </td>
                            </tr>
                        <?php } ?>
                </table>
                <div class="modal-delete-recomendado">
                    <div class="modal-delete-recomendado-content">
                        <h2>Deletar Produto Recomendado</h2>
                        <p>Tem certeza que deseja deletar o produto recomendado?</p>
                        <div class="modal-delete-recomendado-btn">
                            <button id="btn-sim-recomendado" onclick>Sim</button>
                            <button onclick="closeModalRecomendado()">Não</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="most-favorites">
                    <div class="text">
                        <h2 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Produtos mais favoritados</h2>
                    </div>
                    <div class="most-favorites-content">
                        <?php $i = 1; ?>
                        <?php foreach($_SESSION['mostFavoritos'] as $mostFavoritos) { ?>
                            <div class="most-favorites-content-item">
                                <p><?=$i?></p><p><?=$mostFavoritos['nome']?></p><?php $i++; ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <div style="border-radius: 15px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); padding: 30px;" class="container-favorites">
                <h2>Favoritos</h2>
                <div class="options">
                    <div class="options-btn">
                        <button id="export-favorites">Exportar</button>
                    </div>
                </div>
                <table>
                    <tr>
                        <th style="max-width: 20px;" class="first">Nome do Usuário</th>
                        <th>Nome do Produto</th>
                        <th class="last">Preço</th>
                    </tr>
                    <?php foreach ($_SESSION['favoritos'] as $favorito) { ?>
                        <tr>
                            <td><?= $favorito['nome_usuario'] ?></td>
                            <td><?= $favorito['nome_produto'] ?></td>
                            <td><?= (number_format($favorito['preco'], 2, ',', '')) ?></td>
                        </tr>
                    <?php } ?>
                </table>
                <div class="btn-page">
                    <button onclick="change15Favorite()">15</button>
                    <button onclick="change50Favorite()">50</button>
                    <button onclick="change100Favorite()">100</button>
                </div>
            </div>
            <div style="border-radius: 15px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); padding: 30px;" class="container-pedidos">
                <h2>Pedidos</h2>
                <div class="options">
                    <div class="options-btn">
                        <button id="export-pedidos">Exportar</button>
                    </div>
                </div>
                <table>
                    <tr>
                        <th class="first">Número</th>
                        <th>Quantidade</th>
                        <th>Valor total</th>
                        <th>Comprador</th>
                        <th class="last">Ações</th>
                    </tr>
                    <?php foreach ($_SESSION['pedidos'] as $pedido) { ?>
                        <tr>
                            <td><?= $pedido['id_pedido'] ?></td>
                            <td><?= $pedido['quantidade'] ?></td>
                            <td><?= number_format($pedido['preco'], 2, ',', '') ?></td>
                            <td><?= $pedido['email'] ?></td>
                            <td>
                                <div>
                                    <button onclick="showModalPedidoProduto(<?= $pedido['id_pedido'] ?>)">Produtos</button>
                                </div>

                                <div>

                                </div>

                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <div class="btn-page">
                    <button onclick="change15Pedido()">15</button>
                    <button onclick="change50Pedido()">50</button>
                    <button onclick="change100Pedido()">100</button>
                </div>
            </div>
            <div id="modal-produtos-pedido" class="modal-produtos-pedido">
                <div class="modal-produtos-pedido-content">
                    <h2>Produtos do Pedido</h2>
                    <div class="modal-produtos-pedido-content-table">
                        <table id="tableProdutos">      
                        </table>
                    </div>
                    <div class="modal-produtos-pedido-btn">
                        <button onclick="closeModalPedidoProduto()">Fechar</button>
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
                <a href="/">Rio Grande do Sul 385</a>
            </div>
        </div>

    </footer>
</body>

</html>

<script src="./js/script.js"></script>