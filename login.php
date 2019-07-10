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

			$fezLogin = tentaIniciarUmaSessao($email, $senha);

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
  <meta name="description" content="Start your development with a Design System for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Crypto Vortex - Login</title>
  <!-- Favicon -->
  <link href="img/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="vendors/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="css/argon.css?v=1.0.1" rel="stylesheet"> 
</head>

<body>
  <header class="header-global">

  </header>
  <main>
    <section class="section section-shaped section-lg">
      <div class="shape shape-style-1 bg-gradient-default">

      </div>
      <div class="container pt-lg-md">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="card bg-secondary shadow border-0">
                <div class="text-muted text-center mb-3">
                    <small>Crypto Vortex</small>
                </div>
              <div class="card-header bg-white pb-5">
                <div class="text-muted text-center mb-3">

                </div>
                <div class="btn-wrapper text-center">
                    <img src="img/logocrp.png" height="120">
                </div>
              </div>
              <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted mb-4">
                  <small>Entre com suas credenciais</small>
                </div>
                <form role="form"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                  <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                      </div>
                      <input type="text" name="email" class="form-control" placeholder="E-mail" value="<?php echo $email;?>" required>
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
                  <div class="custom-control custom-control-alternative custom-checkbox">
                    <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                    <label class="custom-control-label" for=" customCheckLogin">
                      <span>Me Lembrar</span>
                    </label>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary my-4" name="botaoEnviarDados" value="Entrar">Entrar</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="row mt-3">
            <div class="col-6 text-left">
                <a href="index.php" class="text-light">
                  <small>Voltar</small>
                </a>
              </div>
              <div class="col-6 text-right">
                <a href="register.php" class="text-light">
                  <small>Criar Nova Conta</small>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <footer >

  </footer>
  <!-- Core -->
  <script src="vendors/jquery/jquery.min.js"></script>
  <script src="vendors/popper/popper.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.min.js"></script>
  <script src="vendors/headroom/headroom.min.js"></script>
  <!-- Argon JS -->
  <script src="js/argon.js?v=1.0.1"></script>
</body>

</html>