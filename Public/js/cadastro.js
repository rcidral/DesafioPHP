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

$('#btn-salvar-usuario').click(function (e) {
    e.preventDefault();
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
            url: 'http://localhost:3000/createUsuario',
            type: 'POST',
            data: {
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

$('#btn-salvar-produto').click(function (e) {
    e.preventDefault();
    let nome = $('#nome').val();
    let descricao = $('#descricao').val();
    let preco = $('#preco').val();
    let img = $('#img').val();

    if(nome == "" || descricao == "" || preco == "" || img == ""){
        document.getElementsByClassName("nothing")[0].style.display = "flex";
    } else {

    const fileInput = document.querySelector('#img');
    const reader = new FileReader();
    reader.readAsDataURL(fileInput.files[0]);
    reader.onload = function () {
        img = reader.result.split(',')[1];

        $.ajax({
            url: 'http://localhost:3000/createProduto',
            type: 'POST',
            data: {
                nome: nome,
                descricao: descricao,
                preco: preco,
                img
            },
            success: function (response) {
                window.location.href = "http://localhost:3000/admin"
            },
        })
    };
    }
});
