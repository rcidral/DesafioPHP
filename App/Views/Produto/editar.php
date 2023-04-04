<html>

<body>

    <header>
        <div class="container">
            <div class="nav-bar">
                <div id="logo-id" class="nav-item nav-item-hidden nav-item-left">
                    <a href="/admin">
                        <img src="https://raw.githubusercontent.com/bystack/.github/main/bannerWB.png" alt="">
                    </a>
                    <a style="margin-right: 100%;" id="produtos-id" href="/admin" class="nav-link">
                        Voltar
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
                    <h2>Editar Produto</h2>
                    <h4>Dados do produto</h4>
                    <?php foreach($_SESSION['produtoListado'] as $produto) { ?>
                        <input id="id" type="hidden" name="id" value="<?= $produto->id ?>" />
                        <input id="nome" type="text" name="nome" placeholder="Nome" value="<?= $produto->nome ?>" />
                        <input id="descricao" type="text" name="descricao" placeholder="Descrição" value="<?= $produto->descricao ?>" />
                        <input id="preco" type="number" name="preco" placeholder="Preço" value="<?= $produto->preco ?>" />
                        <h4>Fotos</h4>
                        <h5>Principal: </h5>
                        <div class="img">
                            <img src="data:image/png;base64,<?= $produto->img ?>" alt="">
                            <input id="img" type="file" accept=".png" name="foto" placeholder="Foto" />
                        </div>
                        <h5>Secundárias: </h5>
                        <div class="img">
                            <img src="data:image/png;base64,<?= $produto->img1 ?>" alt="">
                            <input id="img1" type="file" name="foto1" placeholder="Foto"  />
                        </div>
                        <div class="img">
                            <img src="data:image/png;base64,<?= $produto->img2 ?>" alt="">
                            <input id="img2" type="file" name="foto2" placeholder="Foto"  />
                        </div>
                        <div class="img">
                            <img src="data:image/png;base64,<?= $produto->img3 ?>" alt="">
                            <input id="img3" type="file" name="foto3" placeholder="Foto"  />
                        </div>
                        <?php } ?>
                    <button id="btn-editar-produto" class="salvar">Salvar</button>
                    <div class="png">
                        <p id="msg">Preencha todos os campos com imagens png</p>
                    </div>
                </fieldset>
            </form>

        </section>
    </main>
</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="./js/editar.js"></script>
<link rel="stylesheet" href="./style/cadastroProduto.css">

</html>

<style>


    
</style>