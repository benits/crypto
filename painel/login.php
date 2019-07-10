<?php
session_start();
include 'php/funcoes.php';
include 'php/constantes.php';
$mensagemGeral = "";
$msgSucessoCadastro = $email = "";
$msgErroEmail = $msgErroSenha = $msgErroLogin = $msgErroConexao = "";
$msgFimDeSessao = "";
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se 'email' foi enviado pelo POST:
    if (empty($_POST["email"])) {
        $msgErroEmail = "E-mail é requerido!";
    } else {
        $email = trataEntrada($_POST["email"]);
        if (!verificaSeEmailEValido($email)) {
            $msgErroEmail = "Formato de e-mail inválido!";
        }
    }
    // Verifica se 'senha' foi enviada pelo POST:
    if (empty($_POST["senha"])) {
        $msgErroSenha = "Digite a sua senha!";
    } else {
        $senha = trataEntrada($_POST["senha"]);

        if (!verificaSeSenhaEValida($senha)) {
            $msgErroLogin = "Falha ao tentar login, email e/ou senha inválidos!";
        }
    }
    if (($msgErroEmail == "") && ($msgErroSenha == "")) {

        $fezLogin = tentaIniciarUmaSessaoPainel($email, $senha);

        if ($fezLogin === true) {
            // Sucesso no login:
            mudaDePagina("index.php");
            exit();
        } else if ($fezLogin === false) {
            // Falha no login:
            $msgErroLogin = "Falha ao tentar login, email e/ou senha inválidos!";
        } else if ($fezLogin === null) {
            // Falha no login:
            $msgErroConexao = "Não foi possível conectar ao servidor, volte mais tarde!";
        }
    }
}
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Crypto vortex - empresa brasileira especializada em análise técnica de criptomoedas, que visa dar aos nossos clientes as melhores oportunidades que o mercado de criptomoedas oferece através dos *sinais de trade.">
  <meta name="author" content="Crypto vortex">
  <title>Painel de Controle - Crypto Vortex</title>
  <!-- Favicon -->
  <link href="../../../img/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="assets/css/argon.css?v=1.0.0" rel="stylesheet">
</head>

<body class="bg-gradient-blue">
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="" href="index.php">
          <img src="../../../img/logo.png" width="60"/>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                </button>
              </div>
            </div>
          </div>
          <!-- Navbar items -->

        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-blue py-6 py-lg-7">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-header bg-transparent pb-5">
                <div class="row justify-content-center text-md-center">
                    <h1 class="text-black-50">Painel de Controle</br>
                        Crypto Vortex</h1>
                </div>
              <div class="text-muted text-center mt-2 mb-3">Login</div>
            </div>
            <div class="card-body px-lg-5 py-lg-5">
                <form role="form"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">>
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" name="email" placeholder="E-mail" type="email" value="<?php echo $email;?>">
                  </div>
                    <?php verificaMsgECriaBalao($msgSucessoCadastro, "balaoMsg");?>
                    <?php verificaMsgECriaBalao($msgErroConexao, "balaoMsg erro");?>
                    <?php verificaMsgECriaBalao($msgErroEmail, "balaoMsg erro");?>
                    <?php verificaMsgECriaBalao($msgErroLogin, "balaoMsg erro");?>
                    <?php verificaMsgECriaBalao($msgFimDeSessao, "balaoMsg");?>
                    <?php verificaMsgECriaBalao($mensagemGeral, "balaoMsg");?>
                </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>
                            <input type="password" name="senha" class="form-control" placeholder="senha" required>
                        </div>
                        <?php verificaMsgECriaBalao($msgErroSenha, "balaoMsg erro");?>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary my-4" name="botaoEnviarDados" value="Entrar">Entrar</button>
                    </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-5">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">

      </div>
    </div>
  </footer>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.0.0"></script>
</body>

</html>