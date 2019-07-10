<?php
   date_default_timezone_set('America/Sao_Paulo');
    session_start();
    include '../php/funcoes.php';
    include '../php/constantes.php';
    include 'lib/configs.php';




    $idCliente = $_GET['idCliente'];
    atribuiValoresDaSessao($idCliente);

    $nome = $_SESSION['nome'];
	$sobrenome = $_SESSION['sobrenome'];
	$email = $_SESSION['email'];
	$telefone = $_SESSION['telefone'];
	$valor = $_SESSION['valor'];
    $senha = $_SESSION["senha"];
    $idPlano = $_SESSION["idPlano"];
    $nomePlano = $_SESSION['nome_plano'];





        $status = $_GET['collection_status'];
       

        switch($status){
            case "success":
                $textoStatus = "PAGAMENTO APROVADO";
                $classStatus = "alert alert-success";
                $mensagemStatus = "Pagamento confirmado! Aguarde a liberação do seu VIP!";
                sendMail($_SESSION['nome'], $_SESSION['sobrenome'], $_SESSION['email'],  $_SESSION['telefone'], $_SESSION['valor'], 'Aprovado');
                insereTabelaClientesAtivos($idCliente,$idPlano,$nome,$nomePlano,$valor);

                break;

            case "failure":
                $textoStatus = "PAGAMENTO RECUSADO";
                $classStatus = "alert alert-danger";
                $mensagemStatus = "Seu pagamento foi recusado. Não fique trite, tente outro método de pagamento.";
                break;

            case "pending":
                $textoStatus = "PAGAMENTO PENDENTE";
                $classStatus = "alert alert-warning";
                $mensagemStatus = "Pagamento pendente. Assim que for aprovado liberaremos seu VIP. Aguarde!";
                sendMail($_SESSION['nome'], $_SESSION['sobrenome'], $_SESSION['email'],  $_SESSION['telefone'], $_SESSION['valor'],'Pendente');
                insereTabelaClientesPendentes($idCliente,$idPlano,$nome,$nomePlano,$valor);
                break;

            case "null":
                $textoStatus = "PAGAMENTO CANCELADO";
                $classStatus = "alert alert-warning";
                $mensagemStatus = "Pagamento cancelado. Que pena que cancelou!";
                
                break;


        };

          $arrContextOptions=array(
           "ssl"=>array(
           "verify_peer"=>false,
           "verify_peer_name"=>false,
            ),
          );  
          
          $response = file_get_contents("https://api.telegram.org/bot638965820:AAHvKmcTbTYMxvlYLDzod-t4lCQ8QsNU0As/exportChatInviteLink?chat_id=-1001280116891", false, stream_context_create($arrContextOptions));

          //string json contendo os dados de um funcionário
          $json_str = $response;
 
          //faz o parsing na string, gerando um objeto PHP
          $obj = json_decode($json_str);
 
          $link = $obj->result;

          
          
          $arrContextOptionsseg=array(
            "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
             ),
           );  
           
           $response2 = file_get_contents("https://api.telegram.org/bot638965820:AAHvKmcTbTYMxvlYLDzod-t4lCQ8QsNU0As/exportChatInviteLink?chat_id=-1001458301416", false, stream_context_create($arrContextOptionsseg));
 
           //string json contendo os dados de um funcionário
           $json_str2 = $response2;
  
           //faz o parsing na string, gerando um objeto PHP
           $obj2 = json_decode($json_str2);
  
           $link2 = $obj2->result;
 
           



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
    <link type="text/css" rel="stylesheet" href="../css/froala_blocks.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../vendors/linericon/style.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/magnific-popup.css">
    <link rel="stylesheet" href="../vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="../vendors/animate-css/animate.css">
    <link rel="stylesheet" href="../vendors/flaticon/flaticon.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <!-- main css -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="../vendors/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Argon CSS -->

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../demo/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/style.css" />
    <link type="text/css" href="../css/argon.css" rel="stylesheet">
    <link type="text/css" href="../css/argon.css?v=1.0.1" rel="stylesheet">

    <title>Crypto Vortex</title>
</head>

<body>

    <div id="content-all">
        <div class="card" style="width: 600px; margin: auto; margin-top: 90px">

            <div class="card-body" <div class="row">
                <div class="col-sm" align="center">
                    <h4><?php echo titulo_site;?> | STATUS</h4>
                    <hr>
                    <div><?php echo $textoStatus;?></div>
                    <hr>
                    <div class='<?php echo $classStatus;?>'><?php echo $mensagemStatus;?></div>
                    <?php if($status == "success") { ?>
                    <small>Clique nos botões abaixo para entrar nos nossos grupos VIP's</small>

                    <div class=" align-items-center" style="margin: auto;min-height: 65px;">
                        <button onClick="window.open('<?php echo $link; ?>','_blank')"
                            class="btn primary_btn btn-outline-primary" target="_blank" data-toggle="tooltip"
                            title="Entre no nosso Grupo VIP">Grupo Telegram VIP</button>
                        <button onClick="window.open('<?php echo $link2; ?>','_blank')"
                            class="btn primary_btn btn-outline-primary" style="margin-left: 15px;" target="_blank"
                            data-toggle="tooltip" title="Entre no nosso Canal VIP">Canal Telegram VIP</button>
                    </div>
                    <?php } else {?>
                    <?php }?>
                    <p align="right"><a href="" class="btn btn-outline-primary btn-lg">Voltar ao inicio</a></p>
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