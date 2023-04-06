<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
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
                <button id="search-btn">Pesquisar</button>
            </div>
            <div class="cart">
                <?php if (isset($_SESSION['authenticated'])) { ?>
                    <img onclick="openCart()" src="https://img.icons8.com/material-outlined/256/shopping-cart.png" alt="cart">
                    <p class="badge-quantity" id="badge-quantity"><?= $_SESSION['quantidade']?></p>
                <?php } ?>
                <style>
                    
                </style>
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
            <div class="product-incorret">
                <p>Desculpe não encontramos o item procurado</p>
            </div>
        <div class="container-main">
            <?php foreach ($_SESSION['produtos'] as $produto) { ?>
                <div style="height: 370px;" class="product">
                    <div class="product-img">
                        <img onclick="openProduct(<?= $produto['id']?>)" src="data:image/png;base64,<?=$produto['img']?>" alt="product">
                    </div>
                    <div class="product-name">
                        <h3 onclick="openProduct(<?= $produto['id']?>)"><?= $produto['nome'] ?></h3>
                    </div>
                    <div class="product-description">
                        <p onclick="openProduct(<?= $produto['id']?>)"><?= $produto['descricao'] ?></p>
                    </div>
                    <div class="product-price">
                        <h3>R$ <?= $produto['preco'] ?></h3>
                    </div>
                    <?php if (isset($_SESSION['authenticated'])) { ?>
                        <div class="product-quantity">
                            <div class="product-quantity change">
                                <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                                <input type="hidden" name="idUsuario" value="<?= $usuario['id'] ?>">
                                <button onclick="addMin(<?=$produto['id']?>)" class="min">-</button>
                                <input id="quantidade-<?=$produto['id']?>" name="quantidade" type="number" value="1">
                                <button onclick="addMax(<?=$produto['id']?>)" class="max">+</button>
                            </div>
                            <button class="addToCart">Adicionar</button>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </main>
    <?php if (isset($_SESSION['authenticated'])) { ?>
        <aside class="closeCart" id="openCart">
            <div class="container-cart">
                <div class="cart-button_toggle">
                    <button onclick="closeCart()">
                        <svg width="26" height="26" fill="#ffffff" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <rect width="18" height="18" x="3" y="3" rx="2" ry="2"></rect>
                            <path d="m9 9 6 6"></path>
                            <path d="m15 9-6 6"></path>
                        </svg>
                    </button>
                </div>
                <div class="cart-header">
                    <p>
                        Carrinho
                    </p>
                </div>

                <div class="cart-body">
                    <div class="cart-body_content">
                        <div class="cart-body_content-item">
                            <div class="cart-body_content-item-info">
                                <?php foreach ($_SESSION['carrinho'] as $carrinho) { ?>
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="data:image/png;base64,<?=$carrinho['img']?>" alt="product">
                                        </div>
                                        <div class="product-name">
                                            <h3><?= $carrinho['nome'] ?></h3>
                                        </div>
                                        <div class="product-description">
                                            <p><?= $carrinho['descricao'] ?></p>
                                        </div>
                                        <div class="product-price">
                                            <h3>R$ <?= $carrinho['preco'] ?></h3>
                                        </div>
                                            <div class="product-quantity">
                                                <div class="product-quantity change">
                                                    <button onclick="addMinCart(<?= $carrinho['id_produto'] ?>)" class="min">-</button>
                                                    <input id="quantidade-cart-<?= $carrinho['id_produto'] ?>" type="number" value="<?= $carrinho['quantidade'] ?>">
                                                    <button onclick="addMaxCart(<?= $carrinho['id_produto'] ?>)" class="max">+</button>
                                                </div>
                                                <button onclick="removeToCart(<?= $carrinho['id_produto'] ?>, <?=$carrinho['id_usuario']?>)">Remover</button>
                                            </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="cart-body_footer">
                        <div class="cart-footer-total">
                            Total
                        </div>
                        <div class="cart-footer-price">
                            R$
                        </div>
                    </div>
                </div>

                <div class="cart-options">
                    <button onclick="buyCart(<?=$_SESSION['usuario']['id']?>)" id="comprar">
                        Comprar
                    </button>
                    <button onclick="deletarCarrinho(<?=$_SESSION['usuario']['id']?>)" id="limpar">
                        Limpar
                    </button>
                </div>

            </div>
            </div>
        </aside>
    <?php } ?>
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