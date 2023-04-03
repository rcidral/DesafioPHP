$(document).ready(function() {
    $('#btn-entrar').click(function() {
      setTimeout(function() {
        window.location.href = 'login';
      }, 250);
    });
  });
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
  $('.buy-div').click(function(e) {
    var idUsuario = $(this).parent().find('input[name="idUsuario"]').val();
    var idProduto = $(this).parent().find('input[name="idProduto"]').val();
    var qtd = $(this).parent().find('input[name="qtd"]').val();
    e.preventDefault();
    $.ajax({
      url: 'http://localhost:3000/adicionarCarrinho',
      type: 'POST',
      dataType: 'json',
      data: {
        id_usuario: idUsuario,
        id_produto: idProduto,
        qtd: qtd
      },
      success: function(data) {
        if (data.success) {
          window.location.href = 'http://localhost:3000/';
        }
      }
    }); 
  });
  
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

  function openCart() {
    document.getElementById("openCart").style.display = "block";
  }

  function closeCart() {
    document.getElementById("openCart").style.display = "none";
  }

  $('#limpar').click(function(e) {
    e.preventDefault();
    $.ajax({
      url: 'http://localhost:3000/limparCarrinho',
      type: 'POST',
      dataType: 'json',
      success: function(data) {
        if (data.success) {
          window.location.href = 'http://localhost:3000/';
        }
      }
    });
  });

  function removerDoCarrinhoItem($idProduto, $idUsuario) {
    console.log($idProduto);
    console.log($idUsuario);
    $.ajax({
      url: 'http://localhost:3000/removerItemCarrinho',
      type: 'POST',
      dataType: 'json',
      data: {
        idProdutoRemover: $idProduto,
        idUsuarioRemover: $idUsuario
      },
      success: function(data) {
        if (data.success) {
          window.location.href = 'http://localhost:3000/';
        }
      }
    });
  }
  function produtoRed(id) {
    $.ajax({
      url: 'http://localhost:3000/produtoRed',
      type: 'POST',
      dataType: 'json',
      data: {
        idProdutoSolo: id
      },
      success: function(data) {
        if (data.success) {
          window.location.href = 'http://localhost:3000/produto';
        }
      }
    });
  }
  $("#pesquisar").click(function(e) {
    e.preventDefault();
    var pesquisa = $(this).parent().find('input[name="pesquisa"]').val();
    $.ajax({
      url: 'http://localhost:3000/pesquisar',
      type: 'POST',
      dataType: 'json',
      data: {
        pesquisar: pesquisa
      },
      success: function(data) {
        if (data.success) {
          window.location.href = 'http://localhost:3000/';
        } else {
          document.getElementsByClassName("product-incorret")[0].style.display = "flex";
          document.getElementsByClassName("section-div")[0].style.display = "none";
        }
      }
    });
  });
  
  function degreeInput(id) {
    var input = document.getElementById("qtd-" + id + "");
    if (input.value > 1) {
      input.value--;
    }
  }

  function plusInput(id) {
    var input = document.getElementById("qtd-" + id + "");
    input.value++;
  }

function buyCart($id) {
  $.ajax({
    url: 'http://localhost:3000/finalizarCompra',
    type: 'POST',
    dataType: 'json',
    data: {
      idUsuarioFinal: $id
    },
    success: function(data) {
      if (data.success) {
        window.location.href = 'http://localhost:3000/compraFinalizada';
      }
    }
  });
}
