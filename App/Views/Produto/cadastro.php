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
                    <h2>Cadastro de Produto</h2>
                    <h4>Dados do Produto</h4>
                    <input id="nome" type="text" name="nome" placeholder="Nome" required="required" />
                    <input id="descricao" type="text" name="descricao" placeholder="Descrição" required="required" />
                    <input id="preco" type="number" name="preco" placeholder="Preço" required="required" />
                    <h4>Fotos</h4>
                    <h5>Principal: </h5>
                    <input id="img" type="file" accept=".png" name="foto" placeholder="Foto" required="required" />
                    <h5>Secundárias: </h5>
                    <input id="img1" type="file" accept=".png" name="foto" placeholder="Foto" required="required" />
                    <input id="img2" type="file" accept=".png" name="foto" placeholder="Foto" required="required" />
                    <input id="img3" type="file" accept=".png" name="foto" placeholder="Foto" required="required" />
                    <button id="btn-salvar-produto" class="salvar">Salvar</button>
                    <div class="nothing">
                        <p id="msg">Preencha todos os campos</p>
                    </div>
                    <div class="png">
                        <p id="msg">Preencha todos os campos com imagens png</p>
                    </div>
        
                </fieldset>
            </form>
        </section>
    </main>
</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="./js/cadastro.js"></script>
<link rel="stylesheet" href="./style/cadastroProduto.css">

</html>

<style>
 
</style>