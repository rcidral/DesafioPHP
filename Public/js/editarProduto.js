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
    let descricao = $('#descricao').val();
    let preco = $('#preco').val();
    let img = $('#img').val();

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
});