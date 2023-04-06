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
                <?php foreach($_SESSION['produtoEditar'] as $produto) { ?>
                <div class="container-cadastro-header-produto">
                    <h1>Edição do Produto <?= $produto['nome'] ?></h1>
                </div>
                <div class="container-cadastro-body-produto">
                    <input type="hidden" name="id" id="id" value="<?= $produto['id'] ?>">
                    <input type="text" name="nome" id="nome" placeholder="Nome" value="<?= $produto['nome'] ?>">
                    <input type="text" name="descricao" id="descricao" placeholder="Descrição" value="<?= $produto['descricao'] ?>">
                    <input type="number" name="preco" id="preco" placeholder="Preço" value="<?= $produto['preco'] ?>">
                    <h1>Foto Principal</h1>
                    <img style="width: 60px;" src="data:image/png;base64,<?=$produto['img']?>" alt="product"><input type="file" name="img" id="img" placeholder="Foto" accept="png">
                    <h1>Foto Opcional</h1>
                    <img style="width: 60px;" src="data:image/png;base64,<?=$produto['img1']?>" alt="product"><input type="file" name="img1" id="img1" placeholder="Foto" accept="png">
                    <img style="width: 60px;" src="data:image/png;base64,<?=$produto['img2']?>" alt="product"><input type="file" name="img2" id="img2" placeholder="Foto" accept="png">
                    <img style="width: 60px;" src="data:image/png;base64,<?=$produto['img3']?>" alt="product"><input type="file" name="img3" id="img3" placeholder="Foto" accept="png">
                    <button id="editar-produto-btn">Salvar</button>
                <?php } ?>
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