<html>

<header>
  <div class="container">
    <nav class="nav">
      <ul class="nav-list nav-list-mobile">
        <li class="nav-item">
          <a href="# " class="nav-link nav-link-nike-logo"></a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link nav-link-bag"></a>
        </li>
        <li class="nav-item">
          <div class="mobile-menu">
            <span class="line line-top"></span>
            <span class="line line-bottom"></span>
          </div>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link nav-link-search"></a>
        </li>
      </ul>
      <!--     closes ul list  mobile-->

      <div class="nav-bar">
        <div id="logo-id" class="nav-item nav-item-hidden nav-item-left">
          <a href="#" style="position: relative; top: 8px;" class="nav-link nav-link-nike-logo"></a>
          <a id="produtos-id" href="" style="font-size: 20px; position: absolute; top: 35px; left: 130px;" class="nav-link">Produtos</a>
        </div>

        <ul class="nav-list">
          <li class="nav-item">
            <div class="search-container">
              <button type="submit"><img src="https://img.icons8.com/ios-glyphs/256/search--v1.png" alt="Search"></button>
              <input type="search" placeholder="Pesquisar">
            </div>
          </li>
        </ul>


        <div class="nav-item nav-item-right">
          <ul class="nav-list">
            <li class="nav-item ">
              <div class="square-bag-icon">
                <a style="position: relative; top: 2px;" href="#" class="nav-link nav-link-bag"><svg width="24px" height="24px" fill="#111" viewBox="0 0 24 24">
                    <path d="M16 7a1 1 0 0 1-1-1V3H9v3a1 1 0 0 1-2 0V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v3a1 1 0 0 1-1 1z"></path>
                    <path d="M20 5H4a2 2 0 0 0-2 2v13a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a2 2 0 0 0-2-2zm0 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V7h16z"></path>
                  </svg></a>
              </div>
            </li>

            <li class="nav-item ">
              <div class="square-bag-icon">
                <button id="btn-entrar" style="cursor: pointer; border: none; background-color: black; color: white; position: relative; top: 2px; height: 30px; border-radius: 15px;" href="#" class="nav-link">Entrar</button>
            </li>

          </ul>
        </div>
        <!--  nav-list left items    -->
      </div>

    </nav>
  </div>
</header>

<body>
  <section class="shoes-examples">
    <div class="container container-intro-img">
      <div class="shoe-img-left"></div>
      <div class="shoe-img-right"></div>
    </div>
    <div class="container">
      <div class="title">
        <h4 class="title-heading">Blazer Jumbo '77</h4>
        <h1 class="title-sub-heading">Don't Miss Out</h1>
        <h3 class="title-heading-description">Blazer is a force for self-expression. How will you wear yours?</h3>
        <div class="shop">
          <a href="#" class="cta-link">Shop</a>
        </div>
      </div>
    </div>
    <!--     close title div   -->
  </section>
</body>




<footer class="footer">
  <div class="container">
    <div class="footer-start">
      <div class="footer-info-box footer-info-box-alt">
        <ul class="footer-tags footer-tags-alt-color">
          <li>&copy; 2023 Nome da Empresa. Todos os direitos reservados.</li>
        </ul>
      </div>
      <div class="footer-info-box">
        <ul class="footer-tags">
          <li><a href="# " style="filter: invert(100%);" class="nav-link nav-link-nike-logo"></a></li>
        </ul>
      </div>
      <div class="footer-info-box">
        <ul class="footer-tags">
          <li><a href="#">Link do Site</a></li>
        </ul>
      </div>
    </div>
  </div>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

<script>
  $(document).ready(function() {
    $('#btn-entrar').click(function() {
      setTimeout(function() {
        window.location.href = 'login.php';
      }, 250);
    });
  });
  $.ajax({
      url: 'http://localhost:3000/check-login.php',
      type: 'GET',
      dataType: 'json'
    })
    .done(function(response) {
      if (response.logged_in) {
        // Se o usuário estiver logado, substituir o botão de login pelo nome do usuário
        $('#btn-entrar').hide();
        $('#dropdown').show();
      } else {
        // Se o usuário não estiver logado, exibir o botão de login padrão
        $('#dropdown').hide();
        $('#btn-entrar').show();
      }
    });
