<?php
session_start();
include '../php/funcoes.php';
include '../php/constantes.php';
$mensagemGeral = "";
$msgSucessoCadastro = $email = "";
$msgErroEmail = $msgErroSenha = $msgErroLogin = $msgErroConexao = "";
$msgFimDeSessao = "";

$pegaid = (int) $_GET['idPlano'];
$_SESSION['idPlano'] = $pegaid;

$uid = $_GET['uid'];
$_SESSION['idCliente'] = $uid;

if($pegaid === 1){
    atribuiValoresDaSessaoPlano(1);
}
if($pegaid === 2) {
    atribuiValoresDaSessaoPlano(2);
}
if($pegaid === 3){
    atribuiValoresDaSessaoPlano(3);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (!empty($_GET["mensagemGeral"])) {
        $mensagemGeral = trataEntrada($_GET["mensagemGeral"]);
    }

    if (!empty($_GET["msgErroConexao"])) {
        $_msgErroConexao = trataEntrada($_GET["msgErroConexao"]);
    }

    if (!empty($_GET["nome"])) {
        $nome = trataEntrada($_GET["nome"]);
        $primeiraPalavra = (explode(' ',trim($nome)))[0];
        $nome = $primeiraPalavra;
        if (!verificaSeNomeEValido($nome)) {
            $nome = "";
        } else {
            $msgSucessoCadastro = "Parabéns, $nome! Você já possui um cadastro!";
        }
    }
    if (!empty($_GET["email"])) {
        $email = trataEntrada($_GET["email"]);

        if (!verificaSeEmailEValido($email)) {
            $email = "";
        }
    }
    if (!empty($_GET["finalizaSessao"])) {
        session_start();
        terminaSessao();
        $msgFimDeSessao = "Sessão finalizada com sucesso!";
    }



}

?>
<!DOCTYPE html>
<html lang="pt-br">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Design System for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Crypto Vortex - Checkout de Pagamento</title>
    <!-- Favicon -->
    <link href="../img/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="../vendors/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="../css/argon.css?v=1.0.1" rel="stylesheet">

</head>

<body>
    <header class="header-global">
    </header>
    <main>
        <section class="section section-shaped section-lg">
            <div class="shape shape-style-1 bg-gradient-default">
            </div>
            <div class="container pt-lg-md">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="card bg-secondary shadow border-0" style="width: 1100px;">
                            <div class="text-muted text-center mb-3">
                                <small>Checkout de Pagamento - Mercado Pago</small>
                            </div>
                            <div class="card-header bg-white pb-5">
                                <div class="row col-xl-5" style="float: left">
                                    <div class="card-img" style="margin-left: 200px;margin-top: 40px;">
                                        <img src="../img/logo-mp_1.png">
                                    </div>
                                </div>
                                <div class="row col-sm-3" style="float: right">
                                    <div class="card">
                                        <div class="card-header">
                                            <small>Detalhes da Compra</small>

                                        </div>
                                        <div class="card-body">
                                            <div class="col-13 text-justify">
                                                <small>Nome Plano : <?php echo ($_SESSION["nome_plano"]);?></small></br>
                                                <small>Valor Plano : R$
                                                    <?php echo number_format($_SESSION["valor"], 2, ',', '.');?></small></br>
                                                <small>Duração do Plano :
                                                    <?php echo ($_SESSION["duracao_meses"]);?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-lg-5 py-lg-5">
                                <div class="text-muted text-center mb-3">
                                    <small>Confirme seus Dados</small>
                                </div>
                                <form role="form" action="pagamento.php?uid=<?php echo $uid;?>&Puid=<?php echo$pegaid ?>" method="post">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                            </div>
                                            <input class="form-control" type="text" name="nome" placeholder="Nome"
                                                value=" <?php echo obtemPrimeiraPalavra($_SESSION["nome"]); ?>"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                            </div>
                                            <input class="form-control" type="text" name="sobrenome"
                                                placeholder="Sobrenome" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                            </div>
                                            <input class="form-control" type="text" name="email"
                                                value=" <?php echo $_SESSION["email"];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="ni ni-mobile-button"></i></span>
                                            </div>
                                            <input class="form-control" type="text" name="telefone"
                                                value=" <?php echo $_SESSION["telefone"];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative mb-3" style="width: 300px">
                                            <div class="text-muted text-center mb-3"
                                                style="margin: auto; padding-left: 10px">
                                                <small>Valor Total: </small>
                                            </div>
                                            <div class="input-group-prepend" style="margin-left: 20px">
                                                <span class="input-group-text"><i class="ni ni-money-coins"></i></span>
                                                <span class="input-group-text"><small>R$</small></span>

                                            </div>
                                            <input type="text" name="valor" class="form-control"
                                                value=" <?php echo number_format($_SESSION["valor"], 2, ',', '.');?>"
                                                readonly />
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" value="Ir para pagamento"
                                            class="btn btn-outline-success btn-lg btn-block">Continuar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6 text-left">
                                <a href="../index.php" class="text-light">
                                    <small>Voltar</small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer>

    </footer>
    <!-- Core -->
    <script src="../vendors/jquery/jquery.min.js"></script>
    <script src="../vendors/popper/popper.min.js"></script>
    <script src="../vendors/bootstrap/bootstrap.min.js"></script>
    <script src="../vendors/headroom/headroom.min.js"></script>
    <!-- Argon JS -->
    <script src="../js/argon.js?v=1.0.1"></script>
</body>

</html>