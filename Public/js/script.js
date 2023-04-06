// Functions

function addMax(id) {
    var input = document.getElementById("quantidade-" + id + "");
    input.value++;
}

function addMin(id) {
    var input = document.getElementById("quantidade-" + id + "");
    if (input.value > 1) {
      input.value--;
    }
}
function addMinCart(id) {
    var input = document.getElementById("quantidade-cart-" + id + "");
    if (input.value > 1) {
        input.value--;
    }

    var value = input.value;
    var idProduto = id;

    $.ajax({
        url: "http://localhost:3000/alterarCarrinhoMin",
        type: "POST",
        data: {
            id_produto: idProduto,
            quantidade: value,
        },
        success: function () {
            window.location.href = "http://localhost:3000/";
        }
    });
}

function addMaxCart(id) {
    var input = document.getElementById("quantidade-cart-" + id + "");
    input.value++;

    var value = input.value;
    var idProduto = id;

    $.ajax({
        url: "http://localhost:3000/alterarCarrinhoMax",
        type: "POST",
        data: {
            id_produto: idProduto,
            quantidade: value,
        },
        success: function () {
            window.location.href = "http://localhost:3000/";
        }
    });
}

$("#img-logo").click(function () {
    window.location.href = "http://localhost:3000/";
});

$("#drop").click(function() {
    document.querySelector(".dropdown").style.display = "flex";
});
function openCart() {
    document.getElementById("openCart").classList.remove("closeCart")
    document.getElementById("openCart").classList.add("showCart")
}
function closeCart() {
    document.getElementById("openCart").classList.remove("showCart")
    document.getElementById("openCart").classList.add("closeCart")
}
function openProduct(id) {
    $.ajax({
        url: "http://localhost:3000/produtoRed",
        type: "POST",
        data: {
            id: id,
        },
        success: function () {
            window.location.href = "http://localhost:3000/produtoView";
        }
    });
}

// Redirect JQuery

$("#btn-entrar").click(function (e) {
    e.preventDefault();
    window.location.href = "http://localhost:3000/login";
    }
);

// Authenticate JQuery
$("#btn-login").click(function (e) {
    e.preventDefault();
    $.ajax({
        url: "http://localhost:3000/auth",
        type: "POST",
        data: {
            email: $("#email").val(),
            senha: $("#senha").val(),
        },
        success: function () {
            if($("#email").val() == "admin@admin.com" && $("#senha").val() == "admin") {
                window.location.href = "http://localhost:3000/admin";
            } else {
                window.location.href = "http://localhost:3000/";
            }
        },
        error: function (e) {
            console.log(e);
            document.getElementsByClassName("wrong")[0].style.display = "flex";
        }
    });
});

// Logout JQuery

$("#sair").click(function (e) {
    e.preventDefault();
    $.ajax({
        url: "http://localhost:3000/logout",
        type: "POST",
        success: function () {
            window.location.href = "http://localhost:3000/";
        }
    });
});

// Jquery User

$("#cadastro-usuario-btn").click(function (e) {
    e.preventDefault();
    window.location.href = "http://localhost:3000/cadastroUsuarioView";
});

$("#salvar-usuario-btn").click(function (e) {
    if($("#nome").val() == "" || $("#dataNascimento").val() == "" || 
        $("#telefone").val() == "" || $("#email").val() == "" || 
        $("#senha").val() == "" || $("#confirmarSenha").val() == "" || 
        $("#foto").val() == "") {
            document.getElementsByClassName("confirmar")[0].style.display = "none";
            document.getElementsByClassName("campos")[0].style.display = "flex";
            return;
    }
    if($("#senha").val() != $("#confirmarSenha").val()) {
        document.getElementsByClassName("campos")[0].style.display = "none";
        document.getElementsByClassName("confirmar")[0].style.display = "flex";
        return;
    }
    e.preventDefault();
    $.ajax({
        url: "http://localhost:3000/cadastroUsuario",
        type: "POST",
        data: {
            nome: $("#nome").val(),
            nascimento: $("#dataNascimento").val(),
            telefone: $("#telefone").val(),
            email: $("#email").val(),
            senha: $("#senha").val(),
            confirmarSenha: $("#confirmarSenha").val(),
            foto: $("#foto").val(),
        },
        success: function () {
            window.location.href = "http://localhost:3000/admin";
        },
    });
});

function showModalUsuario(id) {
    document.getElementsByClassName("modal-delete-usuario")[0].style.display = "flex";
    $("#btn-sim-usuario").attr("onclick", `deleteUsuario(${id})`);
}

function closeModalUsuario() {
    document.getElementsByClassName("modal-delete-usuario")[0].style.display = "none";
}

function deleteUsuario(id) {
    $.ajax({
        url: "http://localhost:3000/deleteUsuario",
        type: "POST",
        data: {
            id: id,
        },
        success: function () {
            window.location.href = "http://localhost:3000/admin";
        }
    });
}

