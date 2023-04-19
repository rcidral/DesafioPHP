<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/cadastro.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
    <title>Shop</title>
</head>

<body>
    <header>
        <div class="container-header">
            <div class="logo">
                <img id="img-logo" src="https://raw.githubusercontent.com/bystack/.github/main/bannerWB.png" alt="logo">
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
                <?php foreach($_SESSION['produtoRecomendadoEditar'] as $produtoRecomendado) { ?>
                <div class="container-cadastro-header-produto">
                    <h1>Edição de Produto Recomendado</h1>
                </div>
                <div class="container-cadastro-body-produto">
                    <input type="hidden" name="id" id="id" value="<?= $produtoRecomendado['id'] ?>">
                    <input type="text" name="nome" id="nome" placeholder="Nome" value="<?= $produtoRecomendado['nome'] ?>">
                    <label id="sequenciaLabel" for="sequencia">Sequencia:</label>
                    <select name="sequencia" id="sequencia">
                        <?php if($_SESSION['produtos_recomendados'] == null) { ?>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        <?php } ?>
                        <?php $_SESSION['sequencia_total'] = ""; ?>
                        <?php foreach($_SESSION['produtos_recomendados'] as $produto) { ?>
                            <?php $_SESSION['sequencia_total'] = $_SESSION['sequencia_total'] . $produto['sequencia'] . ","; ?>
                        <?php } ?>
                        <?php if($_SESSION['sequencia_total'] == "1,") { ?>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        <?php } ?>
                        <?php if($_SESSION['sequencia_total'] == "2,") { ?>
                            <option value="1">1</option>
                            <option value="3">3</option>
                        <?php } ?>
                        <?php if($_SESSION['sequencia_total'] == "3,") { ?>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        <?php } ?>
                        <?php if($_SESSION['sequencia_total'] == "1,2,") { ?>
                            <option value="3">3</option>
                        <?php } ?>
                        <?php if($_SESSION['sequencia_total'] == "1,3,") { ?>
                            <option value="2">2</option>
                        <?php } ?>
                        <?php if($_SESSION['sequencia_total'] == "2,1,") { ?>
                            <option value="3">3</option>
                        <?php } ?>
                        <?php if($_SESSION['sequencia_total'] == "2,3,") { ?>
                            <option value="1">1</option>
                        <?php } ?>
                        <?php if($_SESSION['sequencia_total'] == "3,1,") { ?>
                            <option value="2">2</option>
                        <?php } ?>
                        <?php if($_SESSION['sequencia_total'] == "3,2,") { ?>
                            <option value="1">1</option>
                        <?php } ?>
                    </select>                
                    <h1>Foto Principal</h1>
                    <img style="width:160px;" src="./assets/product-recommended/<?=$produtoRecomendado['img']?>" alt="foto"><input type="file" name="img" id="img" placeholder="Foto" accept="image/png">
                    <div class="btn">
                        <button id="back-admin">Cancelar</button>
                        <button id="editar-produto-recomendado-btn">Salvar</button>
                    </div>
                </div>
                <?php } ?>
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
                <a href="/">Rio Grande do Sul 385</a>
            </div>
        </div>

    </footer>
</body>

</html>
