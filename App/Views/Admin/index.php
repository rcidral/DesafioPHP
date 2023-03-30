<html>

<head>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/semantic-ui-css@2.4.1/semantic.min.css">
</head>
<header>
    <div class="container">
      <div class="nav-bar">
        <div id="logo-id" class="nav-item nav-item-hidden nav-item-left">
          <a href="#">
            <img src="https://raw.githubusercontent.com/bystack/.github/main/bannerWB.png" alt="">
          </a>
        </div>
        <div class="nav-item nav-item-right">
            <?php if (isset($_SESSION['authenticated'])) { ?>
              <div class="dropdown">
                <span><?= $_SESSION['nome'] ?></span>
                <div class="dropdown-content">
                  <button id="sair">
                    Sair
                  </button>
                </div>
              </div>
            <?php } ?>
            </div>
        </div>
      </div>
  </header>

<body>
  <div style="margin-top: 15px;" class="ui container">


    <h1>Produtos</h1>
    <button class="ui button right floated teal btnCadastroProduto">Novo Produto</button>


    <table class="ui table">
      <thead>
        <tr>
          <th>Id</th>
          <th>Nome</th>
          <th>Data de Criação</th>
          <th>Data de Alteração</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($_SESSION['produtos'] as $produto) { ?>
          <tr>
            <td><?= $produto->id ?></td>
            <td><?= $produto->nome ?></td>
            <td><?= $produto->data_criacao ?></td>
            <td><?= $produto->data_alteracao ?></td>
            <td>
              <button onclick="produtoRed(<?= $produto->id ?>)" class="ui button basic teal">
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
    <button class="ui button right floated teal btnCadastroUsuario">Novo usuario</button>

    <!-- Tabela de usuarios cadastrados -->
    <table class="ui table">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Email</th>
          <th>Data de Criação</th>
          <th>Data de Alteração</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($_SESSION['usuarios'] as $usuario) { ?>
          <tr>
            <td><?= $usuario->nome ?></td>
            <td><?= $usuario->email ?></td>
            <td><?= $usuario->data_criacao ?></td>
            <td><?= $usuario->data_alteracao ?></td>
            <td>
            <button onclick="usuarioRed(<?= $usuario->id ?>)" class="ui button basic teal">
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