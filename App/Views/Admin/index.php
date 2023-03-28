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

</html>

<script>
  $('#sair').click(function(e) {
    e.preventDefault();
    $.ajax({
      url: 'http://localhost:3000/logout',
      type: 'POST',
      dataType: 'json',
      success: function(data) {
        if (data.success) {
          window.location.href = 'http://localhost:3000/';
        }
      }
    });
  });

  function remover(id) {
    $.ajax({
      url: 'http://localhost:3000/deleteProduto',
      type: 'POST',
      data: {
        id: id
      },
      success: function(response) {
        window.location.href = "http://localhost:3000/admin"
      },
    })
  }

  function removerUsuario(id) {
    $.ajax({
      url: 'http://localhost:3000/deleteUsuario',
      type: 'POST',
      data: {
        id: id
      },
      success: function(response) {
        window.location.href = "http://localhost:3000/admin"
      },
    })
  }
  $('.btnExcluir').click(function(e) {
    let text = e.target.id;
    let idText = text.split("-");
    let id = idText[3];
    $('#delete-yes').attr("onclick", `remover(${id})`)
  })
  $('.btnExcluirUsuario').click(function(e) {
    let text = e.target.id;
    let idText = text.split("-");
    let id = idText[3];
    $('#delete-yes-usuario').attr("onclick", `removerUsuario(${id})`)
  })
  $('#button-salvar').click(function(e) {
    e.preventDefault();
    let nome = $('#nomeProduto').val();
    let descricao = $('#descricao').val();
    let preco = $('#preco').val();
    let img = $('#img').val();
    $.ajax({
      url: 'http://localhost:3000/createProduto',
      type: 'POST',
      data: {
        nome: nome,
        descricao: descricao,
        preco: preco,
        img: img
      },
      success: function(response) {
        window.location.href = "http://localhost:3000/admin"
      },
    })
  })
  $('#button-salvar-usuario').click(function(e) {
    e.preventDefault();
    let nome = $('#nome').val();
    let email = $('#email').val();
    let senha = $('#senha').val();
    $.ajax({
      url: 'http://localhost:3000/createUsuario',
      type: 'POST',
      data: {
        nome: nome,
        email: email,
        senha: senha
      },
      success: function(response) {
        window.location.href = "http://localhost:3000/admin"
      },
    })
  })
  $(function() {
    /* Modais */
    $(".btnExcluir")
      .click(function() {
        $("#modalConfirmacaoExclusao")
          .modal('show');
      });
    $(".btnExcluirUsuario")
      .click(function() {
        $("#modalConfirmacaoExclusaoUsuario")
          .modal('show');
      });

    $(".btnCadastro")
      .click(function() {
        $("#modalCadastro")
          .modal('show');
      });
    $(".btnEditar")
      .click(function() {
        $("#modalEditar")
          .modal('show');
      });
    $(".btnCadastroUsuario")
      .click(function() {
        $("#modalCadastroUsuario")
          .modal('show');
      });

    $('#dropdownCategorias')
      .dropdown({
        allowAdditions: true
      });

    $('#dropdownMarcas')
      .dropdown({
        allowAdditions: true
      });

    $('#dropdownMedida')
      .dropdown();
  });
</script>

<style>
  body {
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }

  header {
    display: flex;
    justify-content: center;
    align-items: center;
    height: auto;
    width: 100%;
    background-color: #fff;
    padding: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, .2);
  }

  nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1550px;
    width: 100%;
    height: 100%;
    padding: 0.5em 2em;
  }

  main {
    width: 100%;
    height: auto;
    min-height: 900px
  }

  .container {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    max-width: 1550px;
  }

  #btn-entrar {
    background-color: #1c1c1e;
    color: #ffffff;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 16px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    position: relative;
    right: 50px;
  }

  .section-product {
    display: inline-block;
    font-family: "robotobold", sans-serif;
    margin-right: 30px;
    margin-bottom: 25px;
    position: relative;
    left: 160px;
    top: 50px;
  }

  .delete-yes {
    background-color: #1c1c1e;
    color: #ffffff;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 16px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    position: relative;
    right: 50px;
  }

  .delete-yes-usuario {
    background-color: #1c1c1e;
    color: #ffffff;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 16px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    position: relative;
    right: 50px;
  }

  .general {
    display: flex;
  }

  .dropdown {
    position: relative;
    display: inline-block;
    top: -2px;
    right: 20px;
  }

  .dropdown span {
    font-size: 15px;
    font-weight: 100;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 100px;
    min-height: 15px;
    box-shadow: 0px 3px 8px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;

  }

  .dropdown-content button {
    color: black;
    padding-left: 20px;
    padding-top: 5px;
    text-decoration: none;
    display: block;
    border: none;
    background-color: #f9f9f9;
    cursor: pointer;
  }

  .dropdown:hover .dropdown-content {
    display: block;
  }

  .hidden {
    display: none;
  }

  *::before,
  *::after {
    margin: 0;
    padding: 0;
  }

  html {
    font-size: 10px;
    font-family: Verdana;
  }

  a {
    display: block;
    text-decoration: none;
  }

  .nav-list-mobile {
    display: none;
  }

  .nav-link {
    font-size: 1.4rem;
    color: black;
    padding: 0 1rem;
    transition: opacity 0.2s;
  }

  .nav-link-bag {
    position: relative;
    top: 2px;
    right: 20px;
  }

  .nav-link:hover {
    opacity: 0.5;
  }

  .nav-bar {
    display: flex;
    width: 100%;
    height: 100%;
    align-items: center;
    justify-content: space-between;
    min-width: 832px;
  }

  .nav-item-left {
    width: 25%;
    height: 100%;
    /*     background-color: aqua; */
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 5px
  }

  .nav-item-left a {
    font-size: 1.8em;
    font-weight: 400;
  }

  .nav-item-left a img {
    width: auto;
    height: 80px;
    object-fit: cover;
  }

  .nav-item-center {
    width: 50%;
    overflow: hidden;
  }

  li {
    margin-bottom: 12px;
  }

  /*////////////////////////////// medias query */

  @media screen and (max-width: 1000px) {
    .nav-bar #usuarios-id {
      display: none;
    }
  }

  @media screen and (min-width: 380px) and (max-width: 768px) {
    .search-container {
      left: -35px;
    }
  }
</style>