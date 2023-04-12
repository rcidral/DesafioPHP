$("document").ready(function () {
    $("#img-logo").click(function () {
        window.location.href = "http://localhost:3000/";
    });
    
    $("#drop").click(function() {
        document.querySelector(".dropdown").style.display = "flex";
    });

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

    $("#back-admin").click(function (e) {
        e.preventDefault();
        window.location.href = "http://localhost:3000/admin";
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
    
        let formData = new FormData();
        let img = $('#img')[0].files[0];
        let img1 = $('#img1')[0].files[0];
        let img2 = $('#img2')[0].files[0];
        let img3 = $('#img3')[0].files[0];
        let nome = $("#nome").val();
        let descricao = $("#descricao").val();
        let preco = $("#preco").val();
        formData.append('img', img);
        formData.append('img1', img1);
        formData.append('img2', img2);
        formData.append('img3', img3);
        formData.append('nome', nome);
        formData.append('descricao', descricao);
        formData.append('preco', preco);
        console.log(formData);
        
        $.ajax({
        url: "http://localhost:3000/cadastroProduto",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function () {
            window.location.href = "http://localhost:3000/admin";
        },
    });
});

                    
    $("#editar-produto-btn").click(async function (e) {
        e.preventDefault();
    
        let formData = new FormData();
        let id = $("#id").val();
        let img = $('#img')[0].files[0];
        let img1 = $('#img1')[0].files[0];
        let img2 = $('#img2')[0].files[0];
        let img3 = $('#img3')[0].files[0];
        let nome = $("#nome").val();
        let descricao = $("#descricao").val();
        let preco = $("#preco").val();
        formData.append('id', id);
        formData.append('img', img);
        formData.append('img1', img1);
        formData.append('img2', img2);
        formData.append('img3', img3);
        formData.append('nome', nome);
        formData.append('descricao', descricao);
        formData.append('preco', preco);
        console.log(formData);
        
        $.ajax({
            url: "http://localhost:3000/editarProduto",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
                window.location.href = "http://localhost:3000/admin";
            },
        });
    });

    $("#cadastro-recommended-produto-btn").click(function (e) {
        e.preventDefault();
        window.location.href = "http://localhost:3000/cadastroRecommendedProdutoView";
    });

    $("#salvar-produto-recomendado-btn").click(function (e) {
        if($("#nome").val() == "" || $("#sequencia").val() == "" || 
            $("#img").val() == "") {
                document.getElementsByClassName("campos")[0].style.display = "flex";
                return;
        }

        let formData = new FormData();
        let img = $('#img')[0].files[0];
        let nome = $("#nome").val();
        let sequencia = $("#sequencia").val();
        formData.append('img', img);
        formData.append('nome', nome);
        formData.append('sequencia', sequencia);

        $.ajax({
            url: "http://localhost:3000/cadastroRecommendedProduto",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
                window.location.href = "http://localhost:3000/admin";
            },
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
            dataType: 'json',
            data: {
                textoPesquisa: $("#search").val(),
            },
            success: function (data) {
                console.log(data, data.success);
                if (data.success) {
                    window.location.href = 'http://localhost:3000/';
                  } else {
                    document.getElementsByClassName("product-incorret")[0].style.display = "flex";
                    document.getElementsByClassName("container-main")[0].style.display = "none";
                  }
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

    $("#export-user").click(function (e) {
        $.ajax({
            url: "http://localhost:3000/exportarUsuariosCSV",
            type: "POST",
        });
        $.ajax({
            url: '/usuarios.csv',
            method: 'GET',
            xhrFields: {
                responseType: 'blob'
            },
            success: function(data) {
                var downloadUrl = URL.createObjectURL(data);
                var a = document.createElement('a');
                a.href = downloadUrl;
                a.download = 'usuarios.csv';
                document.body.appendChild(a);
                a.click();
                setTimeout(function() {
                    document.body.removeChild(a);
                    URL.revokeObjectURL(downloadUrl);
                }, 100);
                window.location.href = "http://localhost:3000/admin";
            }
        });
    });

    $("#export-produto").click(function (e) {
        $.ajax({
            url: "http://localhost:3000/exportarProdutosCSV",
            type: "POST",
        });
        $.ajax({
            url: '/produtos.csv',
            method: 'GET',
            xhrFields: {
                responseType: 'blob'
            },
            success: function(data) {
                var downloadUrl = URL.createObjectURL(data);
                var a = document.createElement('a');
                a.href = downloadUrl;
                a.download = 'produtos.csv';
                document.body.appendChild(a);
                a.click();
                setTimeout(function() {
                    document.body.removeChild(a);
                    URL.revokeObjectURL(downloadUrl);
                }, 100);
                window.location.href = "http://localhost:3000/admin";
            }
        });
    });  

    $("#export-favorites").click(function (e) {
        $.ajax({
            url: "http://localhost:3000/exportarFavoritoCSV",
            type: "POST",
        });
        $.ajax({
            url: '/favoritos.csv',
            method: 'GET',
            xhrFields: {
                responseType: 'blob'
            },
            success: function(data) {
                var downloadUrl = URL.createObjectURL(data);
                var a = document.createElement('a');
                a.href = downloadUrl;
                a.download = 'favoritos.csv';
                document.body.appendChild(a);
                a.click();
                setTimeout(function() {
                    document.body.removeChild(a);
                    URL.revokeObjectURL(downloadUrl);
                }, 100);
                window.location.href = "http://localhost:3000/admin";
            }
        });
    });

    $("#template-user").click(function (e) {
        $.ajax({
            url: '/template/template-user.csv',
            method: 'GET',
            xhrFields: {
                responseType: 'blob'
            },
            success: function(data) {
                var downloadUrl = URL.createObjectURL(data);
                var a = document.createElement('a');
                a.href = downloadUrl;
                a.download = 'template-user.csv';
                document.body.appendChild(a);
                a.click();
                setTimeout(function() {
                    document.body.removeChild(a);
                    URL.revokeObjectURL(downloadUrl);
                }, 100);
                window.location.href = "http://localhost:3000/admin";
            }
        });
    });

    $("#template-produto").click(function (e) {
        $.ajax({
            url: '/template/template-produto.csv',
            method: 'GET',
            xhrFields: {
                responseType: 'blob'
            },
            success: function(data) {
                var downloadUrl = URL.createObjectURL(data);
                var a = document.createElement('a');
                a.href = downloadUrl;
                a.download = 'template-produto.csv';
                document.body.appendChild(a);
                a.click();
                setTimeout(function() {
                    document.body.removeChild(a);
                    URL.revokeObjectURL(downloadUrl);
                }, 100);
                window.location.href = "http://localhost:3000/admin";
            }
        });
    });

    $("#btn-import-user").click(function (e) {
        e.preventDefault();
        var file = $("#csv-user")[0].files[0];
        var formData = new FormData();
        formData.append("csv-user", file);
        $.ajax({
            url: "http://localhost:3000/importarUsuariosCSV",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function () {
                window.location.href = "http://localhost:3000/admin";
            }
        });
    });

    $("#btn-import-produto").click(function (e) {
        e.preventDefault();
        var file = $("#csv-produto")[0].files[0];
        var formData = new FormData();
        formData.append("csv-produto", file);
        $.ajax({
            url: "http://localhost:3000/importarProdutosCSV",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function () {
                window.location.href = "http://localhost:3000/admin";
            }
        });
    });

    $("#editar-produto-recomendado-btn").click(function (e) {
        e.preventDefault();
        let id = $("#id").val();
        let nome = $("#nome").val();
        let sequencia = $("#sequencia").val();
        let img = $("#img")[0].files[0];

        let formData = new FormData();
        formData.append("id", id);
        formData.append("nome", nome);
        formData.append("sequencia", sequencia);
        formData.append("img", img);

        $.ajax({
            url: "http://localhost:3000/editarProdutoRecomendado",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function () {
                window.location.href = "http://localhost:3000/admin";
            }
        });
    });
});
        
    

    
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
    });
}

