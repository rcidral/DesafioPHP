$(document).ready(function () {
  $('#btn-entrar').click(function () {
    setTimeout(function () {
      window.location.href = 'login';
    }, 250);
  });
});
$('#sair').click(function (e) {
  e.preventDefault();
  $.ajax({
    url: 'http://localhost:3000/logout',
    type: 'POST',
    dataType: 'json',
    success: function (data) {
      if (data.success) {
        window.location.href = 'http://localhost:3000/';
      }
    }
  });
});
$('.buy-div-home').click(function (e) {
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
          window.location.href = 'http://localhost:3000/produto';
        }
      }
    }); 
  });

  function openCart() {
    document.getElementById("openCart").classList.remove("closeCart")
    document.getElementById("openCart").classList.add("showCart")
  }

  function closeCart() {
    document.getElementById("openCart").classList.remove("showCart")
    document.getElementById("openCart").classList.add("closeCart")
  }

$('#limpar').click(function (e) {
  e.preventDefault();
  $.ajax({
    url: 'http://localhost:3000/limparCarrinho',
    type: 'POST',
    dataType: 'json',
    success: function (data) {
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
    success: function (data) {
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


let img_list = document.querySelectorAll(".carousel-home > .img > img");

for (i = 0; i < img_list.length; i++) {
  let a = document.createElement("a");
  a.setAttribute("class", "dot");
  a.setAttribute("href", "#img" + i);
  img_list[i].id = "img" + i;
  document.querySelector(".carousel-home > .span-cont").appendChild(a);
}

let spans = document.querySelectorAll(".span-cont > a");
spans[0].style.backgroundColor = "#5397b4";
for (i = 0; i < spans.length; i++) {
  spans[i].onclick = function () {
    for (y = 0; y < spans.length; y++) {
      spans[y].style.backgroundColor = "rgb(34 34 34)";
    }
    this.style.backgroundColor = "#5397b4";
  };
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
        window.location.href = 'http://localhost:3000/produto';
      }
    }
  });
}

function degreeInputCart(id) {
  var input = document.getElementById("qtdCart-" + id + "");
  if (input.value > 1) {
    input.value--;
  }

  var value = input.value;
  var idProduto = id;

  $.ajax({
    url: 'http://localhost:3000/degreeCarrinho',
    type: 'POST',
    dataType: 'json',
    data: {
      idProdutoDegree: idProduto,
      value: value
    },
  });
}

function plusInputCart(id) {
  var input = document.getElementById("qtdCart-" + id + "");
  input.value++;

  var value = input.value;
  var idProduto = id;
  $.ajax({
    url: 'http://localhost:3000/plusCarrinho',
    type: 'POST',
    dataType: 'json',
    data: {
      idProdutoPlus: idProduto,
      value: value
    },
  });
}
