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
    console.log(idUsuario);
    console.log(idProduto);
    console.log(qtd);
    e.preventDefault();
    $.ajax({
      url: 'http://localhost:3000/adicionarCarrinho',
      type: 'POST',
      dataType: 'json',
      data: {
        id_usuario: idUsuario,
        id_produto: idProduto,
        quantidade: qtd
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
          window.location.href = 'http://localhost:3000/produto';
        }
      }
    });
  });
  function produtoRed(id) {
    console.log(id);
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