function editarUsuario(id) {
    $.ajax({
        url: "http://localhost:3000/editarUsuarioRed",
        type: "POST",
        data: {
            id: id,
        },
        success: function () {
            window.location.href = "http://localhost:3000/editarUsuarioView";
        }
    });
}

$("#editar-usuario-btn").click(function (e) {
    if($("#senha").val() != $("#confirmarSenha").val()) {
        document.getElementsByClassName("confirmar")[0].style.display = "flex";
        return;
    }
    e.preventDefault();
    $.ajax({
        url: "http://localhost:3000/editarUsuario",
        type: "POST",
        data: {
            id: $("#id").val(),
            nome: $("#nome").val(),
            nascimento: $("#dataNascimento").val(),
            telefone: $("#telefone").val(),
            email: $("#email").val(),
            senha: $("#senha").val(),
            confirmarSenha: $("#confirmarSenha").val(),
            foto: $("#foto").val(),
        },
        success: function () {
            window.location.href = "http://localhost:3000/admin";
        },
    });
});


// Jquery Product

$("#cadastro-produto-btn").click(function (e) {
    e.preventDefault();
    window.location.href = "http://localhost:3000/cadastroProdutoView";
});

$("#salvar-produto-btn").click(function (e) {
    if($("#nome").val() == "" || $("#descricao").val() == "" || 
        $("#preco").val() == "" || $("#img").val() == "" || 
        $("#img1").val() == "" || $("#img2").val() == "" ||
        $("#img3").val() == "" ) {
            document.getElementsByClassName("campos")[0].style.display = "flex";
            return;
    }

    let img = $('#img').val();
    let img1 = $('#img1').val();
    let img2 = $('#img2').val();
    let img3 = $('#img3').val();

    const fileInput = document.querySelector('#img');
    const reader = new FileReader();
    reader.readAsDataURL(fileInput.files[0]);
    reader.onload = function () {
        img = reader.result.split(',')[1];

        const fileInput1 = document.querySelector('#img1');
        const reader1 = new FileReader();
        reader1.readAsDataURL(fileInput1.files[0]);
        reader1.onload = function () {
            img1 = reader1.result.split(',')[1];

            const fileInput2 = document.querySelector('#img2');
            const reader2 = new FileReader();
            reader2.readAsDataURL(fileInput2.files[0]);
            reader2.onload = function () {
                img2 = reader2.result.split(',')[1];

                const fileInput3 = document.querySelector('#img3');
                const reader3 = new FileReader();
                reader3.readAsDataURL(fileInput3.files[0]);
                reader3.onload = function () {
                    img3 = reader3.result.split(',')[1];

                        e.preventDefault();
                        $.ajax({
                        url: "http://localhost:3000/cadastroProduto",
                        type: "POST",
                        data: {
                            nome: $("#nome").val(),
                            descricao: $("#descricao").val(),
                            preco: $("#preco").val(),
                            img,
                            img1,
                            img2,
                            img3,
                        },
                        success: function () {
                            window.location.href = "http://localhost:3000/admin";
                        }
                    });
                }
            }
        }
    }
});

function showModalProduto(id) {
    document.getElementsByClassName("modal-delete-produto")[0].style.display = "flex";
    $("#btn-sim-produto").attr("onclick", `deleteProduto(${id})`);
}

function closeModalProduto() {
    document.getElementsByClassName("modal-delete-produto")[0].style.display = "none";
}

function deleteProduto(id) {
    $.ajax({
        url: "http://localhost:3000/deleteProduto",
        type: "POST",
        data: {
            id: id,
        },
        success: function () {
            window.location.href = "http://localhost:3000/admin";
        }
    });
}

function editarProduto(id) {
    $.ajax({
        url: "http://localhost:3000/editarProdutoRed",
        type: "POST",
        data: {
            id: id,
        },
        success: function () {
            window.location.href = "http://localhost:3000/editarProdutoView";
        }
    });
}

