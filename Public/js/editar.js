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

$('#btn-editar-produto').click(async function (e) {
    e.preventDefault();
    let id = $('#id').val();
    let nome = $('#nome').val();
    let descricao = $('#descricao').val();
    let preco = $('#preco').val();
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
            url: 'http://localhost:3000/updateProduto',
            type: 'POST',
            data: {
                idProdutoEditFinal: id,
                nome: nome,
                descricao: descricao,
                preco: preco,
                img,
                img1,
                img2,
                img3
            },
            success: function (response) {
                window.location.href = "http://localhost:3000/admin"
            },
        })
    }
);



function setSelectionRange(input, selectionStart, selectionEnd) {
    if (input.setSelectionRange) {
        input.focus();
        input.setSelectionRange(selectionStart, selectionEnd);
    }
    else if (input.createTextRange) {
        var range = input.createTextRange();
        range.collapse(true);
        range.moveEnd('character', selectionEnd);
        range.moveStart('character', selectionStart);
        range.select();
    }
}


$('#btn-editar-usuario').click(async function (e) {
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

    const fileInput = document.querySelector('#foto');
    const reader = new FileReader();
    if(fileInput.files[0] instanceof Blob){
        reader.readAsDataURL(fileInput.files[0]);
        await (
            new Promise(
                (resolve, reject) => {
                    reader.onload = function () {
                        foto = reader.result.split(',')[1];
                        resolve();
                    }
                }
            ));
    }
    $.ajax({
        url: 'http://localhost:3000/updateUsuario',
        type: 'POST',
        data: {
            idUsuarioEditFinal: id,
            nome: nome,
            nascimento: nascimento,
            telefone: telefone,
            email: email,
            c_email: c_email,
            senha: senha,
            c_senha: c_senha,
            foto: foto
        },
        success: function (response) {
            window.location.href = "http://localhost:3000/admin"
        },
    })
});