function openCart() {
    document.getElementById("openCart").classList.remove("closeCart")
    document.getElementById("openCart").classList.add("showCart")
}
function closeCart() {
    document.getElementById("openCart").classList.remove("showCart")
    document.getElementById("openCart").classList.add("closeCart")
}

function openFav() {
    document.getElementById("openFav").classList.remove("closeFav")
    document.getElementById("openFav").classList.add("showFav")
}

function closeFav() {
    document.getElementById("openFav").classList.remove("showFav")
    document.getElementById("openFav").classList.add("closeFav")
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


function showModalUsuario(id) {
    document.getElementsByClassName("modal-delete-usuario")[0].style.display = "flex";
    $("#btn-sim-usuario").attr("onclick", `deleteUsuario(${id})`);
}

function closeModalUsuario() {
    document.getElementsByClassName("modal-delete-usuario")[0].style.display = "none";
}

function showModalExportUsuario() {
    document.getElementsByClassName("modal-export-usuario")[0].style.display = "flex";
}

function closeModalExportUsuario() {
    document.getElementsByClassName("modal-export-usuario")[0].style.display = "none";
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



function showModalProduto(id) {
    document.getElementsByClassName("modal-delete-produto")[0].style.display = "flex";
    $("#btn-sim-produto").attr("onclick", `deleteProduto(${id})`);
}

function closeModalProduto() {
    document.getElementsByClassName("modal-delete-produto")[0].style.display = "none";
}

function showModalExportProduto() {
    document.getElementsByClassName("modal-export-produto")[0].style.display = "flex";
}

function closeModalExportProduto() {
    document.getElementsByClassName("modal-export-produto")[0].style.display = "none";
}

function showModalRecomendado(id) {
    document.getElementsByClassName("modal-delete-recomendado")[0].style.display = "flex";
    $("#btn-sim-recomendado").attr("onclick", `deleteRecomendadoProduto(${id})`);
}

function closeModalRecomendado() {
    document.getElementsByClassName("modal-delete-recomendado")[0].style.display = "none";
}

function deleteRecomendadoProduto(id) {
    $.ajax({
        url: "http://localhost:3000/deleteRecomendadoProduto",
        type: "POST",
        data: {
            id: id,
        },
        success: function () {
            window.location.href = "http://localhost:3000/admin";
        }
    });
}

function editarProdutoRecomendado(id) {
    $.ajax({
        url: "http://localhost:3000/editarProdutoRecomendadoRed",
        type: "POST",
        data: {
            id: id,
        },
        success: function () {
            window.location.href = "http://localhost:3000/editarProdutoRecomendadoView";
        }
    });
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

// Favoritos script

function adicionarFavorito(id_produto, id_usuario) {
    $.ajax({
        url: "http://localhost:3000/adicionarFavorito",
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

function removerItemFavorito(id_produto, id_usuario) {
    $.ajax({
        url: "http://localhost:3000/removerItemFavorito",
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

function removerFavorito(id_usuario) {
    $.ajax({
        url: "http://localhost:3000/removerFavorito",
        type: "POST",
        data: {
            id_usuario: id_usuario,
        },
        success: function () {
            window.location.href = "http://localhost:3000/";
        }
    });
}
