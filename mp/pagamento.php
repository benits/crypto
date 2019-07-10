<?php
session_start();
    include("lib/mercadopago.php");
    include("lib/configs.php");
    include 'php/funcoes.php';
    include 'php/constantes.php';


    $_POST['nome'] = ( isset($_POST['nome']) ) ? $_POST['nome'] : null;
    $_POST['sobrenome']  = ( isset($_POST['sobrenome']) )  ? $_POST['sobrenome']  : null;
    $_POST['telefone']    = ( isset($_POST['telefone']) )    ? $_POST['telefone']    : null;
    $_POST['email'] = ( isset($_POST['email']) ) ? $_POST['email'] : null;
    $_POST['valor'] = ( isset($_POST['valor']) ) ? $_POST['valor'] : null;

    $idCliente = $_SESSION["idCliente"];
    $idPlano = $_SESSION["idPlano"];
    atribuiValoresDaSessao($idCliente);

    atribuiValoresDaSessaoPlano($idPlano);

    $_SESSION['nome'] = $_POST['nome'];
    $_SESSION['sobrenome'] = $_POST['sobrenome'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['telefone'] = $_POST['telefone'];
	$_SESSION['valor'] = $_POST['valor'];

	$valor = $_SESSION["valor"];
    
    $valor = $_SESSION["valor"];

    // No meu caso eu vou colocar o d so usuario como 1, pois se trata de um exemplo
    $id_user = $idCliente;
    //Vamos pegar a data para adicionar a fatura

    // Valor da fatura (valor do produto ou do carrinho total)
    $s = $_SESSION["valor"]; // Neste formato o mercado pago aceita

    function formata($y){
        $a = str_replace('.','',$y); //  1.000,00 => 1000,00
        $b = str_replace(',','.',$a); // 1000,00 => 1000.00 || 140,00 => 140.00
        return $b;
    }

    $valor = $s;

    //Vamos criar uma referencia  (essa ser� nossa referencia passada para o mercado pago)
    $ref = rand(1,9999).$id_user; // Ex: 53801
    define("ref_id", "$ref");
    //Status recebe Pendente
    $status = "Pendente";
    // Forma recebe MP
    $forma  = "Mercado Pago";

    $nome = $_SESSION["nome"];
    $email = $_SESSION["email"];
    $plano = $_SESSION["nome_plano"];

    insereDadosEmFatura($id_user, $idPlano, $email, $ref, $forma, $plano, $valor, $status);



	$mp = new MP(client_id, client_secret);
	$preference_data = array(
	"items" => array(
	  array(
	    "payer_email" => $_SESSION['email'],
	    "back_url" => url_site,
	      "title" => mb_convert_encoding("#FATURA ".titulo_site, "UTF-8", "auto"),
	      "currency_id" => "BRL",
	      "category_id" => "Serviços",
	      "quantity" => 1,
	      "unit_price" => floatval(number_format((float)str_replace(",",".",$_SESSION['valor']), 2, '.', '')
	    ))),

	      "payer" => array(
	      "name" => $_SESSION['nome'],
	      "surname" => $_SESSION['sobrenome'],
	      "email" => $_SESSION['email']
	 	 ),
          "back_urls" => array(
			"success" => url_site."/mp/status.php?idCliente=$idCliente&valor=$valor&idPlano=",
			"failure" => url_site."/mp/status.php?idCliente=$idCliente&valor=$valor&idPlano=",
			"pending" => url_site."/mp/status.php?idCliente=$idCliente&valor=$valor&idPlano="
		),

        "notification_url" => url_site."/mp/notifica.php",
        "external_reference" => ref_id
        
    );
	$preference = $mp->create_preference($preference_data);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link href="../img/favicon.png" rel="icon" type="image/png">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <base href="<?php echo url_site;?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css" />
    <link type="text/css" href="../css/argon.css" rel="stylesheet">

    <title><?php echo titulo_site;?></title>
</head>

<body>

    <div id="content-all">
        <div class="card" style="width: 600px; margin: auto; margin-top: 90px">
            <div class="card-header">

                <h4 align="center" style="margin: auto;">Pedido efetuado com sucesso!</h4><br>
            </div>
            <div class="card-body" <div class="row">
                <div class="col-sm-12">
                    <h5>Seus dados:</h5>
                    <hr>
                    <p>Nome: <b><?php echo $_SESSION['nome'];?> <?php echo $_SESSION['sobrenome'];?></b></p>
                    <p>Email: <b><?php echo $_SESSION['email'];?></b></p>
                    <p>Telefone: <b><?php echo $_SESSION['telefone'];?></b></p>
                    <p>Valor a pagar: <code>R$ <?php echo $_SESSION['valor'];?></code></p>
                </div>

            </div>
            <div class="card-footer">
                <div class="col-sm-10" style="margin: auto;">
                    <h5>Pagamento:</h5>
                    <hr>
                    <small class="text-success">Tudo certo, agora é só efetuar o pagamento</small>
                    <hr>
                    <a href="<?php echo $preference["response"]["init_point"];?>" name="MP-Checkout"
                        class="orange-ar-m-sq-arall">
                        <div class="text-center">
                            <button type="submit" value="Ir para pagamento"
                                class="btn btn-outline-success btn-lg btn-block">Continuar</button>
                        </div>
                    </a>
                    <hr>

                </div>
            </div>
        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="//resources.mlstatic.com/mptools/render.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>

</html>