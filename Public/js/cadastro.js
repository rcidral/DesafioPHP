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
    } else { if(foto.endsWith(".png") == false){
        document.getElementsByClassName("nothing")[0].style.display = "none";
        document.getElementsByClassName("png")[0].style.display = "flex";
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
}
});

$('#btn-salvar-produto').click(function (e) {
    e.preventDefault();
    let nome = $('#nome').val();
    let descricao = $('#descricao').val();
    let preco = $('#preco').val();
    let img = $('#img').val();
    let img1 = $('#img1').val();
    let img2 = $('#img2').val();
    let img3 = $('#img3').val();
    
    
    if(nome == "" || descricao == "" || preco == "" || img == "" || img1 == "" || img2 == "" || img3 == ""){
        document.getElementsByClassName("nothing")[0].style.display = "flex";
    } else { if((img.endsWith(".png") == false) || (img1.endsWith(".png") == false) || (img2.endsWith(".png") == false) || (img3.endsWith(".png") == false)){
        document.getElementsByClassName("nothing")[0].style.display = "none";
        document.getElementsByClassName("png")[0].style.display = "flex";
    } else {

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

        $.ajax({
            url: 'http://localhost:3000/createProduto',
            type: 'POST',
            data: {
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
    }
    }
    }
    }
}
});
