<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/compra.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <title>Shop</title>
</head>

<body>
    <header>
        <div class="container-header">
            <div class="logo">
                <img id="img-logo" src="https://raw.githubusercontent.com/bystack/.github/main/bannerWB.png" alt="logo">
                <a href="/">Produtos</a>
            </div>
            <div class="search">
                <input id="search" type="text" placeholder="Search">
                <button id="search-btn">Search</button>
            </div>
            <div class="cart">
                <?php if (isset($_SESSION['authenticated'])) { ?>
                    <img onclick="openCart()" src="https://img.icons8.com/material-outlined/256/shopping-cart.png" alt="cart">
                <?php } ?>
            </div>
            <div class="user">
                <?php if (!isset($_SESSION['authenticated'])) { ?>
                    <button onclick="login()" id="btn-entrar">Entrar</button>
                <?php } ?>
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
        <div class="container-main">
            <div class="pedido">
                <?php foreach($_SESSION['pedido'] as $pedido) { ?>
                    <h1>Pedido realizado! Numero do Pedido: <?=$pedido['id']?></h1>
                <?php } ?>
            </div>
        </div>

        <style>
            .container-main {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            .pedido {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                width: 100%;
                height: 100%;
            }

            .pedido h1 {
                font-size: 2rem;
                font-weight: 500;
                color: #000;
            }
        </style>

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

<script src="./js/script.js"></script>