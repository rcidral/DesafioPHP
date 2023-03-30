<html>

<body>

    <header>
        <div class="container">
            <div class="nav-bar">
                <div id="logo-id" class="nav-item nav-item-hidden nav-item-left">
                    <a href="#">
                        <img src="https://raw.githubusercontent.com/bystack/.github/main/bannerWB.png" alt="">
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
                    <h2>Cadastro de Usuário</h2>
                    <h4>Dados da Conta</h4>
                    <input id="nome" type="text" name="nome" placeholder="Nome" required="required" />
                    <input id="nascimento" type="date" name="nascimento" placeholder="Data de nascimento" required="required" />
                    <input id="tel" type="number" name="telefone" placeholder="Telefone" required="required" />
                    <input id="email" type="email" name="email" placeholder="E-mail" required="required" />
                    <input id="c_email" type="email" name="c_email" placeholder="Confirme seu e-mail" required="required" />
                    <input id="senha" type="password" name="senha" placeholder="Senha" required="required" />
                    <input id="c_senha" type="password" name="c_senha" placeholder="Confirme sua senha" required="required" />
                    <input id="foto" type="file" name="foto" placeholder="Foto" required="required" />
                    <button id="btn-salvar" class="salvar">Salvar</button>
                </fieldset>
            </form>

        </section>
    </main>

    <?php if (isset($_SESSION['authenticated'])) { ?>
        <aside style="display: none;" id="openCart">
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
                            <?php foreach ($_SESSION['carrinho'] as $carrinho) { ?>
                                <div class="cart-body_content-item-info">
                                    <img style="width: 160px; position: relative; right: 70px" src="<?= $carrinho->img ?>" alt="">
                                    <p style="font-size: 15px; position: relative; right: 70px">
                                        Nome: <?= $carrinho->nome ?>
                                    </p>
                                    <p style="font-size: 15px; position: relative; right: 70px; top:-10px;">
                                        Preço: R$ <?= $carrinho->preco ?>
                                    </p>
                                    <p style="font-size: 15px; position: relative; right: 70px; top:-15px;">
                                        Quantidade: <?= $carrinho->quantidade ?>
                                    </p>
                                </div>
                                <hr style="width: 200px; position: relative; right: 70px">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="cart-body_footer">
                        <div class="cart-footer-total">
                            Total
                        </div>
                        <div class="cart-footer-price">
                            R$ <?= $_SESSION['total']->preco ?>.00
                        </div>
                    </div>
                </div>

                <div class="cart-options">
                    <button>
                        Comprar
                    </button>
                    <button id="limpar">
                        Limpar
                    </button>
                </div>

            </div>
            </div>
        </aside>
    <?php } ?>


</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="./js/cadastroUsuario.js"></script>
<link rel="stylesheet" href="./style/cadastroUsuario.css">

</html>