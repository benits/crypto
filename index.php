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

        terminaSessao();
        $msgFimDeSessao = "Sessão finalizada com sucesso!";
    }
}

    if (!isset($_SESSION["nome"])) {

} else {
        obtemNomePlano($_SESSION["idCliente"]);
    };


$arrContextOptions = array(
    "ssl" => array(
        "verify_peer" => false,
        "verify_peer_name" => false,
    ),
);

$idCliente = obtemIdDoCliente($_SESSION["email"]);
atribuiValoresDaSessao($idCliente);


?>
<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/favicon.png" type="image/png">
    <title>Crypto Vortex</title>
    <!-- CSS Files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link type="text/css" rel="stylesheet" href="css/froala_blocks.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="vendors/linericon/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="vendors/animate-css/animate.css">
    <link rel="stylesheet" href="vendors/flaticon/flaticon.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="vendors/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="css/argon.css?v=1.0.1" rel="stylesheet">
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="demo/demo.css" rel="stylesheet" />
</head>

<body>
    <!--================Header Menu Area =================-->
    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-xl navbar-light">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="index.html"><img src="img/logo.png" alt="logo"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav justify-content-center">
                            <li class="nav-item"><a class="nav-link page-scroll" href="#home">HOME</a></li>
                            <li class="nav-item"><a class="nav-link page-scroll" href="#sobre">SOBRE</a></li>
                            <li class="nav-item"><a class="nav-link page-scroll" href="#resultados">RESULTADOS</a></li>
                            <li class="nav-item"><a class="nav-link page-scroll" href="#planos">PLANOS</a></li>
                            <li class="nav-item"><a class="nav-link page-scroll" href="#depoimentos">DEPOIMENTOS</a>
                            </li>
                            <li class="nav-item"><a class="nav-link page-scroll" href="#contato">CONTATO</a></li>

                        </ul>
                        <?php if (!isset($_SESSION["nome"])): ?>
                        <ul class="nav navbar-nav menu_nav justify-content-center">
                            <li class="nav-item">
                                <a href="login.php" class="nav-link" role="button" style="line-height: 40px;"
                                    aria-haspopup="true"><i class="fa fa-user"></i> CONTA</a></li>
                            <li class="nav-item" style="line-height: 40px;"><a href="#" data-toggle="modal"
                                    data-target="#modal-notification" class="primary_btn">PLATAFORMA</a></li>
                        </ul>
                        <?php else: ?>
                        <ul class="nav navbar-nav menu_nav justify-content-center">
                            <?php if (!isset($_SESSION["nomePlano"])):?>
                            <li class="nav-item" style="margin-left: 15px !important;"><a class="nav-link"
                                    href="#planos" style="color: #c10fff">Nenhum Plano</a></li>
                            <?php else: ?>
                            <li class="nav-item" style="margin-left: 15px !important;"><a class="nav-link page-scroll"
                                    style="color: #f838ff;"><?php echo ($_SESSION["nomePlano"]); ?></a></li>
                            <?php endif; ?>
                            <li class="nav-item" style="margin-left: 15px !important;"><a class="nav-link page-scroll"
                                    href=""><i class="ni ni-circle-08" style="font-size: 2em;"></i></a></li>
                            <?php if ($_SESSION["admin"] == 0) :?>
                            <li class="nav-item"><a class="nav-link page-scroll"
                                    href=""><?php echo obtemPrimeiraPalavra($_SESSION["nome"])."!"; ?></a></li>
                            <?php else: ?>
                            <li class="nav-item submenu dropdown">
                                <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <?php echo obtemPrimeiraPalavra($_SESSION["nome"])."!"; ?></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="./painel/index.php">Painel Admin</a>
                                </ul>
                            </li>
                            <?php endif;?>

                            <?php $link = 'index.php?finalizaSessao=1';?>
                            <li class="nav-item"><a class="nav-link page-scroll" href="<?php echo $link;?>"><i
                                        class="ni ni-button-power" style="font-size: 1.7em;"></i></a></li>
                            <li class="nav-item" style="margin-top:15px;margin-bottom:15px;"><a href="#"
                                    class="primary_btn">PLATAFORMA</a></li>
                        </ul>

                        <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!--================Header Menu Area =================-->
    <div class="col-md-4">
        <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification"
            aria-hidden="true">
            <div class="modal-dialog modal-success modal-dialog-centered modal-" role="document">
                <div class="modal-content bg-gradient-info">

                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-notification">Plataforma Crypto Vortex</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="py-3 text-center">
                            <i class="ni ni-bell-55 ni-3x"></i>
                            <h4 class="heading mt-4">Desculpe o Transtorno!</h4>
                            <p style="color: #fff">Ainda estamos desenvolvendo nossa plataforma.</p>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link text-white ml-auto"
                            data-dismiss="modal">Fechar</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--================Home Area =================-->
    <section class="home_banner_area" id="home">
        <div class="banner_inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="home_left_img">
                            <img class="img-fluid" src="img/banner/home-left.png" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="banner_content">
                            <h2 style="color: #FFFFFF">
                                Crypto Vortex Analytics
                            </h2>
                            <p>
                                Especialista em análise técnica de criptomoedas.</br>

                            </p>
                            <div class="d-flex align-items-center">
                                <p>
                                    Entre agora para a Crypto Vortex</br>
                                    Acesse nosso Grupo e Canal no Telegram
                                </p>
                            </div>
                            <div class="d-flex align-items-center">
                                <a href="https://t.me/crptvortex" class="primary_btn" target="_blank"
                                    data-toggle="tooltip" title="Entre no nosso Grupo Gratuito">Grupo Telegram</a></li>
                                <a href="https://t.me/crptvtx" class="primary_btn" style="margin-left: 15px;"
                                    target="_blank" data-toggle="tooltip" title="Entre no nosso Canal Gratuito">Canal
                                    Telegram</a></li>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Home Area =================-->
    <!--================Sobre Area =================-->
    <section class="about_us_area section_gap_top" id="sobre">
        <div class="container">
            <div class="row about_content align-items-center">
                <div class="col-lg-6">
                    <div class="section_content">
                        <h6>Sobre Nós</h6></br>
                        <p>Somos uma empresa brasileira especializada em análise técnica de criptomoedas,
                            que visa dar aos nossos clientes as melhores oportunidades que o mercado de criptomoedas
                            oferece através dos *sinais de trade.
                            Trabalhamos com um alto gerenciamento de riscos para garantir a segurança dos investimentos.
                            Contamos com uma equipe técnica especializada que atua no atendimento ao cliente oferecendo
                            suporte diário.</p>
                        <div class="card" style="background: transparent;">
                            <div class="card-header" style="background-color: #3b328b;color: #FFFFFF">Sinais de trade
                            </div>
                            <div class="card-body" style="text-align: left;">
                                <p>
                                    Os sinais de trade são análises elaboradas por um analista e indicam o
                                    momento correto de comprar e vender a moeda, as probabilidades de ganhos e riscos de
                                    perda.
                                    Nós enviamos sinais com paridade BITCOIN e DÓLAR

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about_us_image_box justify-content-center"
                        style="background-color: #FFFFFF;border-radius: 10px;">
                        <img class="img-fluid w-100" src="img/crypto.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="upcoming_games_area">
        <div class="container">
            <div class="row text-center mt-4">
                <div class="col-sm-4">
                    <div class="card border-none" style="min-height: 250px;">
                        <div class="card-block" style="margin: auto;">
                            <div class="mb-3">
                                <em class="ion-ios-checkmark-outline icon-lg text-primary"></em>
                            </div>
                            <h4>100% Seguro</h4>
                            <p class="text-muted" style="text-align: justify">
                                Analista profissional, sinais precisos e gerenciamento de riscos. Confiabilidade e
                                segurança nas informações.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card border-none" style="min-height: 250px;">
                        <div class="card-block" style="margin: auto;">
                            <div class="mb-3">
                                <em class="ion-ios-infinite icon-lg text-success"></em>
                            </div>
                            <h4>Planos Mensais</h4>
                            <p class="text-muted" style="text-align: justify">
                                Planos Mensais e Trimestrais, Contatando nossos planos Pró ou Avançado,
                                você tem acesso a nossa plataforma trading, grupo e canal vip no Telegram mais
                                suporte especializado.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card border-none" style="min-height: 250px;">
                        <div class="card-block" style="margin: auto;">
                            <div class="mb-3">
                                <em class="ion-ios-heart-outline icon-lg text-danger"></em>
                            </div>
                            <h4>Suporte ao Cliente</h4>
                            <p class="text-muted" style="text-align: justify">
                                Equipe de suporte ao cliente pronta para que você tire suas dúvidas em qualquer
                                dia da semana, suporte com acesso remoto e por voz nos canais de comunicação.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!--================Sobre Area =================-->
    <!--================Resultados Area ================-->
    <section class="section_gap testimonials_area " id="resultados">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main_title">
                        <h2>2019</h2>
                        <h1 style="color: #FFFFFF">Resultados</h1>
                    </div>
                </div>
            </div>
            <div class="panel-header panel-header-lg">
                <canvas id="bigDashboardChart"></canvas>
            </div>
        </div>
    </section>
    <!--================ Resultados Area ================-->


    <!--================ Start Preço Planos Area ================-->
    <section class="pricing_area section_gap" id="planos">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main_title">
                        <h2>Planos</h2>
                        <h1>Planos</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="pricing_item">
                        <h3 class="p_title">Básico</h3>
                        <h1 class="p_price">R$ 50,00</h1>
                        <div class="p_list">
                            <ul>
                                <li>1 Mês</li>
                                <li>Suporte 24H/7</li>
                            </ul>
                        </div>
                        <div class="p_btn">
                            <?php if (!isset($_SESSION["nome"])): ?>
                            <a class="gradient_btn" tabindex="0" role="button" data-toggle="popover"
                                data-trigger="focus" title="Faça Login"
                                data-content="Para efetuar a compra do plano é necessário estar logado!"><span>Comprar
                                    Agora</span></a>
                            <?php else: ?>
                            <a class="gradient_btn"
                                href="mp/checkout.php?idPlano=1&uid=<?php echo $_SESSION["idCliente"]; ?>"><span>Comprar
                                    Agora</span></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class=" col-lg-4 col-md-6">
                    <div class="pricing_item active">
                        <h3 class="p_title">Premium</h3>
                        <h1 class="p_price">R$ 140,00</h1>
                        <small style="color: #FFFFFF;">6.5% Desconto</small>
                        <div class="p_list">
                            <ul>
                                <li>3 Meses</li>
                                <li>Suporte 24H/7</li>
                            </ul>
                        </div>
                        <small style="color: #FFFFFF;">Recomendado</small>
                        <div class="p_btn">
                            <?php if (!isset($_SESSION["nome"])): ?>
                            <a class="gradient_btn" tabindex="0" role="button" data-toggle="popover"
                                data-trigger="focus" title="Faça Login"
                                data-content="Para efetuar a compra do plano é necessário estar logado!"><span>Comprar
                                    Agora</span></a>
                            <?php else: ?>
                            <a class="gradient_btn"
                                href="mp/checkout.php?idPlano=2&uid=<?php echo $_SESSION["idCliente"]; ?>"><span>Comprar
                                    Agora</span></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 hidden-md">
                    <div class="pricing_item">
                        <h3 class="p_title">Elite</h3>
                        <h1 class="p_price">R$ 510,00</h1>
                        <small style="color: #FFFFFF;">15% Desconto</small>
                        <div class="p_list">
                            <ul>
                                <li>1 ano</li>
                                <li>Suporte 24H</li>
                            </ul>
                        </div>
                        <div class="p_btn">
                            <?php if (!isset($_SESSION["nome"])): ?>
                            <a class="gradient_btn" tabindex="0" role="button" data-toggle="popover"
                                data-trigger="focus" title="Faça Login"
                                data-content="Para efetuar a compra do plano é necessário estar logado!"><span>Comprar
                                    Agora</span></a>
                            <?php else: ?>
                            <a class="gradient_btn"
                                href="mp/checkout.php?idPlano=3&uid=<?php echo $_SESSION["idCliente"]; ?>"><span>Comprar
                                    Agora</span></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Preço Planos Area ================-->

    <!--================ Depoimentos Area =================-->
    <section class="testimonials_area section_gap" id="depoimentos">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main_title">
                        <h2>Depoimentos</h2>
                        <h1 style="color: #FFFFFF">Depoimentos</h1>
                    </div>
                </div>
            </div>
            <div class="testi_slider owl-carousel">
                <div class="testi_item">
                    <img src="img/depo1.jpg" alt="">
                    <h4>Rodrigo Gaspar</h4>
                    <ul class="list">
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                    </ul>
                    <div class="wow fadeIn" data-wow-duration="1s">
                        <p>
                            O grupo de sinais VIP é excelente e a assertividade é incrível,
                            em poucas semanas no grupo pude aumentar de forma significativa a
                            quantidade dos meus BTC. Sem dúvidas recomendo o grupo de sinais
                            pra quem quer ter ganhos consistentes.
                        </p>
                    </div>
                </div>
                <div class="testi_item">
                    <img src="img/depo2.jpg" alt="">
                    <h4>Ricardo T.</h4>
                    <ul class="list">
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                    </ul>
                    <div class="wow fadeIn" data-wow-duration="1s">
                        <p>
                            Análises sólidas, suporte diferenciado. Uma ótima opção para quem
                            busca informações precisas de mercado
                        </p>
                    </div>
                </div>
                <div class="testi_item">
                    <img src="img/depo3.jpg" alt="">
                    <h4>Galberto Bruno Barros de Almeida</h4>
                    <ul class="list">
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                    </ul>
                    <div class="wow fadeIn" data-wow-duration="1s">
                        <p>
                            Feliz em participar de uma comunidade onde o trabalho sério e
                            responsável vem ajudando pessoas a melhorarem seus ganhos. Recomendo.
                        </p>
                    </div>
                </div>
                <div class="testi_item">
                    <img src="img/depo4.jpg" alt="">
                    <h4>Fernanda Flores</h4>
                    <ul class="list">
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                    </ul>
                    <div class="wow fadeIn" data-wow-duration="1s">
                        <p>
                            compartilho minha opinião sobre o grupo do Franciel.
                            Estou no grupo há um tempinho e posso te dizer que estou muito satisfeita
                            com o trabalho dele como analista. Os resultados falam por si só no
                            relatório que ele posta. Além disso, uma coisa extremamente importante na
                            minha opinião, e a atenção que ele dispensa aos usuários. Ele já me auxiliou
                            com o Bot, instância, tudo que eu solicitei fui prontamente respondida.
                            Sinceramente, fazer parte do grupo dele foi uma ótima escolha.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--================ End Depoimentos Area ================-->
    <!--================Contato Area =================-->
    <section class="fdb-block pt-0 contact_area section_gap" style="background-image: url(img/shapes/8.svg)"
        id="contato">
        <div class="container">
            <div class="row">
                <div class="container bg-r">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main_title">
                                <h2>Contato</h2>
                                <h1>Contato</h1>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-5">
                            <h2>Enviar e-mail</h2>
                            <p class="text-large">Serviços de suporte, vendas e gerenciamento de conta através do email
                                abaixo</p>

                            <p class="h3 mt-4 mt-lg-5">

                            </p>
                            <p>
                                Nosso suporte técnico está disponível por e-mail das 9h às 23h, de segunda a
                                sexta-feira.
                            </p>
                            <p class="h3 mt-4 mt-lg-5">
                                <strong>Questões gerais</strong>
                            </p>
                            <p>
                                <a href="mailto:cryptovortex@outlook.com.br"><i class="ni ni-email-83"
                                        style="font-size: 0.89em;"></i> cryptovortex@outlook.com.br</a>
                            </p>
                        </div>

                        <div class="col-12 col-md-6 ml-auto">
                            <h2>Deixe-nos uma mensagem</h2>
                            <form action="contact_process.php" method="post">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" name="nome" class="form-control" placeholder="Primeiro Nome">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="sobrenome" class="form-control"
                                            placeholder="Ultimo Nome">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col">
                                        <input type="email" name="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col">
                                        <input type="text" name="telefone" class="form-control" placeholder="Telefone">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="cidade" class="form-control"
                                            placeholder="Cidade / Pais">
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col">
                                        <select class="form-control" name="opcaoMotivo" required>
                                            <option value="">Selecione uma Opção</option>
                                            <option value="suporte">Suporte</option>
                                            <option value="venda">Venda</option>
                                            <option value="conta">Conta</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col">
                                        <textarea class="form-control" name="mensagem" rows="5"
                                            placeholder="Como podemos ajudar?"></textarea>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col">
                                        <button type="submit" class="primary_btn btn"><small>Enviar</small></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Contato Area =================-->

    <!--================Footer Area =================-->
    <footer class="footer_area section_gap_top">
        <div class="container">
            <div class="row single-footer-widget">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="copy_right_text">
                        <p>
                            Fundador - <a href="">Franciel Altoé</a>
                        </p></br>
                        <p>
                            Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                            </script> <a href="https://cryptovortex.com.br" target="_blank">Crypto Vortex</a> Todos os
                            direitos reservados Desenvolvido por <a href="https://benits.github.io/"
                                target="_blank">MeteorCode</a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="social_widget">
                        <a href="#" target="_blank" data-toggle="tooltip" title="Curta-nos no Facebook"><i
                                class="fa fa-facebook"></i></a>
                        <a href="#" target="_blank" data-toggle="tooltip" title="Siga-nos no Twitter"><i
                                class="fa fa-twitter"></i></a>
                        <!--	<a href="#" target="_blank" data-toggle="tooltip" title="Tire Suas Dúvidas no Whatsapp"><i class="fa fa-whatsapp"></i></a>-->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--================End Footer Area =================-->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/stellar.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
    <script src="vendors/isotope/isotope-min.js"></script>
    <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="vendors/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendors/counter-up/jquery.counterup.min.js"></script>
    <script src="js/mail-script.js"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="js/gmaps.min.js"></script>
    <script src="js/theme.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="js/gmaps.min.js"></script>
    <script src="js/theme.js"></script>
    <!-- Core -->
    <script src="vendors/jquery/jquery.min.js"></script>
    <script src="vendors/popper/popper.min.js"></script>
    <script src="vendors/headroom/headroom.min.js"></script>
    <!-- Argon JS -->
    <script src="js/argon.js?v=1.0.1"></script>
    <!-- Chart JS -->
    <script src="js/plugins/chartjs.min.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="js/now-ui-dashboard.min.js?v=1.3.0" type="text/javascript"></script>
    <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
    <script src="demo/demo.js"></script>
    <script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

    });
    </script>
</body>

</html>