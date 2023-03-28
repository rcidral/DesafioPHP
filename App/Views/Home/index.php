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
            <button type="submit">
              <img src="https://img.icons8.com/ios-glyphs/256/search--v1.png" alt="Search">
            </button>
            <input type="search" placeholder="Pesquisar">
          </div>
          <div class="nav-item nav-item-right">
              <?php if (isset($_SESSION['authenticated'])) { ?>
                  <div class="square-bag-icon">
                    <a href="#" class="nav-link nav-link-bag">
                      <svg width="24px" height="24px" fill="#111" viewBox="0 0 24 24">
                        <path d="M16 7a1 1 0 0 1-1-1V3H9v3a1 1 0 0 1-2 0V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v3a1 1 0 0 1-1 1z"></path>
                        <path d="M20 5H4a2 2 0 0 0-2 2v13a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a2 2 0 0 0-2-2zm0 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V7h16z"></path>
                      </svg>
                    </a>
                  </div>
              <?php } ?>
              <?php if (!isset($_SESSION['authenticated'])) { ?>
                  <div class="square-bag-icon">
                    <button id="btn-entrar"  href="#" class="nav-link">
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
    <?php foreach ($_SESSION['produtos'] as $produto) { ?>
      <section class="section-product">
        <div class="general">
          <div>
            <img class="img-product" src="<?= $produto->img ?>" alt="">
          </div>
          <div class="conteudo">
            <h1 class="product"><?= $produto->nome ?></h1>
            <h1 class="price">R$<?= $produto->preco ?>.00</h1>
            <hr>
            <p><?= $produto->descricao ?></p>
            <?php if (isset($_SESSION['authenticated'])) { ?>
              <button class="add">Adicionar</button>
              <div class="qtd">
                <input type="number" name="qtd" id="qtd" min="1" value="1">
              </div>
            <?php } ?>
          </div>
        </div>
      </section>
    <?php } ?>
  </main>
    
  <footer class="footer">
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

<script>
  $(document).ready(function() {
    $('#btn-entrar').click(function() {
      setTimeout(function() {
        window.location.href = 'login';
      }, 250);
    });
  });
  $('#sair').click(function(e) {
    e.preventDefault();
    $.ajax({
      url: 'http://localhost:3000/logout',
      type: 'POST',
      dataType: 'json',
      success: function(data) {
        if (data.success) {
          window.location.href = 'http://localhost:3000/';
        }
      }
    });
  });
</script>


<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

<script>
  $(document).ready(function() {
    $('#btn-entrar').click(function() {
      setTimeout(function() {
        window.location.href = 'login';
      }, 250);
    });
  });
  $('#sair').click(function(e) {
    e.preventDefault();
    $.ajax({
      url: 'http://localhost:3000/logout',
      type: 'POST',
      dataType: 'json',
      success: function(data) {
        if (data.success) {
          window.location.href = 'http://localhost:3000/';
        }
      }
    });
  });
</script>

</html>


<style>
    body {
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }
  header {
    display:flex;
    justify-content:center;
    align-items:center;
    height:auto;
    width: 100%;
    background-color: #fff;
    padding: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, .2);
  }

  nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1550px;
    width: 100%;
    height: 100%;
    padding: 0.5em 2em;
  }
