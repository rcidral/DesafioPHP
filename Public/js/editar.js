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

$('#btn-editar-produto').click(function (e) {
    e.preventDefault();
    let id = $('#id').val();
    let nome = $('#nome').val();
    let descricao = $('#descricao').val();
    let preco = $('#preco').val();
    let img = $('#img').val();

    if(nome == "" || descricao == "" || preco == "" || img == ""){
        document.getElementsByClassName("nothing")[0].style.display = "flex";
    } else {

    $.ajax({
        url: 'http://localhost:3000/updateProduto',
        type: 'POST',
        data: {
            id: id,
            nome: nome,
            descricao: descricao,
            preco: preco,
            img: img
        },
        success: function (response) {
            window.location.href = "http://localhost:3000/admin"
        },
    })
    }
});


$('#btn-editar-usuario').click(function (e) {
    e.preventDefault();
    let id = $('#id').val();
    let nome = $('#nome').val();
    let nascimento = $('#nascimento').val();
    let telefone = $('#tel').val();
    let email = $('#email').val();
    let c_email = $('#c_email').val();
    let senha = $('#senha').val();
    let c_senha = $('#c_senha').val();
    let foto = $('#foto').val();

    if(nome == "" || nascimento == "" || telefone == "" || email == "" || c_email == "" || senha == "" || c_senha == "" || foto == ""){
        document.getElementsByClassName("nothing")[0].style.display = "flex";
    } else {
        $.ajax({
            url: 'http://localhost:3000/updateUsuario',
            type: 'POST',
            data: {
                id: id,
                nome: nome,
                nascimento: nascimento,
                telefone: telefone,
                email: email,
                senha: senha,
                foto: foto
            },
            success: function (response) {
                window.location.href = "http://localhost:3000/admin"
            },
        })
    }
});
