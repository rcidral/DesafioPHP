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
                <img id="img-logo" src="https://raw.githubusercontent.com/bystack/.github/main/bannerWB.png" alt="logo">
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
        <div class="container-main-produto">
            <div class="container-cadastro-produto">
                <div class="container-cadastro-header-produto">
                    <h1>Cadastro de Produto</h1>
                </div>
                <div class="container-cadastro-body-produto">
                    <input type="text" name="nome" id="nome" placeholder="Nome">
                    <input type="text" name="descricao" id="descricao" placeholder="Descrição">
                    <input type="number" name="preco" id="preco" placeholder="Preço">
                    <h1>Foto Principal</h1>
                    <input type="file" name="img" id="img" placeholder="Foto" accept="image/png">
                    <h1>Foto Opcional</h1>
                    <input type="file" name="img1" id="img1" placeholder="Foto" accept="image/png">
                    <input type="file" name="img2" id="img2" placeholder="Foto" accept="image/png">
                    <input type="file" name="img3" id="img3" placeholder="Foto" accept="image/png">
                    <button id="salvar-produto-btn">Salvar</button>
                    <div class="campos">
                        <p>Preencha todos os campos</p>
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