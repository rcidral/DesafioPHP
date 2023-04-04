<html>

<body>

    <header>
        <div class="container">
            <div class="nav-bar">
                <div id="logo-id" class="nav-item nav-item-hidden nav-item-left">
                    <a href="/admin">
                        <img src="https://raw.githubusercontent.com/bystack/.github/main/bannerWB.png" alt="">
                    </a>
                    <a style="margin-right: 100%;" id="produtos-id" href="/admin" class="nav-link">
                        Voltar
                    </a>
                </div>
                <div class="nav-item nav-item-right">
                    <?php if (isset($_SESSION['authenticated'])) { ?>
                        <div class="dropdown">
                            <span><?= $_SESSION['nome'] ?></span>
                            <div class="dropdown-content">
                                <button id="sair">
                                    Sair
                                </button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section>

            <form id="form">
                <fieldset>
                    <h2>Editar Usuário</h2>
                    <h4>Dados da Conta</h4>
                    <?php foreach($_SESSION['usuarioListado'] as $usuario) { ?>
                    <input id="id" type="hidden" name="id" value="<?= $usuario->id ?>" />
                    <input id="nome" type="text" name="nome" placeholder="Nome" value="<?=$usuario->nome?>" />
                    <input id="nascimento" type="date" name="nascimento" placeholder="Data de nascimento" value="<?=$usuario->nascimento?>" />
                    <input id="tel" type="number" name="telefone" placeholder="Telefone" value="<?=$usuario->telefone?>" />
                    <input id="email" type="email" name="email" placeholder="E-mail" value="<?=$usuario->email?>" />
                    <input id="c_email" type="email" name="c_email" placeholder="Confirme seu e-mail" value="<?=$usuario->email?>" />
                    <input id="senha" type="password" name="senha" placeholder="Senha" value="<?=$usuario->senha?>" />
                    <input id="c_senha" type="password" name="c_senha" placeholder="Confirme sua senha" value="<?=$usuario->senha?>" />
                    <input id="foto" type="file" name="foto" placeholder="Foto" value="<?=$usuario->img?>" />
                    <?php } ?>
                    <button id="btn-editar-usuario" class="salvar">Salvar</button>
                    <div class="png">
                        <p id="msg">Preencha todos os campos com imagens png</p>
                    </div>
                </fieldset>
            </form>

        </section>
    </main>

</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="./js/editar.js"></script>
<link rel="stylesheet" href="./style/cadastroUsuario.css">

</html>