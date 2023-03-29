<html>

<head>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/semantic-ui-css@2.4.1/semantic.min.css">
</head>
<header>
  <div class="container">
    <nav class="nav">
      <ul class="nav-list nav-list-mobile">
        <li class="nav-item">
          <a href="# " class="nav-link nav-link-nike-logo"></a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link nav-link-bag"></a>
        </li>
        <li class="nav-item">
          <div class="mobile-menu">
            <span class="line line-top"></span>
            <span class="line line-bottom"></span>
          </div>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link nav-link-search"></a>
        </li>
      </ul>
      <!--     closes ul list  mobile-->

      <div class="nav-bar">
        <div id="logo-id" class="nav-item nav-item-hidden nav-item-left">
          <a href="#"><img style="position: relative; top: 2px; width: 110px; height: 50px" src="https://raw.githubusercontent.com/bystack/.github/main/banner.png" alt=""></a>
        </div>
        <div class="nav-item nav-item-right">
          <ul class="nav-list">
            <div class="dropdown">
              <span style="position: relative; top: 5px; font-size: 15px; font-weight: 100;">Administrador</span>
              <div class="dropdown-content">
                <button id="sair">Sair</button>
              </div>
            </div>
          </ul>
        </div>
        <!--  nav-list left items    -->
      </div>

    </nav>
  </div>
</header>

<body>
  <div style="margin-top: 15px;" class="ui container">


    <h1>Produtos</h1>

    <table class="ui table">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Descrição</th>
          <th>Preco</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($_SESSION['produtos'] as $produto) { ?>
          <tr>
            <td><?= $produto->nome ?></td>
            <td><?= $produto->descricao ?></td>
            <td>R$ <?= $produto->preco ?></td>
            <td>
              <button class="ui button basic teal btnEditar">
                <i class="pencil alternative icon"></i> Editar
              </button>
              <button id="id-button-modal-<?= $produto->id ?>" style="color: white;" class="ui button basic red btnExcluir">
                Remover
              </button>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <!-- FIM Tabela de Produtos cadastrados -->

    <button class="ui button right floated teal btnCadastro">Novo Produto</button>

    <!-- Modal de CRUD de Produtos -->
    <div id="modalCadastro" class="ui modal">
      <i class="close icon"></i>
      <div class="header">
        Cadastro de Produto
      </div>
      <div class="content">
        <div class="ui form">
          <div class="equal width fields">
            <div class="field">
              <label>Nome</label>
              <input type="text" id="nomeProduto">
            </div>
            <div class="field">
              <label>Descrição</label>
              <input type="text" id="descricao">
            </div>
            <div class="field">
              <label>Preço</label>
              <input type="number" id="preco">
            </div>
            <div class="field">
              <label>Imagem</label>
              <input type="file" id="img">
            </div>
          </div>
        </div>
      </div>
      <div class="actions">
        <button id="button-salvar" class="ui teal right labeled icon button">
          Salvar
          <i class="checkmark icon"></i>
        </button>
      </div>
    </div>
    <!-- FIM Modal de CRUD de Produtos -->


    <!-- Modal de Confirmação de Exclusão -->
    <div id="modalConfirmacaoExclusao" class="ui basic modal">
      <div class="ui icon header">
        <i class="archive icon"></i>
        Exclusão de Produto
      </div>
      <div class="content">
        <p>Tem certeza que deseja excluir o produto? Esta ação não pode ser revertida.</p>
      </div>
      <div class="actions">
        <div class="ui red basic cancel inverted button">
          <i class="remove icon"></i>
          Não
        </div>
        <div class="ui green ok inverted button">
          <i class="checkmark icon"></i>
          <button style="border: none; background-color:transparent; color: white" id="delete-yes" onclick>Sim</button>
        </div>
      </div>
    </div>
    <h1>Usuarios</h1>

    <!-- Tabela de usuarios cadastrados -->
    <table class="ui table">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Email</th>
          <th>Senha</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($_SESSION['usuarios'] as $usuario) { ?>
          <tr>
            <td><?= $usuario->nome ?></td>
            <td><?= $usuario->email ?></td>
            <td><?= $usuario->senha ?></td>
            <td>
              <button class="ui button basic teal btnCadastro">
                <i class="pencil alternative icon"></i> Editar
              </button>
              <button id="id-button-modal-<?= $usuario->id ?>" style="color: white;" class="ui button basic red btnExcluirUsuario">
                Remover
              </button>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <!-- FIM Tabela de usuarios cadastrados -->

    <button class="ui button right floated teal btnCadastroUsuario">Novo usuario</button>

    <!-- Modal de CRUD de usuarios -->
    <div id="modalCadastroUsuario" class="ui modal">
      <i class="close icon"></i>
      <div class="header">
        Cadastro de usuario
      </div>
      <div class="content">
        <div class="ui form">
          <div class="equal width fields">
            <div class="field">
              <label>Nome</label>
              <input type="text" id="nome">
            </div>
            <div class="field">
              <label>Email</label>
              <input type="text" id="email">
            </div>
            <div class="field">
              <label>senha</label>
              <input type="number" id="senha">
            </div>
          </div>
        </div>
      </div>
      <div class="actions">
        <button id="button-salvar-usuario" class="ui teal right labeled icon button">
          Salvar
          <i class="checkmark icon"></i>
        </button>
      </div>
    </div>
    <!-- FIM Modal de CRUD de usuarios -->

    <!-- Modal de Confirmação de Exclusão -->
    <div id="modalConfirmacaoExclusaoUsuario" class="ui basic modal">
      <div class="ui icon header">
        <i class="archive icon"></i>
        Exclusão de usuario
      </div>
      <div class="content">
        <p>Tem certeza que deseja excluir o usuario? Esta ação não pode ser revertida.</p>
      </div>
      <div class="actions">
        <div class="ui red basic cancel inverted button">
          <i class="remove icon"></i>
          Não
        </div>
        <div class="ui green ok inverted button">
          <i class="checkmark icon"></i>
          <button style="border: none; background-color:transparent; color: white" id="delete-yes-usuario" onclick>Sim</button>
        </div>
      </div>
    </div>
    <!-- FIM Modal de Confirmação de Exclusão -->



  </div>
</body>



<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/semantic-ui-css@2.4.1/semantic.min.js"></script>
<script src="./js/admin.js"></script>
<link rel="stylesheet" href="./style/admin.css">
</html>