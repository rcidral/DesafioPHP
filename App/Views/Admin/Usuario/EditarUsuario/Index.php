<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/cadastro.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <title>Shop</title>
</head>

<body>
    <header>
        <div class="container-header">
            <div class="logo">
                <img src="https://raw.githubusercontent.com/bystack/.github/main/bannerWB.png" alt="logo">
                <a href="/admin">Voltar</a>
            </div>
            <div class="user">
                <?php if (isset($_SESSION['authenticated'])) { ?>
                    <p id="drop"> <?= $_SESSION['usuario']['nome'] ?></p>
                <?php } ?>
            </div>
            <div class="dropdown">
                <p id="sair">Sair</p>
            </div>
        </div>
    </header>
    <main>
        <div class="container-main-usuario">
            <div class="container-cadastro-usuario">
                <div class="container-cadastro-header-usuario">
                    <h1>Edição de Usuário</h1>
                </div>
                <?php foreach($_SESSION['usuarioEditar'] as $usuario) { ?>
                <div class="container-cadastro-body-usuario">
                    <input type="hidden" name="id" id="id" value="<?= $usuario['id'] ?>">
                    <input type="text" name="nome" id="nome" placeholder="Nome" value="<?= $usuario['nome'] ?>">
                    <input type="date" name="dataNascimento" id="dataNascimento" placeholder="Data de Nascimento">
                    <input type="number" name="telefone" id="telefone" placeholder="Telefone" value="<?= $usuario['telefone'] ?>">
                    <input type="text" name="email" id="email" placeholder="Email" value="<?= $usuario['email'] ?>">
                    <input type="password" name="senha" id="senha" placeholder="Senha" value="<?= $usuario['senha'] ?>">
                    <input type="password" name="confirmarSenha" id="confirmarSenha" placeholder="Confirmar Senha" value="<?= $usuario['senha'] ?>">
                    <input type="file" name="foto" id="foto" placeholder="Foto" accept="png">
                    <button id="editar-usuario-btn">Salvar</button>
                <?php } ?>
                    <div class="confirmar">
                        <p>As senhas não coincidem</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>

        <div class="container-footer">
            <div class="footer-copy">
                <p>© 2021 - ByStack</p>
            </div>
            <div class="footer-logo">
                <img src="https://raw.githubusercontent.com/bystack/.github/main/bannerWB.png" alt="logo">
            </div>
            <div class="footer-a">
                <a href="/">ByStack</a>
            </div>
        </div>

    </footer>
</body>

</html>

<script src="./js/script.js"></script>