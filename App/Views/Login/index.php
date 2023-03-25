<html>

<body>
  <div class="container">
    <div class="header">
      <img alt="Logo" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a6/Logo_NIKE.svg/1280px-Logo_NIKE.svg.png" class="logo" />
      <h1>your account for <br>everything nike</h1>
    </div>

    <form>
      <div class="form">
        <input id="email" placeholder="Email address" type="email" />
        <input id="password" placeholder="Password" type="password" />
      </div>

      <div class="form_options">
        <button type="submit">Entrar</button>
      </div>
    </form>
  </div>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

<script>
  $('form').submit(function(e) {
    e.preventDefault();
    var email = $('#email').val();
    var password = $('#password').val();
    $.ajax({
        url: 'http://localhost:3000/auth.php',
        type: 'POST',
        data: {
            email: email,
            password: password
        },
        dataType: 'json'
    })
    .done(function(response) {
        if (response.success) {
            // Se a consulta foi bem sucedida, redirecionar o usuário para outra página
            window.location.href = 'index.php';
        } else {
            // Se a consulta falhou, exibir uma mensagem de erro ao usuário
            alert('Usuário ou senha inválidos');
        }
    })
    .fail(function() {
        // Se a requisição AJAX falhou, exibir uma mensagem de erro ao usuário
        alert('Ocorreu um erro ao processar sua solicitação');
    });
});
</script>

<style>
  @import url('https://fonts.googleapis.com/css2?family=League+Gothic&display=swap');

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: sans-serif;
  }

  body {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  button {
    background-color: #000;
    color: #fff;
    padding: 0.8rem 1rem;
    border: none;
    outline: none;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
    border-radius: 0.2rem;
    margin-bottom: 1rem;
    width: 100%;
  }

  .container {
    width: 600px;
    /*   border:2px solid red; */
  }

  .container .header {
    text-align: center;
  }

  .container .header .logo {
    margin-bottom: 1rem;
    width: 240px;
  }

  .container .header h1 {
    font-size: 2.5rem;
    text-transform: uppercase;
    margin-bottom: 2rem;
    font-family: 'League Gothic', sans-serif;
    letter-spacing: 2px;
  }

  .container .form input[type="email"],
  input[type="password"] {
    padding: 0.8rem 1rem;
    display: block;
    border: none;
    outline: none;
    /*   border:1px solid gray; */
    box-shadow: 0 0 1px gray;
    margin: auto;
    margin-bottom: 0.8rem;
    width: 100%;
    color: gray;
  }

  /* .container .form input[type="text"]{
  border:2px solid red;
} */

  .container .form_options {
    color: gray;
    display: flex;
    justify-content: space-between;
  }

  .container .form_options label {
    cursor: pointer;
    user-select: none;
    font-size: 13px;
    line-height: 1.1;
    display: grid;
    grid-template-columns: 1em auto;
    gap: 0 1rem;
    align-items: center;
  }

  .container .form_options p {
    cursor: pointer;
    display: inline-block;
    font-size: 13px;
  }

  .container .form_options div {
    display: flex;
    align-items: center;
    gap: 0 0.7rem;
  }

  input[type="checkbox"] {
    /* Add if not using autoprefixer */
    -webkit-appearance: none;
    /* Remove most all native input styles */
    appearance: none;
    /* For iOS < 15 */
    background-color: transparent;
    /* Not removed via appearance */
    margin: 0;

    font: inherit;
    color: currentColor;
    width: 1.50em;
    height: 1.50em;
    border: 0.15em solid currentColor;
    border-radius: 0.15em;
    transform: translateY(-0.075em);

    display: grid;
    place-content: center;
  }

  input[type="checkbox"]::before {
    content: "";
    width: 0.65em;
    height: 0.65em;
    clip-path: polygon(14% 44%, 0 65%, 50% 100%, 100% 16%, 80% 0%, 43% 62%);
    transform: scale(0);
    transform-origin: bottom left;
    /*   transition: 120ms transform ease-in-out; */
    /*   box-shadow: inset 1em 1em red; */
    /* Windows High Contrast Mode */
    background-color: CanvasText;
  }

  input[type="checkbox"]:checked::before {
    transform: scale(1);
  }
</style>