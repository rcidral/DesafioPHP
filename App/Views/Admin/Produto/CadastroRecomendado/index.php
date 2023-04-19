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
                <div class="container-cadastro-header-produto">
                    <h1>Cadastro de Produto Recomendado</h1>
                </div>
                <div class="container-cadastro-body-produto">
                    <label id="nomeLabel" for="nomeLabel">Nome:</label>
                    <select name="nome" id="nome">
                        <?php foreach($_SESSION['produtos'] as $produto) { ?>
                            <?php if($_SESSION['produtos_recomendados']['nome'] != $produto['nome']) { ?>
                                <option value="<?= $produto['nome'] ?>"><?= $produto['nome'] ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
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
                    <input type="file" name="img" id="img" placeholder="Foto" accept="image/png">
                    <div class="btn">
                        <button id="back-admin">Cancelar</button>
                        <button id="salvar-produto-recomendado-btn">Salvar</button>
                    </div>
                    <div class="campos">
                        <p>Preencha todos os campos</p>
                    </div>
                    <div class="sequencia-div">
                        <p>Não é possível adicionar mais produtos recomendados</p>
                    </div>
                    <style>
                        .sequencia-div {
                            display: none;
                            color: red;
                            margin-top: 10px;
                        }
                    </style>
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
                <a href="/">Rio Grande do Sul 385</a>
            </div>
        </div>

    </footer>
</body>

</html>