</script>

</html>


<style>
  .hidden {
    display: none;
  }

  * {}

  *::before,
  *::after {
    margin: 0;
    padding: 0;
  }

  html {
    font-size: 10px;
    font-family: Verdana;
  }

  header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #fff;
    /* substitua pela cor de fundo desejada */
    z-index: 9999;
    /* garante que o cabeçalho fique em cima de outros elementos */
    padding: 10px;
    /* adiciona um espaçamento para que o conteúdo não fique escondido pelo cabeçalho */
    box-shadow: 0 2px 4px rgba(0, 0, 0, .2);
    /* adiciona uma sombra para destacar o cabeçalho */
  }

  a {
    display: block;
    text-decoration: none;
  }

  .container {
    margin: 0 auto;
    padding: 0 2.2rem;
    /*   border: 2px solid red; */
    overflow: hidden;
  }

  /* Start nav list */

  .nav-list {
    list-style: none;
    display: flex;
    /*   border: 2px solid red; */
    align-items: center;
    justify-content: space-around;
    /*     background: lightblue; */
    /*   change to white */
    height: 60px;
    font-weight: bold;
  }

  .nav-list-larger {
    /*     border: 1px solid ; */
    padding: 0px 100px;
  }

  .nav-list-mobile {
    display: none;
    /*   border: 2px solid mistyrose; */
  }

  .nav-link {
    font-size: 1.4rem;
    color: black;
    padding: 0 1rem;
    transition: opacity 0.2s;
    /*   border: 1px solid red; */
  }

  .nav-link:hover {
    opacity: 0.5;
  }

  .nav-link-nike-logo {
    width: 60px;
    height: 60px;
    background-image: url("data:image/png;base64,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");
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
  }

  .nav-link-search-bar {
    position: relative;
    right: 130px;
    border-radius: 20px;
    width: 350px;
    height: 35px;
    background-color: #f5f5f5;
    padding: 0px;
  }

  .nav-link-search-bar::after {
    content: "Search";
    position: relative;
    top: -10px;
    left: 40px;
    font-size: 14px;
    font-weight: bold;
    color: #cccccc;
  }

  .nav-link-search-glass {
    width: 15px;
    height: 15px;
    border: 2px solid black;
    border-radius: 50%;
    position: relative;
    top: 5px;
    left: 9px;
    transform: rotate(45deg);
  }

  .nav-link-search-glass::after {
    content: "";
    position: absolute;
    width: 10px;
    height: 2px;
    background: black;
    right: -10px;
    top: 50%;
    transform: translatey(-50%);
  }

  .nav-bar {
    display: flex;
    justify-content: space-between;
    /*   border: 3px solid green; */
  }

  .nav-item-left {
    width: 25%;
  }

  .nav-item-center {
    /*   border: 2px solid yellow; */
    width: 50%;
    overflow: hidden;
  }

  .nav-item-right {
    overflow: hidden;
  }

  /* end of Nav list */

  /* start of heading  */
  header .heading {
    width: 100%;
    height: 2.4rem;
    background-color: #f5f5f5;
    /*  background: lightblue; */
    display: flex;
    justify-content: space-between;
    align-items: center;
    /*  border: 3px solid green; */
  }

  .heading-items-right {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .heading-item {
    border-right: 1px solid black;
    margin: 0px 2px;
    align-self: center;
    font-size: 12px;
  }

  .heading-item-jordan {
    width: 1.1rem;
    height: 2.4rem;
    background-image: url("https://www.nike.com/assets/experience/ciclp/landing-pages/static/v2/209-c9a1e1273ff/static/icons/jordan.svg");
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
  }

  .no-border {
    border: none;
  }

  /* end of heading */

  .page-announcements {
    height: 45px;
    text-align: center;
    font-size: 12px;
    padding-top: 10px;
    padding-bottom: 10px;
    background: #f5f5f5;
  }

  .container-intro-img {
    width: 100%;
    height: 700px;
    display: flex;
    padding: 0px;
    /*   border: 4px solid red; */
    /*   clear border */
  }

  .shoe-img-left {
    /*   border: 2px solid blue; */
    width: 50%;
    height: 100%;
    margin-left: 2.2rem;
    background-image: url("https://images.unsplash.com/photo-1521093470119-a3acdc43374a?crop=entropy&cs=srgb&fm=jpg&ixid=MnwxNDU4OXwwfDF8cmFuZG9tfHx8fHx8fHx8MTY0NTkyODUxOQ&ixlib=rb-1.2.1&q=85");
    background-size: cover;
    background-position: right;
    /*   background-repeat: no-repeat; */
  }

  .shoe-img-right {
    /*   border: 2px solid orange; */
    width: 50%;
    height: 100%;
    margin-right: 2.2rem;
    background: grey;
    background-image: url("https://images.unsplash.com/photo-1584735174965-48c48d7edfde?crop=entropy&cs=srgb&fm=jpg&ixid=MnwxNDU4OXwwfDF8cmFuZG9tfHx8fHx8fHx8MTY0NTkyNzQ1MA&ixlib=rb-1.2.1&q=85");
    background-size: cover;
    /*     background-repeat: no-repeat; */
    background-position: left;
  }

  .title {

    height: 250px;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    /*   background: mistyrose; */
    margin-bottom: 40px;
    /*   border: 3px solid orange; */
  }

  .title-heading {
    font-size: 22px;
    margin-top: 60px;
    margin-bottom: 0px;
    font-weight: normal;
  }

  .title-sub-heading {
    font-size: 70px;
    padding: 0px;
    margin: 0px;
    /*   border: 1px solid black; */
    letter-spacing: -5px;
    padding-bottom: 5px;
  }

  .title-heading-description {
    font-size: 17px;
    font-weight: 400;
    margin: 0px;
    text-align: center;
    width: 600px;
    line-height: 1.3;
  }

  .cta-link {
    font-size: 14px;
    font-weight: 400px;
    text-align: center;
    padding: 5px 0px;
    color: white;
  }

  .shop {
    border: 4px solid black;
    background: black;
    border-radius: 20px;
    width: 70px;
    height: 30px;
    margin-top: 24px;
    color: white;
  }

  .shop:hover {
    opacity: 0.5;
  }

  .shop-white {
    font-size: 14px;
    text-align: center;
    padding: 6px 2px 0px 2px;
    background: white;
    border-radius: 20px;
    width: 70px;
    height: 30px;
    margin-top: 24px;
    color: black;
  }

  .shop-white:hover {
    opacity: 0.5;
  }

  .title-gear {
    display: flex;
    justify-content: space-between;
    /*   border: 3px solid red; */
    margin-top: 80px;
    margin-bottom: 20px;
  }

  .title-heading-gear {
    font-size: 20px;
    padding: 5px;
    align-self: center;
  }

  .clicking-arrows {
    display: flex;
  }

  .title-arrow-left {
    width: 40px;
    height: 40px;
    border: 3px solid #e5e5e5;
    background: #e5e5e5;
    margin-right: 12px;
    border-radius: 25px;
  }

  .title-arrow-left::before {
    content: "";
    display: block;
    width: 12px;
    height: 12px;
    border-bottom: 3px solid black;
    position: relative;
    top: 5px;
    left: 10px;
    transform: rotate(-45deg);
  }

  .title-arrow-left::after {
    content: "";
    display: block;
    width: 12px;
    height: 12px;
    border-bottom: 3px solid black;
    position: relative;
    top: -3px;
    left: 18px;
    transform: rotate(45deg);
  }

  .title-arrow-right {
    content: "";
    display: block;
    width: 40px;
    height: 40px;
    border: 3px solid #e5e5e5;
    background: #e5e5e5;
    border-radius: 25px;
  }

  .title-arrow-right::before {
    content: "";
    display: block;
    width: 12px;
    height: 12px;
    border-bottom: 3px solid black;
    position: relative;
    top: 5px;
    left: 20px;
    transform: rotate(45deg);
  }

  .title-arrow-right::after {
    content: "";
    display: block;
    width: 12px;
    height: 12px;
    border-bottom: 3px solid black;
    position: relative;
    top: -3px;
    left: 12px;
    transform: rotate(-45deg);
  }

  .arrow:hover {
    opacity: 0.5;
  }

  .shoe-item-container {
    /*   border: 1px solid yellowgreen; */
    height: 530px;
    width: 1400px;
    margin-bottom: 30px;
    white-space: nowrap;
    overflow-x: scroll;
  }

  .shoe-item {
    /*    border: 3px solid lightblue; */
    width: 441px;
    height: 510px;
    margin-right: 20px;
    display: inline-block;
  }

  .shoe-display {
    background: white;
    /*     border: 3px solid blue; */
    height: 441px;
  }

  .shoe-info {
    margin-top: 10px;
    /*   border: 2px solid red; */
    height: 48px;
    display: flex;
    justify-content: space-between;
  }

  .shoe-model {
    /*   border: 3px solid violet; */
    width: 75%;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
  }

  .shoe-item-price {
    /*   border: 3px solid hotpink; */
    width: 25%;
    font-size: 14px;
    margin-right: 10px;
    text-align: right;
  }

  .shoe-name {
    /*     border: 3px solid forestgreen; */
    font-size: 15px;
    font-weight: bold;
  }

  .shoe-genre-classification {
    /*   border: 3px solid forestgreen; */
    color: grey;
    font-size: 14px;
  }

  .shoe-item-first {
    background-image: url("https://static.nike.com/a/images/q_auto:eco/t_product_v1/f_auto/dpr_2.0/w_442,c_limit/bb944fb5-cbfa-4fe6-9546-a3bb467ae3c8/air-zoom-superrep-3-hiit-class-shoes-WWc7rC.png");
    background-size: contain;
    background-repeat: no-repeat;
  }

  .shoe-item-second {
    background-image: url("https://static.nike.com/a/images/q_auto:eco/t_product_v1/f_auto/dpr_2.0/w_442,c_limit/130f2aad-0bb4-4c17-ab98-314771955346/air-zoom-superrep-3-hiit-class-shoes-CDk5j2.png");
    background-size: contain;
    /*   background-position: bottom -150px right -35px; */
    background-repeat: no-repeat;
  }

  .shoe-item-third {
    background-image: url("https://static.nike.com/a/images/q_auto:eco/t_product_v1/f_auto/dpr_2.0/w_442,c_limit/f749fd41-57d1-4ad7-9509-151fffbc3356/dri-fit-seamless-training-top-gHjZNW.png");
    background-size: contain;
    background-repeat: no-repeat;
  }

  .shoe-item-fourth {
    background-image: url("https://static.nike.com/a/images/q_auto:eco/t_product_v1/f_auto/dpr_2.0/w_442,c_limit/93d5ffc3-6857-4691-8e13-7a5565adc07a/pro-dri-fit-flex-6-training-shorts-TpsbBC.png");
    background-size: contain;
    background-repeat: no-repeat;
  }

  .shoe-item-fifth {
    background-image: url("https://static.nike.com/a/images/q_auto:eco/t_product_v1/f_auto/dpr_2.0/w_442,c_limit/bb6f2759-23f5-4aec-8ae8-246a7a741f36/dri-fit-alpha-high-support-padded-zip-front-sports-bra-GBDHQ9.png");
    background-size: contain;
    background-repeat: no-repeat;
  }

  .shoe-item-sixth {
    background-image: url("https://static.nike.com/a/images/q_auto:eco/t_product_v1/f_auto/dpr_2.0/w_442,c_limit/deb52d93-950c-49d3-8da0-2a9f4e24e999/dri-fit-one-luxe-mid-rise-7-8-printed-leggings-8n1wpH.png");
    background-size: contain;
    background-repeat: no-repeat;
  }

  .shoe-item-seventh {
    background-image: url("https://static.nike.com/a/images/q_auto:eco/t_product_v1/f_auto/dpr_2.0/w_442,c_limit/d3d03f43-abe4-4275-bbdc-519a1fe5e64c/dri-fit-one-luxe-slim-fit-tank-D7bdL8.png");
    background-size: contain;
    background-repeat: no-repeat;
  }

  .shoe-item-eigth {
    background-image: url("https://static.nike.com/a/images/q_auto:eco/t_product_v1/f_auto/dpr_2.0/w_442,c_limit/1b045a2b-d459-43ad-ae4e-1d716c9f769e/cropped-novelty-fleece-crew-sweatshirt-9mJH4W.png");
    background-size: contain;
    background-repeat: no-repeat;
  }

  .shoe-item-ninth {
    background-image: url("https://static.nike.com/a/images/q_auto:eco/t_product_v1/f_auto/dpr_2.0/w_442,c_limit/601ee379-5e51-47e1-8766-7ab0c6ea6238/dri-fit-run-division-mid-rise-running-leggings-rMR00g.png");
    background-size: contain;
    background-repeat: no-repeat;
  }

  .shoe-item-tenth {
    background-image: url("https://static.nike.com/a/images/q_auto:eco/t_product_v1/f_auto/dpr_2.0/w_442,c_limit/c7f34946-add1-4881-8dc3-2a2c58b6f142/dri-fit-swoosh-high-support-non-padded-adjustable-sports-bra-Jzphzt.png");
    background-size: contain;
    background-repeat: no-repeat;
  }

  .title-gear-tailored {
    margin-top: 100px;
    margin-bottom: 25px;
    /*   border: 2px solid cyan; */
  }

  .img-gear-tailored {
    display: flex;
    justify-content: space-around;
  }

  .img-left {
    /*   border: 3px solid red; */
    width: 666px;
    height: 1016px;
    background-image: url("https://images.unsplash.com/photo-1577983010022-10ef0c16b451?crop=entropy&cs=srgb&fm=jpg&ixid=MnwxNDU4OXwwfDF8cmFuZG9tfHx8fHx8fHx8MTY0NjA4NTc0NA&ixlib=rb-1.2.1&q=85");
    background-size: cover;
    background-position: center;
  }

  .images-right {
    /*   border: 3px solid orange; */
    width: 666px;
    height: 1016px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    margin-left: 15px;
  }

  .img-right-top {
    /*   border: 2px solid yellow; */
    height: 500px;
    background-image: url("https://images.unsplash.com/photo-1597045566677-8cf032ed6634?crop=entropy&cs=srgb&fm=jpg&ixid=MnwxNDU4OXwwfDF8cmFuZG9tfHx8fHx8fHx8MTY0NjA4NjMwMA&ixlib=rb-1.2.1&q=85");
    background-size: 120%;
    background-position: center -470px;
  }

  .img-right-bottom {
    /*   border: 2px solid yellow; */
    height: 500px;
    background-image: url("https://images.unsplash.com/photo-1582588678413-dbf45f4823e9?crop=entropy&cs=srgb&fm=jpg&ixid=MnwxNDU4OXwwfDF8cmFuZG9tfHx8fHx8fHx8MTY0NjA4NjEzNA&ixlib=rb-1.2.1&q=85");
    background-size: 100%;
    background-position: center -300px;
  }

  .img-description {
    font-size: 16px;
    color: white;
    /*   border: 3px solid grey; */
    margin-left: 60px;
    position: relative;
  }

  .img-description-first {
    top: 880px;
  }

  .shop-first {
    position: relative;
    margin-left: 60px;
    top: 880px;
  }

  .img-description-second {
    position: relative;
    top: 390px;
    left: 140px;
  }

  .shop-second {
    position: relative;
    top: 390px;
    left: 200px;
  }

  .img-description-third {
    position: relative;
    top: 360px;
    margin-left: 60px;
  }

  .shop-third {
    position: relative;
    top: 360px;
    margin-left: 60px;
  }

  .trending-item-first {
    background-image: url("https://static.nike.com/a/images/q_auto:eco/t_product_v1/f_auto/dpr_2.0/w_442,c_limit/go9ejlsilpz2hq0eophu/air-max-plus-shoe-nnTrAZe0.png");
    background-size: contain;
    background-repeat: no-repeat;
  }

  .trending-item-second {
    background-image: url("https://static.nike.com/a/images/q_auto:eco/t_product_v1/f_auto/dpr_2.0/w_442,c_limit/d9f1d9ee-a848-4a36-aab9-48b241078ebb/air-force-1-le-older-shoe-sCkTz9.png");
    background-size: contain;
    background-repeat: no-repeat;
  }

  .trending-item-third {
    background-image: url("https://static.nike.com/a/images/q_auto:eco/t_product_v1/f_auto/dpr_2.0/w_435,c_limit/e777c881-5b62-4250-92a6-362967f54cca/air-force-1-07-shoe-Dz225W.png");
    background-size: contain;
    background-repeat: no-repeat;
  }

  .trending-item-fourth {
    background-image: url("https://static.nike.com/a/images/q_auto:eco/t_product_v1/f_auto/dpr_2.0/w_435,c_limit/l3w4varugbogihcpj40e/air-force-1-shadow-shoes-n7WF4B.png");
    background-size: contain;
    background-repeat: no-repeat;
  }

  .trending-item-fifth {
    background-image: url("https://static.nike.com/a/images/q_auto:eco/t_product_v1/f_auto/dpr_2.0/w_435,c_limit/29e25f4a-693a-4d2e-9d16-fa042fe0838b/air-force-1-07-lv8-shoes-LGmbx0.png");
    background-size: contain;
    background-repeat: no-repeat;
  }

  .trending-item-sixth {
    background-image: url("https://static.nike.com/a/images/q_auto:eco/t_product_v1/f_auto/dpr_2.0/w_435,c_limit/6b587f76-7463-4171-8047-39d28478887b/air-max-plus-shoes-t39f6W.png");
    background-size: contain;
    background-repeat: no-repeat;
  }

  .trending-item-seventh {
    background-image: url("https://static.nike.com/a/images/q_auto:eco/t_product_v1/f_auto/dpr_2.0/w_435,c_limit/3a01699a-864e-4da4-9d84-561d60e3e094/af-1-shadow-shoes-5v66FL.png");
    background-size: contain;
    background-repeat: no-repeat;
  }

  .trending-item-eigth {
    background-image: url("https://static.nike.com/a/images/q_auto:eco/t_product_v1/f_auto/dpr_2.0/w_435,c_limit/85022b70-8f3f-4426-b5d6-bcabcef52cba/air-force-1-07-lv8-shoes-LGmbx0.png");
    background-size: contain;
    background-repeat: no-repeat;
  }

  .trending-item-ninth {
    background-image: url("https://static.nike.com/a/images/q_auto:eco/t_product_v1/f_auto/dpr_2.0/w_435,c_limit/3e26a9d5-4452-4aea-a1cd-1ff477d68d8c/sportswear-tech-fleece-hoodie-Rhmk1c.png");
    background-size: contain;
    background-repeat: no-repeat;
  }

  .trending-item-tenth {
    background-image: url("https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5/8f58cb83-fa5f-4869-a2ca-af00de620f50/mercurial-dream-speed-vapor-14-elite-fg-football-boot-JwkkpL.png");
    background-repeat: no-repeat;
    background-postion: center;
    background-size: 100%;
  }

  .shoe-display-banner {
    height: 482px;
    display: flex;
  }

  .shoe-img-banner-left {
    width: 33%;
    background-image: url("https://images.unsplash.com/photo-1600185365926-3a2ce3cdb9eb?crop=entropy&cs=srgb&fm=jpg&ixid=MnwxNDU4OXwwfDF8cmFuZG9tfHx8fHx8fHx8MTY0NjI2MTUzMQ&ixlib=rb-1.2.1&q=85");
    background-size: cover;
    margin-right: 15px;
  }

  .shoe-img-banner-center {
    width: 33%;
    background-image: url("https://images.unsplash.com/photo-1600269452121-4f2416e55c28?crop=entropy&cs=srgb&fm=jpg&ixid=MnwxNDU4OXwwfDF8cmFuZG9tfHx8fHx8fHx8MTY0NjI2MTY3MA&ixlib=rb-1.2.1&q=85");
    background-size: cover;
    margin-right: 15px;
  }

  .shoe-img-banner-right {
    width: 33%;
    background-image: url("https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?crop=entropy&cs=srgb&fm=jpg&ixid=MnwxNDU4OXwwfDF8cmFuZG9tfHx8fHx8fHx8MTY0NjI2MTY3MA&ixlib=rb-1.2.1&q=85");
    background-size: cover;
    margin-right: 15px;
  }

  .discover-nike-apps {
    display: flex;
    justify-content: space-around;
    align-contents: center;
  }

  .nike-app {
    width: 50%;
    max-width: 666px;
    height: 520px;
    background-image: url("https://static.nike.com/a/images/f_auto/dpr_2.0,cs_srgb/w_666,c_limit/6b68a809-e5fa-4228-85ef-e0db636ce083/nike-just-do-it.jpg");
    background-size: cover;
    background-position: center;
  }

  .nike-training-app {
    width: 50%;
    max-width: 666px;
    height: 520px;
    background-image: url("https://static.nike.com/a/images/f_auto/dpr_2.0,cs_srgb/w_666,c_limit/25ab408d-6697-4b17-a80f-47aeeaa6eb32/nike-just-do-it.jpg");
    background-size: cover;
    background-position: bottom;
  }

  .nike-app-description {
    font-size: 16px;
    color: white;
    position: relative;
    top: 370px;
    margin-left: 60px;
  }

  .learn-more-botton {
    width: 100px;
    height: 30px;
    background: white;
    border-radius: 20px;
    color: black;
    padding: 8px 7px 0px 7px;
    position: relative;
    margin-left: 57px;
    top: 395px;
  }

  .container-join-us {
    margin-top: 80px;
    /*   border: 1px solid red; */
  }

  .title-join-us {
    font-size: 24px;
    /*   font-weight: bold; */
    margin-left: 5px;
  }

  .wrapper {
    height: 300px;
    /*   border: 3px solid cyan; */
    margin-top: 15px;
    color: white;
    background-image: url("https://images.unsplash.com/photo-1520263115673-610416f52ab6?crop=entropy&cs=srgb&fm=jpg&ixid=MnwxNDU4OXwwfDF8cmFuZG9tfHx8fHx8fHx8MTY0NjY3NjcxMA&ixlib=rb-1.2.1&q=85");
    background-size: cover;
    background-position: bottom 80px;
  }

  .text-info {
    height: 200px;
    /*   border: 3px solid red; */
    width: 600px;
    position: relative;
    left: 60px;
    top: 60px;
    display: flex;
    flex-direction: column;
  }

  .nike-membership {
    font-size: 40px;
    font-weight: bold;
    letter-spacing: -1px;
  }

  .become-member {
    height: 20px;
    /*   border: 1px solid yellowgreen; */
    font-size: 18px;
    margin-top: 20px;
  }

  .join-us-alternative {
    background: white;
    color: black;
    padding: 5px 5px 0px 5px;
  }

  .wrapper-more-nike {
    /*   border; 3px solid red; */
    height: 620px;
  }

  .more-nike-title {
    height: 30px;
    /*   border: 1px solid orange; */
    font-size: 24px;
    margin-top: 60px;
  }

  .style-domain {
    display: flex;
    justify-content: space-between;
    /*   border: 3px solid cyan; */
    height: 560px;
    font-size: 24px;
    margin-top: 20px;
  }

  .domain-left {
    background-image: url("https://static.nike.com/a/images/f_auto/dpr_2.0,cs_srgb/w_435,c_limit/0bafb728-2ae2-416f-bb18-5935801c8071/nike-just-do-it.png");
    background-size: cover;
    background-position: right 55% bottom 45%;
    width: 33%;
  }

  .domain-center {
    background-image: url("https://static.nike.com/a/images/f_auto/dpr_2.0,cs_srgb/w_435,c_limit/2c8754ce-6287-4e77-a198-1ad483fba257/nike-just-do-it.png");
    background-size: 125%;
    background-size: cover;
    background-position: right 85% bottom 90%;
    width: 33%;
  }

  .domain-right {
    background-image: url("https://static.nike.com/a/images/f_auto/dpr_2.0,cs_srgb/w_435,c_limit/414db494-7ebc-4d53-bbff-58d50b380a24/nike-just-do-it.png");
    background-size: cover;
    background-position: right 35% bottom 45%;
    width: 33%;
  }

  .style-button {
    background: white;
    color: black;
    border: 3px solid white;
    padding: 6px 5px 0px 5px;
    position: relative;
    left: 60px;
    top: 75%;
  }

  .style-botton-women {
    padding: 6px 15px 0px 15px;
  }

  .container-merch-menu {
    margin-top: 100px;
  }

  .sub-container {
    width: auto;
    height: 200px;
    display: flex;
    justify-content: center;
    /*   border: 3px solid blue; */
  }

  .sub-container:hover {
    transition: 0.5s;
    height: 320px;
    /*   border: 3px solid green; */
  }

  .sub-cont-items {
    display: flex;
    flex-direction: column;
    overflow: hidden;
    /*     border: 3px solid orange; */
    list-style-type: none;
    font-size: 16px;
    color: grey;
    margin: 0px 10px;
  }

  .category {
    color: black;
    margin-bottom: 28px;
  }

  li {
    margin-bottom: 12px;
  }

  /* FOOTER */

  .footer {
    width: 100%;
    margin-top: 40px;
    border: 1px solid;
    background: #111111;
    height: 300px;
    color: white;
    font-size: 12px;
  }

  .footer-start {
    margin: 50px 10px 0px 10px;
    /*   border: 2px solid red; */
    display: flex;
    justify-content: space-between;
  }

  .footer-info-box {
    /*   border: 2px solid purple; */
    width: 10%;
  }

  .footer-icons {
    margin-left: 10px;
  }

  .footer-contact-social {
    display: flex;
    justify-content: flex-end;
    /*   border: 1px solid yellow; */
    width: 35%;
  }

  .footer-tags {
    margin-left: -40px;
    list-style-type: none;
    color: #6b6b6b;
  }

  .footer-item {
    color: #6b6b6b;
  }

  .footer-item:hover {
    color: white;
  }

  .footer-tags-alt-color {
    color: white;
  }

  .footer-end {
    /*   border: 3px solid green; */
    height: 60px;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
  }

  .footer-end-wrapper {
    /*   border: 1px solid white; */
    height: 30px;
    display: flex;
    justify-content: space-between;
  }

  .footer-end-sub-division {
    color: #6b6b6b;
    /*   border: 2px solid cyan; */
    display: flex;
    justify-content: space-between;
  }

  .footer-end-item {
    margin-right: 15px;
  }

  .footer-end-location {
    display: flex;
  }

  .footer-end-location-icon {
    order: -1;
    margin-right: 8px;
    position: relative;
    top: -3px;
  }

  .map-marker-alt {
    background: red;
    color: white;
  }

  .footer-end-alt-font-size {
    font-size: 10px;
  }

  body {
    margin: 0;
    min-width: 580px;
    width: 100%;
    margin-top: 150px;

  }



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

  .search-container {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    right: 50%;
    margin-top: 15px;
    background-color: #f5f5f5;
    border-radius: 15px 0 0 15px;
  }

  button[type="submit"] {
    background-color: transparent;
    border: none;
    cursor: pointer;
    margin-right: 10px;
  }

  button[type="submit"] img {
    width: 20px;
    height: 20px;
  }

  input[type="search"] {
    background-color: #f5f5f5;
    padding: 10px;
    border-radius: 5px;
    border: none;
    width: 100%;
    max-width: 300px;
  }
</style>