$("#editar-produto-btn").click(async function (e) {
    e.preventDefault();

    let img = $('#img').val();
    let img1 = $('#img1').val();
    let img2 = $('#img2').val();
    let img3 = $('#img3').val();

    const fileInput = document.querySelector('#img');
    const reader = new FileReader();
    if(fileInput.files[0] instanceof Blob){
        reader.readAsDataURL(fileInput.files[0]);
        await (
            new Promise(
              (resolve, reject) => {
                reader.onload = function () {
                  img = reader.result.split(',')[1];
                  resolve();
                }
              }
            ));
        }
    const fileInput1 = document.querySelector('#img1');
    const reader1 = new FileReader();
    if(fileInput1.files[0] instanceof Blob){
        reader1.readAsDataURL(fileInput1.files[0]);
        await (
            new Promise(
                (resolve, reject) => {
                    reader1.onload = function () {
                        img1 = reader1.result.split(',')[1];
                        resolve();
                    }
                }
            ));
    }
    const fileInput2 = document.querySelector('#img2');
    const reader2 = new FileReader();
    if(fileInput2.files[0] instanceof Blob){
        reader2.readAsDataURL(fileInput2.files[0]);
        await (
            new Promise(
                (resolve, reject) => {
                    reader2.onload = function () {
                        img2 = reader2.result.split(',')[1];
                        resolve();
                    }
                }
            ));
    }
    const fileInput3 = document.querySelector('#img3');
    const reader3 = new FileReader();
    if(fileInput3.files[0] instanceof Blob){
        reader3.readAsDataURL(fileInput3.files[0]);
        await (
            new Promise(
                (resolve, reject) => {
                    reader3.onload = function () {
                        img3 = reader3.result.split(',')[1];
                        resolve();
                    }
                }
            ));
    }
    $.ajax({
        url: "http://localhost:3000/editarProduto",
        type: "POST",
        data: {
            id: $("#id").val(),
            nome: $("#nome").val(),
            descricao: $("#descricao").val(),
            preco: $("#preco").val(),
            img,
            img1,
            img2,
            img3,
        },
        success: function () {
            window.location.href = "http://localhost:3000/admin";
        }
    });
});

$("#search").keyup(function(event) {
    if (event.keyCode === 13) {
      $("#search-btn").click();
    }
  });
                
$("#search-btn").click(function (e) {
    console.log($("#search").val());
    e.preventDefault();
    $.ajax({
        url: "http://localhost:3000/pesquisar",
        type: "POST",
        data: {
            textoPesquisa: $("#search").val(),
        },
        success: function () {
            window.location.href = "http://localhost:3000/";
        }
    });
});

// Jquery Carrinho
$(".addToCart").click(function (e) {
    e.preventDefault();
    var id_usuario = $(this).parent().find("input[name='id_usuario']").val();
    var id_produto = $(this).parent().find("input[name='id']").val();
    var quantidade = $(this).parent().find("input[name='quantidade']").val();

    $.ajax({
        url: "http://localhost:3000/adicionarCarrinho",
        type: "POST",
        data: {
            id_produto: id_produto,
            id_usuario: id_usuario,
            quantidade: quantidade
        },
        success: function () {
            window.location.href = "http://localhost:3000/";
        }
    });
});


function removeToCart(id_produto, id_usuario) {
    $.ajax({
        url: "http://localhost:3000/removerItemCarrinho",
        type: "POST",
        data: {
            id_produto: id_produto,
            id_usuario: id_usuario,
        },
        success: function () {
            window.location.href = "http://localhost:3000/";
        }
    });
}

function deletarCarrinho(id_usuario) {
    $.ajax({
        url: "http://localhost:3000/deletarCarrinho",
        type: "POST",
        data: {
            id_usuario: id_usuario,
        },
        success: function () {
            window.location.href = "http://localhost:3000/";
        }
    });
}

function buyCart(id_usuario) {
    $.ajax({
        url: "http://localhost:3000/comprarCarrinho",
        type: "POST",
        data: {
            id_usuario: id_usuario,
        },
        success: function () {
            window.location.href = "http://localhost:3000/compraFinalizada";
        }
    });
}


// Table Admin

function change15User() {
    let qtd = 15;
    $.ajax({
      url: 'http://localhost:3000/refreshTableUser',
      type: 'POST',
      data: {
        qtdUser: qtd
      },
      success: function(response) {
        window.location.href = "http://localhost:3000/admin"
      },
    })
  }
  
  function change50User() {
    let qtd = 50;
    $.ajax({
      url: 'http://localhost:3000/refreshTableUser',
      type: 'POST',
      data: {
        qtdUser: qtd
      },
      success: function(response) {
        window.location.href = "http://localhost:3000/admin"
      },
    })
  }
  
  function change100User() {
    let qtd = 100;
    $.ajax({
      url: 'http://localhost:3000/refreshTableUser',
      type: 'POST',
      data: {
        qtdUser: qtd
      },
      success: function(response) {
        window.location.href = "http://localhost:3000/admin"
      },
    })
  }
  
  function change15Product() {
    let qtd = 15;
    $.ajax({
      url: 'http://localhost:3000/refreshTableProduct',
      type: 'POST',
      data: {
        qtdProduct: qtd
      },
      success: function(response) {
        window.location.href = "http://localhost:3000/admin"
      },
    })
  }
  
  function change50Product() {
    let qtd = 50;
    $.ajax({
      url: 'http://localhost:3000/refreshTableProduct',
      type: 'POST',
      data: {
        qtdProduct: qtd
      },
      success: function(response) {
        window.location.href = "http://localhost:3000/admin"
      },
    })
  }
  
  function change100Product() {
    let qtd = 100;
    $.ajax({
      url: 'http://localhost:3000/refreshTableProduct',
      type: 'POST',
      data: {
        qtdProduct: qtd
      },
      success: function(response) {
        window.location.href = "http://localhost:3000/admin"
      },
    })
  }