main{
  width:100%;
  height:auto;
  min-height:900px
}
  .container {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    max-width: 1550px;
  }
  #btn-entrar {
    background-color: #1c1c1e;
    color: #ffffff;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 16px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    position: relative;
    right: 50px;
  }

  .section-product {
    display: inline-block;
    font-family: "robotobold", sans-serif;
    margin-right: 30px;
    margin-bottom: 25px;
    position: relative;
    left: 160px;
    top: 50px;
  }
  #produto-id {
    
  }
  .square-bag-icon a {

    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 40px;
    position: relative;
    top: 20px;
    right: 70px;

  }

  .general {
    display: flex;
  }

  .img-product {
    width: 160px;
  }

  .conteudo {
    margin-left: 20px;
    position: relative;
    top: -10px;
  }

  .conteudo .product {
    font-size: 20px;
    font-family: Verdana;
    font-weight: 100;

  }

  .conteudo .price {
    position: relative;
    top: -20px;
    font-size: 30px;
    font-family: Verdana;
    font-weight: 100;
    color: rgb(47, 108, 222);
  }

  .conteudo hr {
    position: relative;
    top: -30px;
    width: 200px;
  }

  .conteudo p {
    position: relative;
    top: -30px;
    font-size: 15px;
    font-family: Verdana;
    font-weight: 100;
  }

  .conteudo .add {
    position: absolute;
    top: 160px;
    font-family: "montserratbold", sans-serif;
    -moz-border-radius: 25px;
    -webkit-border-radius: 25px;
    border-radius: 25px;
    font-size: 15px;
    line-height: 10%;
    background: #086fcf;
    border: 0 none;
    color: #fff;
    float: right;
    height: 50px;
    width: 120px;
    padding: 14px 26px 14px 30px
  }

  .conteudo .add:hover {
    background: #0a5db0;
  }

  .conteudo .qtd {
    position: absolute;
    top: 160px;
    left: 140px;
  }

  .conteudo .qtd input {
    width: 50px;
    height: 50px;
    text-align: center;
    font-size: 20px;
    font-family: "montserratbold", sans-serif;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  .dropdown {
    position: relative;
    display: inline-block;
    top: -2px;
    right: 20px;
  }
.dropdown span{
  font-size: 15px; 
  font-weight: 100;
}
  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 100px;
    min-height: 15px;
    box-shadow: 0px 3px 8px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;

  }
  .dropdown-content button {
    color: black;
    padding-left: 20px;
    padding-top: 5px;
    text-decoration: none;
    display: block;
    border: none;
    background-color: #f9f9f9;
    cursor: pointer;
  }

  .dropdown:hover .dropdown-content {
    display: block;
  }

  .hidden {
    display: none;
  }

  *::before,
  *::after {
    margin: 0;
    padding: 0;
  }
  html {
    font-size: 10px;
    font-family: Verdana;
  }
  a {
    display: block;
    text-decoration: none;
  }

  .nav-list-mobile {
    display: none;
  }

  .nav-link {
    font-size: 1.4rem;
    color: black;
    padding: 0 1rem;
    transition: opacity 0.2s;
  }
.nav-link-bag{
  position: relative; 
  top: 2px; 
  right: 20px;
}
  .nav-link:hover {
    opacity: 0.5;
  }

  .nav-bar {
    display: flex;
    width: 100%;
    height: 100%;
    align-items: center;
    justify-content: space-between;
    min-width: 832px;
  }

  .nav-item-left {
    width:25%;
    height:100%;
/*     background-color: aqua; */
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:5px
  }
.nav-item-left a {
  font-size: 1.8em;
  font-weight: 400;  
}
.nav-item-left a img{
  width: auto;
  height: 80px;
  objet-fit:cover;
}
  .nav-item-center {
    width: 50%;
    overflow: hidden;
  }

  li {
    margin-bottom: 12px;
  }

  /* FOOTER */

  .footer {
    display:flex;
    justify-content:center;
    align-items:center;
    width: 100%;
    height: auto;
    background: #111111;
  }

  .footer-start {
    display: flex;
    justify-content: space-between;
    align-items:center;
    width:100%;
    height:100%;
    padding:2em;
  }

  .footer-info-box_left {
    width: 33%;
    height:100%;
    display:flex;
    justify-content:center;
    align-items:center;
  }
.footer-info-box_left p{
  font-size: 1.3em;
  color:#ffffff;
  height:100%;
}
.footer-info-box_center {
    width: 33%;
    height:100%;
    display:flex;
    justify-content:center;
    align-items:center; 
}
.footer-info-box_center a{
  width:100%;
  height:100%;
  display:flex;
  justify-content:center;
  align-items:center;
}
.footer-info-box_center a img{
  height:auto;
  width:70%;
  object-fit:cover;
}
.footer-info-box_right{
    width: 33%;
    height:100%;
    display:flex;
    justify-content:center;
    align-items:center;
}
.footer-info-box_right a{
  font-size:1.3em;
  color: #ffffff;
}
  .search-container {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    position: relative;
    width: 60%;
    height: 40px;
    left: 30px;
  }
  .search-container input {
    width: 50%;
    height: 100%;
    border: 0;
    padding: 10px;
    border-radius: 0px 15px 15px 0px;
    background: #f5f5f5;
    outline: none;
  }
  .search-container button {
    width: 10%;
    height: 100%;
    border: 0;
    background: #f5f5f5;
    cursor: pointer;
    outline: none;
    border-radius: 15px 0px 0px 15px;
  }
  .search-container img{
    width: 26px;
    height: 26px;
  }


/*////////////////////////////// medias query */

  @media screen and (max-width: 1000px) {
    .nav-bar #produtos-id {
      display: none;
    }
  }

  @media screen and (min-width: 380px) and (max-width: 768px) {
    .search-container {
      left: -35px;
    }
  }
</style>