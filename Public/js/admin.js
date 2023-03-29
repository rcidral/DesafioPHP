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