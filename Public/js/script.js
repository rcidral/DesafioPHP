$("document").ready(function () {
    $("#img-logo").click(function () {
        if(window.location.href == "http://localhost:3000/admin") {
            window.location.href = "/admin";
            return
        }
        window.location.href = "/";
    });
    
    $("#drop").click(function() {
        document.querySelector(".dropdown").style.display = "flex";
    });

    $("#btn-entrar").click(function (e) {
        e.preventDefault();
        window.location.href = "/login";
        }
    );
    
    // Authenticate JQuery
    $("#btn-login").click(function (e) {
        e.preventDefault();
        $.ajax({
            url: "/auth",
            type: "POST",
            data: {
                email: $("#email").val(),
                senha: $("#senha").val(),
            },
            success: function () {
                if($("#email").val() == "admin@admin.com" && $("#senha").val() == "admin") {
                    window.location.href = "/admin";
                } else {
                    window.location.href = "/";
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
            url: "/logout",
            type: "POST",
            success: function () {
                window.location.href = "/";
            }
        });
    });

    $("#back-admin").click(function (e) {
        e.preventDefault();
        window.location.href = "/admin";
    });
    
    // Jquery User
    
    $("#cadastro-usuario-btn").click(function (e) {
        e.preventDefault();
        window.location.href = "/cadastroUsuarioView";
    });
    
    $("#salvar-usuario-btn").click(function (e) {
        if($("#nome").val() == "" || $("#dataNascimento").val() == "" || 
            $("#telefone").val() == "" || $("#email").val() == "" || 
            $("#senha").val() == "" || $("#confirmarSenha").val() == "" || 
            $("#foto").val() == "") {
                document.getElementsByClassName("confirmar")[0].style.display = "none";
                document.getElementsByClassName("campos")[0].style.display = "flex";
                if($("#nome").val() == "") {
                    document.getElementById("nome").style.border = "1px solid red";
                } else {
                    document.getElementById("nome").style.border = "1px solid #ccc";
                }
                if($("#dataNascimento").val() == "") {
                    document.getElementById("dataNascimento").style.border = "1px solid red";
                } else {
                    document.getElementById("dataNascimento").style.border = "1px solid #ccc";
                }
                if($("#telefone").val() == "") {
                    document.getElementById("telefone").style.border = "1px solid red";
                } else {
                    document.getElementById("telefone").style.border = "1px solid #ccc";
                }
                if($("#email").val() == "") {
                    document.getElementById("email").style.border = "1px solid red";
                } else {
                    document.getElementById("email").style.border = "1px solid #ccc";
                }
                if($("#senha").val() == "") {
                    document.getElementById("senha").style.border = "1px solid red";
                } else {
                    document.getElementById("senha").style.border = "1px solid #ccc";
                }
                if($("#confirmarSenha").val() == "") {
                    document.getElementById("confirmarSenha").style.border = "1px solid red";
                } else {
                    document.getElementById("confirmarSenha").style.border = "1px solid #ccc";
                }
                if($("#foto").val() == "") {
                    document.getElementById("foto").style.border = "1px solid red";
                } else {
                    document.getElementById("foto").style.border = "1px solid #ccc";
                }
                return;
        }
        if($("#senha").val() != $("#confirmarSenha").val()) {
            document.getElementsByClassName("campos")[0].style.display = "none";
            document.getElementsByClassName("confirmar")[0].style.display = "flex";
            return;
        }
        e.preventDefault();
        $.ajax({
            url: "/cadastroUsuario",
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
                window.location.href = "/admin";
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
            url: "/editarUsuario",
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
                window.location.href = "/admin";
            },
        });
    });
    
    
    // Jquery Product
    
    $("#cadastro-produto-btn").click(function (e) {
        e.preventDefault();
        window.location.href = "/cadastroProdutoView";
    });
    
    $("#salvar-produto-btn").click(function (e) {
        if($("#nome").val() == "" || $("#descricao").val() == "" || 
            $("#preco").val() == "" || $("#img").val() == "" || 
            $("#img1").val() == "" || $("#img2").val() == "" ||
            $("#img3").val() == "" ) {
                document.getElementsByClassName("campos")[0].style.display = "flex";
                if($("#nome").val() == "") {
                    document.getElementById("nome").style.border = "1px solid red";
                } else {
                    document.getElementById("nome").style.border = "1px solid #ccc";
                }
                if($("#descricao").val() == "") {
                    document.getElementById("descricao").style.border = "1px solid red";
                } else {
                    document.getElementById("descricao").style.border = "1px solid #ccc";
                }
                if($("#preco").val() == "") {
                    document.getElementById("preco").style.border = "1px solid red";
                } else {
                    document.getElementById("preco").style.border = "1px solid #ccc";
                }
                if($("#img").val() == "") {
                    document.getElementById("img").style.border = "1px solid red";
                } else {
                    document.getElementById("img").style.border = "1px solid #ccc";
                }
                if($("#img1").val() == "") {
                    document.getElementById("img1").style.border = "1px solid red";
                } else {
                    document.getElementById("img1").style.border = "1px solid #ccc";
                }
                if($("#img2").val() == "") {
                    document.getElementById("img2").style.border = "1px solid red";
                } else {
                    document.getElementById("img2").style.border = "1px solid #ccc";
                }
                if($("#img3").val() == "") {
                    document.getElementById("img3").style.border = "1px solid red";
                } else {
                    document.getElementById("img3").style.border = "1px solid #ccc";
                }
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
        url: "/cadastroProduto",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function () {
            window.location.href = "/admin";
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
            url: "/editarProduto",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
                window.location.href = "/admin";
            },
        });
    });

    $("#cadastro-recommended-produto-btn").click(function (e) {
        e.preventDefault();
        window.location.href = "/cadastroRecommendedProdutoView";
    });

    $("#salvar-produto-recomendado-btn").click(function (e) {
        console.log($("#sequencia").val());
        console.log($("#img").val());
        console.log($("#nome").val());
        if($("#nome").val() != "" && $("#sequencia").val() == null && 
        $("#img").val() == "") {
            document.getElementsByClassName("sequencia-div")[0].style.display = "flex";
            return;
        } else if($("#nome").val() != "" && $("#sequencia").val() == null && 
        $("#img").val() != ""){
            document.getElementsByClassName("sequencia-div")[0].style.display = "flex";
            return;
        } else if($("#nome").val() == "" || $("#sequencia").val() == "" || 
            $("#img").val() == "") {
                if($("#sequencia").val() == "") {
                }
                document.getElementsByClassName("campos")[0].style.display = "flex";

                if($("#nome").val() == "") {
                    document.getElementById("nome").style.border = "1px solid red";
                }
                if($("#img").val() == "") {
                    document.getElementById("img").style.border = "1px solid red";
                }
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
            url: "/cadastroRecommendedProduto",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
                window.location.href = "/admin";
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
            url: "/pesquisar",
            type: "POST",
            dataType: 'json',
            data: {
                textoPesquisa: $("#search").val(),
            },
            success: function (data) {
                console.log(data, data.success);
                if (data.success) {
                    window.location.href = '/';
                  } else if(!data.success) {
                      document.getElementsByClassName("container-main")[0].style.display = "none";
                      document.getElementsByClassName("product-incorret")[0].style.display = "flex";
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
            url: "/adicionarCarrinho",
            type: "POST",
            data: {
                id_produto: id_produto,
                id_usuario: id_usuario,
                quantidade: quantidade
            },
            success: function () {
                if (window.location.pathname === "/produtoView") {
                    window.location.href = "/produtoView";
                } else {
                    window.location.href = "/";
                }
            }
        });
    });

    $("#export-user").click(function (e) {
        $.ajax({
            url: "/exportarUsuariosCSV",
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
                $.ajax({
                    url: '/moverUsuarioCSV',
                    type: "POST",
                });
            }
        });
    });

    $("#export-produto").click(function (e) {
        $.ajax({
            url: "/exportarProdutosCSV",
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
                $.ajax({
                    url: '/moverProdutoCSV',
                    type: "POST",
                });
            }
        });
    });  

    $("#export-favorites").click(function (e) {
        $.ajax({
            url: "/exportarFavoritoCSV",
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
                $.ajax({
                    url: '/moverFavoritoCSV',
                    type: "POST",
                });
            }
        });
    });

    $("#export-pedidos").click(function (e) {
        $.ajax({
            url: "/exportarPedidosCSV",
            type: "POST",
        });
        $.ajax({
            url: '/pedidos.csv',
            method: 'GET',
            xhrFields: {
                responseType: 'blob'
            },
            success: function(data) {
                var downloadUrl = URL.createObjectURL(data);
                var a = document.createElement('a');
                a.href = downloadUrl;
                a.download = 'pedidos.csv';
                document.body.appendChild(a);
                a.click();
                setTimeout(function() {
                    document.body.removeChild(a);
                    URL.revokeObjectURL(downloadUrl);
                }, 100);
                $.ajax({
                    url: '/moverPedidoCSV',
                    type: "POST",
                });
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
                window.location.href = "/admin";
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
                window.location.href = "/admin";
            }
        });
    });

    $("#btn-import-user").click(function (e) {
        e.preventDefault();
        var file = $("#csv-user")[0].files[0];
        var formData = new FormData();
        formData.append("csv-user", file);
        $.ajax({
            url: "/importarUsuariosCSV",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function () {
                window.location.href = "/admin";
            }
        });
    });

    $("#btn-import-produto").click(function (e) {
        e.preventDefault();
        var file = $("#csv-produto")[0].files[0];
        var formData = new FormData();
        formData.append("csv-produto", file);
        $.ajax({
            url: "/importarProdutosCSV",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function () {
                window.location.href = "/admin";
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
            url: "/editarProdutoRecomendado",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function () {
                window.location.href = "/admin";
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
function addMinCart(id, preco) {
    var input = document.getElementById("quantidade-cart-" + id + "");
    if (input.value > 1) {
        input.value--;
    }

    var value = input.value;
    var idProduto = id;

    $.ajax({
        url: "/alterarCarrinhoMin",
        type: "POST",
        dataType: 'json',
        data: {
            id_produto: idProduto,
            quantidade: value,
        },
        success: function (data) {
            var inputValorTotal = document.getElementById("valorTotal");
            inputValorTotal.value = "R$ " + data.valorTotal.toFixed(2).replace(".", ",");
        }
    });

}

function addMaxCart(id, preco) {
    var input = document.getElementById("quantidade-cart-" + id + "");
    input.value++;

    var value = input.value;
    var idProduto = id;

    var inputValorTotal = document.getElementById("valorTotal");
    $.ajax({
        url: "/alterarCarrinhoMax",
        type: "POST",
        
        data: {
            id_produto: idProduto,
            quantidade: value,
        },
        success: function (data) {
            inputValorTotal.value = "R$ " + data.valorTotal.toFixed(2).replace(".", ",");
        }

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
        url: "/produtoRed",
        type: "POST",
        data: {
            id: id,
        },
        success: function () {
            window.location.href = "/produtoView";
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
        url: "/deleteUsuario",
        type: "POST",
        data: {
            id: id,
        },
        success: function () {
            window.location.href = "/admin";
        }
    });
}

function editarUsuario(id) {
    $.ajax({
        url: "/editarUsuarioRed",
        type: "POST",
        data: {
            id: id,
        },
        success: function () {
            window.location.href = "/editarUsuarioView";
        }
    });
}

function showModalPedidoProduto(id) {
    $.ajax({
        url: "/pedidoProdutoRed",
        type: "POST",
        data: {
            id: id,
        },
        success: function (data) {
            console.log(data);

            let header = ("<tr><th>Nome</th><th>Quantidade</th><th>Preço</th></tr>");
            let body = "";

            for (const key in data) {
                if (Object.hasOwnProperty.call(data, key)) {
                    body += ("<tr><td>" + data[key]['nome'] + "</td><td>" + data[key]['quantidade'] + "</td><td>" + data[key]['preco'] + "</td></tr>");
                }
            }
            document.getElementById("tableProdutos").innerHTML = header;
            document.getElementById("tableProdutos").innerHTML += body;
            document.getElementsByClassName("modal-produtos-pedido")[0].style.display = "flex";
              
        }
    });

}


function closeModalPedidoProduto() {
    document.getElementsByClassName("modal-produtos-pedido")[0].style.display = "none";
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
        url: "/deleteRecomendadoProduto",
        type: "POST",
        data: {
            id: id,
        },
        success: function () {
            window.location.href = "/admin";
        }
    });
}

function editarProdutoRecomendado(id) {
    $.ajax({
        url: "/editarProdutoRecomendadoRed",
        type: "POST",
        data: {
            id: id,
        },
        success: function () {
            window.location.href = "/editarProdutoRecomendadoView";
        }
    });
}

function deleteProduto(id) {
    $.ajax({
        url: "/deleteProduto",
        type: "POST",
        data: {
            id: id,
        },
        success: function () {
            window.location.href = "/admin";
        }
    });
}

function editarProduto(id) {
    $.ajax({
        url: "/editarProdutoRed",
        type: "POST",
        data: {
            id: id,
        },
        success: function () {
            window.location.href = "/editarProdutoView";
        }
    });
}






function removeToCart(id_produto, id_usuario) {
    $.ajax({
        url: "/removerItemCarrinho",
        type: "POST",
        data: {
            id_produto: id_produto,
            id_usuario: id_usuario,
        },
        success: function () {
            if (window.location.pathname === "/produtoView") {
                window.location.href = "/produtoView";
            } else {
                window.location.href = "/";
            }
        }
    });
}

function deletarCarrinho(id_usuario) {
    $.ajax({
        url: "/deletarCarrinho",
        type: "POST",
        data: {
            id_usuario: id_usuario,
        },
        success: function () {
            if (window.location.pathname === "/produtoView") {
                window.location.href = "/produtoView";
            } else {
                window.location.href = "/";
            }
        }
    });
}

function buyCart(id_usuario) {
    $.ajax({
        url: "/comprarCarrinho",
        type: "POST",
        data: {
            id_usuario: id_usuario,
        },
        success: function () {
            window.location.href = "/compraFinalizada";
        }
    });
}


// Table Admin

function change15User() {
    let qtd = 15;
    $.ajax({
      url: '/refreshTableUser',
      type: 'POST',
      data: {
        qtdUser: qtd
      },
      success: function(response) {
        window.location.href = "/admin"
      },
    })
  }
  
  function change50User() {
    let qtd = 50;
    $.ajax({
      url: '/refreshTableUser',
      type: 'POST',
      data: {
        qtdUser: qtd
      },
      success: function(response) {
        window.location.href = "/admin"
      },
    })
  }
  
  function change100User() {
    let qtd = 100;
    $.ajax({
      url: '/refreshTableUser',
      type: 'POST',
      data: {
        qtdUser: qtd
      },
      success: function(response) {
        window.location.href = "/admin"
      },
    })
  }
  
  function change15Product() {
    let qtd = 15;
    $.ajax({
      url: '/refreshTableProduct',
      type: 'POST',
      data: {
        qtdProduct: qtd
      },
      success: function(response) {
        window.location.href = "/admin"
      },
    })
  }
  
  function change50Product() {
    let qtd = 50;
    $.ajax({
      url: '/refreshTableProduct',
      type: 'POST',
      data: {
        qtdProduct: qtd
      },
      success: function(response) {
        window.location.href = "/admin"
      },
    })
  }
  
  function change100Product() {
    let qtd = 100;
    $.ajax({
      url: '/refreshTableProduct',
      type: 'POST',
      data: {
        qtdProduct: qtd
      },
      success: function(response) {
        window.location.href = "/admin"
      },
    })
  }

  function change15Favorite() {
    let qtd = 15;
    $.ajax({
      url: '/refreshTableFavorite',
      type: 'POST',
      data: {
        qtdFavorite: qtd
      },
      success: function(response) {
        window.location.href = "/admin"
      },
    })
  }

    function change50Favorite() {
    let qtd = 50;
    $.ajax({
        url: '/refreshTableFavorite',
        type: 'POST',
        data: {
            qtdFavorite: qtd
        },
        success: function (response) {
            window.location.href = "/admin"
        },
    })
}

function change100Favorite() {
    let qtd = 100;
    $.ajax({
        url: '/refreshTableFavorite',
        type: 'POST',
        data: {
            qtdFavorite: qtd
        },
        success: function (response) {
            window.location.href = "/admin"
        },
    })
}

function change15Pedido() {
    let qtd = 15;
    $.ajax({
        url: '/refreshTablePedido',
        type: 'POST',
        data: {
            qtdPedido: qtd
        },
        success: function (response) {
            window.location.href = "/admin"
        }
    })
}

function change50Pedido() {
    let qtd = 50;
    $.ajax({
        url: '/refreshTablePedido',
        type: 'POST',
        data: {
            qtdPedido: qtd
        },
        success: function (response) {
            window.location.href = "/admin"
        }
    })
}

function change100Pedido() {
    let qtd = 100;
    $.ajax({
        url: '/refreshTablePedido',
        type: 'POST',
        data: {
            qtdPedido: qtd
        },
        success: function (response) {
            window.location.href = "/admin"
        }
    })
}

// Favoritos script

function adicionarFavorito(id_produto, id_usuario) {
    $.ajax({
        url: "/adicionarFavorito",
        type: "POST",
        data: {
            id_produto: id_produto,
            id_usuario: id_usuario,
        },
        success: function () {
            if (window.location.pathname === "/produtoView") {
                $.ajax({
                    url: "/produtoRed",
                    type: "POST",
                    data: {
                        id: id_produto,
                    },
                    success: function (response) {
                        window.location.href = "/produtoView";
                    }
                });
            } else {
                window.location.href = "/";
            }
        }
    });
}

function removerItemFavorito(id_produto, id_usuario) {
    $.ajax({
        url: "/removerItemFavorito",
        type: "POST",
        data: {
            id_produto: id_produto,
            id_usuario: id_usuario,
        },
        success: function () {
            if (window.location.pathname === "/produtoView") {
                $.ajax({
                    url: "/produtoRed",
                    type: "POST",
                    data: {
                        id: id_produto,
                    },
                    success: function (response) {
                        window.location.href = "/produtoView";
                    }
                });
            } else {
                window.location.href = "/";
            }
        }
    });
}

function removerFavorito(id_usuario) {
    $.ajax({
        url: "/removerFavorito",
        type: "POST",
        data: {
            id_usuario: id_usuario,
        },
        success: function () {
            if (window.location.pathname === "/produtoView") {
                window.location.href = "/produtoView";
            } else {
                window.location.href = "/";
            }
        }
    });
}
