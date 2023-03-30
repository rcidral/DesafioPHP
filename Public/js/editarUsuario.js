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

$('#btn-editar').click(function (e) {
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

    if (email != c_email) {
        alert("Os emails não coincidem");
    } else if (senha != c_senha) {
        alert("As senhas não coincidem");
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
