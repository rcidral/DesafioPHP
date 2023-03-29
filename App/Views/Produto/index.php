<html>

<body>

<header>
    <div class="container">
      <div class="nav-bar">
        <div id="logo-id" class="nav-item nav-item-hidden nav-item-left">
          <a href="#">
            <img src="https://raw.githubusercontent.com/bystack/.github/main/banner.png" alt="">
          </a>
          <a id="produtos-id" href="/" class="nav-link">
            Produtos
          </a>
        </div>
        <div class="search-container">
          <button id="pesquisar" type="submit">
            <img src="https://img.icons8.com/ios-glyphs/256/search--v1.png" name="Search">
          </button>
          <input name="pesquisa" type="search" placeholder="Pesquisar" >
        </div>
        <div class="nav-item nav-item-right">
          <?php if (isset($_SESSION['authenticated'])) { ?>
            <div class="square-bag-icon">
              <button onclick="openCart()" id="cart-modal" href="#" class="nav-link nav-link-bag">
                <svg style="position: relative; right:20px;" width="36px" height="36px" fill="#111" viewBox="0 0 24 24">
                  <path d="M16 7a1 1 0 0 1-1-1V3H9v3a1 1 0 0 1-2 0V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v3a1 1 0 0 1-1 1z"></path>
                  <path d="M20 5H4a2 2 0 0 0-2 2v13a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a2 2 0 0 0-2-2zm0 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V7h16z"></path>
                </svg>
              </button>
              <span id="badge"><?php echo $_SESSION['quantidade']->quantidade ?></span>
            </div>
          <?php } ?>
          <?php if (!isset($_SESSION['authenticated'])) { ?>
            <div class="square-bag-icon">
              <button id="btn-entrar" href="#" class="nav-link">
                Entrar
              </button>
            <?php } ?>
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
    
  <footer>
    <div class="container">
      <div class="footer-start">
        <div class="footer-info-box_left">
          <p>
            &copy; 2023 ByStack. Todos os direitos reservados.
          </p>
        </div>
        <div class="footer-info-box_center">
          <a href="#">
            <img src="https://raw.githubusercontent.com/bystack/.github/main/banner.png" alt="">
          </a>
        </div>
        <div class="footer-info-box_right">
          <a href="/">
            bystack
          </a>
        </div>
      </div>
    </div>
    </div>
  </footer>
</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="./js/produto.js"></script>
<link rel="stylesheet" href="./style/produto.css">

</html>
