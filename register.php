<?php
include 'php/funcoes.php';
include 'php/constantes.php';

// Variáveis:
$nome = $email = $senha = $confirmaSenha = $telefone = $endereco = $cpf = "";
$msgErroNome = $msgErroEmail = $msgErroSenha = $msgErroTelefone = $msgErroEndereco = "";

// Verifica se método POST foi chamado:
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verifica se 'nome' foi enviado pelo POST:
    if (empty($_POST["nome"])) {
        $msgErroNome = "Nome é requerido!";
    } else {
        $nome = trataEntrada($_POST["nome"]);

        if (!verificaSeNomeEValido($nome)) {
            $msgErroNome = "Nome deve conter apenas LETRAS e ESPAÇOS!";
        }
    }

    // Verifica se 'email' foi enviado pelo POST:
    if (empty($_POST["email"])) {
        $msgErroEmail = "E-mail é requerido!";
    } else {
        $email = trataEntrada($_POST["email"]);

        if (!verificaSeEmailEValido($email)) {
            $msgErroEmail = "Formato de e-mail inválido!";
        }

        $emailJaExiste = verificaSeEmailJaExiste($email);
        if ($emailJaExiste === true) {
            $msgErroEmail = "Este e-mail já foi cadastrado!";
        } else if ($emailJaExiste === null) {
            $msgErroNome = "Erro no servidor, tente novamente mais tarde!";
        }
    }

    // Verifica se 'senha' e 'confirmaSenha' foram enviadas pelo POST:
    if ((empty($_POST["senha"])) || (empty($_POST["confirmaSenha"]))) {
        $msgErroSenha = "Senhas são requeridas!";
    } else {
        $senha = trataEntrada($_POST["senha"]);
        $confirmaSenha = trataEntrada($_POST["confirmaSenha"]);

        // Verifica se ambas as senhas são iguais:
        if ($senha === $confirmaSenha) {
            if (!verificaSeSenhaEValida($senha)) {
                $msgErroSenha = "A senha deve ter no mínimo ".MIN_CHAR_SENHA." caracteres!";
            }
        } else {
            $msgErroSenha = "Ambas as senhas devem ser IDÊNTICAS!";
        }
    }

    $telefone = trataEntrada($_POST["telefone"]);
    if (!verificaSeTelefoneEValido($telefone)) {
        $msgErroTelefone = "Formato de telefone inválido!";
    }

    $endereco = trataEntrada($_POST["endereco"]);
    if (!verificaSeEnderecoEValido($endereco)) {
        $msgErroEndereco = "Número máximo de caracteres alcançado!";
    }
    $cpf = trataEntrada($_POST["cpfCliente"]);



    // Grava na base de dados:
    if (verificaSeFormularioEValido($msgErroNome, $msgErroEmail, $msgErroSenha, $msgErroTelefone, $msgErroEndereco)) {

        if (insereDadosEmCliente($nome, $email, $senha, $telefone, $endereco, $cpf)) {
          $fezLogin = tentaIniciarUmaSessao($email, $senha);
          if ($fezLogin === true) {
            // Sucesso no login:
            mudaDePagina("index.php?nome=$nome&email=$email");}
        } else {
            $msgErroNome = "Erro no servidor, tente mais tarde!";
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
  <title>Crypto Vortex - Registro</title>
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
      <script>	
      function HabiDsabi(){  
        if(document.getElementById('customCheckRegister').checked == true){ 	 
          document.getElementById('envia').disabled = ""  
          }  
          if(document.getElementById('customCheckRegister').checked == false){
             document.getElementById('envia').disabled = "disabled"  
             }	
             }
             </script>
      <div class="container pt-lg-md">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="card bg-secondary shadow border-0">
              <div class="card-header bg-white pb-5">
                <div class="text-muted text-center mb-3">
                  <small>inscreva-se com as suas credenciais</small>
                </div>
                <div class="text-center">
                </div>
              </div>
              <div class="card-body px-lg-5 py-lg-5">
                <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                  <div class="form-group">
                    <div class="input-group input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                      </div>
                      <input class="form-control" type="text" name="nome" placeholder="Nome Completo" value="<?php echo $nome;?>" maxlength="<?php echo MAX_CHAR_NOME;?>" required>
                    </div>
                    <?php verificaMsgECriaBalao($msgErroNome, "balaoMsg erro");?>
                  </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                            </div>
                            <input class="form-control" type="text" name="email" placeholder="E-mail" value="<?php echo $email;?>" maxlength="<?php echo MAX_CHAR_EMAIL;?>" required >
                        </div>
                        <?php verificaMsgECriaBalao($msgErroEmail, "balaoMsg erro");?>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>
                            <input style="max-width: 35%" type="password" name="senha" class="form-control" placeholder="Senha" maxlength="<?php echo MAX_CHAR_SENHA;?>" required>
                            <input style="margin-left: 5px" type="password" name="confirmaSenha" class="form-control" placeholder=" Confirme a senha" maxlength="<?php echo MAX_CHAR_SENHA;?>" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>
                        </div>
                        <?php verificaMsgECriaBalao($msgErroSenha, "balaoMsg erro");?>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                            </div>
                            <input type="text" name="telefone" id="telefone" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" class="form-control" value="<?php echo $telefone;?>" placeholder="" required>
                        </div>
                        <?php verificaMsgECriaBalao($msgErroTelefone, "balaoMsg erro");?>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-badge"></i></span>
                            </div>
                            <input type="text" oninput="mascara(this)" name="cpfCliente" class="form-control" value="" placeholder="CPF" maxlength="11" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
                            </div>
                            <input type="text" name="endereco" class="form-control" value="<?php echo $endereco;?>" placeholder="Cidade/Estado" maxlength="<?php echo MAX_CHAR_ENDERECO;?>">
                        </div>
                        <?php verificaMsgECriaBalao($msgErroEndereco, "balaoMsg erro");?>
                    </div>
                  <div class="row my-4">
                    <div class="col-12">
                      <div class="custom-control custom-control-alternative custom-checkbox">
                        <input name="habi" onClick="HabiDsabi()" class="custom-control-input" id="customCheckRegister" type="checkbox">
                        <label class="custom-control-label" for="customCheckRegister">
                          <span>Eu concordo com a 
                            <a href="#">Política de Privacidade</a>
                          </span>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-4" name="botaoEnviarDados" id="envia" value="Cadastrar" disabled>Criar Conta</button>
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
  <script>
      function mask(o, f) {
  setTimeout(function() {
    var v = mphone(o.value);
    if (v != o.value) {
      o.value = v;
    }
  }, 1);
}

function mphone(v) {
  var r = v.replace(/\D/g, "");
  r = r.replace(/^0/, "");
  if (r.length > 10) {
    r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
  } else if (r.length > 5) {
    r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
  } else if (r.length > 2) {
    r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
  } else {
    r = r.replace(/^(\d*)/, "($1)");
  }
  return r;
}
      
  </script>
    <script type="text/javascript">
    
        function mascara(i){

            var v = i.value;

            if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
                i.value = v.substring(0, v.length-1);
                return;
            }

            i.setAttribute("maxlength", "14");
            if (v.length == 3 || v.length == 7) i.value += ".";
            if (v.length == 11) i.value += "-";

        }
    </script>
</body>

</html>