$('form').submit(function(e) {
    e.preventDefault();
    var email = $('#email').val();
    var password = $('#password').val();
    if(email == 'admin@admin.com' && password == 'admin') {
        window.location.href = 'http://localhost:3000/admin';
    } else {
    $.ajax({
        url: 'http://localhost:3000/auth',
        type: 'POST',
        data: {
            email: email,
            password: password
        },
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                window.location.href = 'http://localhost:3000/';
            } else {
                alert('Usuário ou senha inválidos');
            }
        }});
      }
});