<?php
session_start();
include '../php/funcoes.php';
include '../php/constantes.php';

$link = mysqli_connect("".HOSPEDEIRO_BD.":".PORTA_BD."", USUARIO_BD, SENHA_BD, NOME_BD);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$query = "SELECT * FROM clientes";
$result = mysqli_query($link, $query);
$query2 = "SELECT * FROM planos";
$result2 = mysqli_query($link, $query2);


qtdeDeVendasMes();
qtdeDeUserMes();
qtdeDeUserAtivos();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Painel Administrativo - Crypto Vortex</title>
    <!-- Favicon -->
    <link href="./../assets/img/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="./../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="./../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link href="./../../css/style.css" rel="stylesheet" />
    <link type="text/css" href="./../assets/css/argon.css?v=1.0.0" rel="stylesheet">

</head>

<body>
    <!-- Sidenav -->
    <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
                aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->
            <a class="navbar-brand pt-0" href="../index.php">
                <img src="./../assets/img/icons/common/crypto-logo.svg" class="navbar-brand-img" alt="...">
            </a>
            <!-- User -->
            <ul class="nav align-items-center d-md-none">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                <img alt="Image placeholder" src="./../assets/img/theme/team-1-800x800.jpg">
                            </span>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Collapse header -->
                <div class="navbar-collapse-header d-md-none">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="../index.php">
                                <img src="./../assets/img/brand/blue.png">
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                                aria-label="Toggle sidenav">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Form -->
                <form class="mt-4 mb-3 d-md-none">
                    <div class="input-group input-group-rounded input-group-merge">
                        <input type="search" class="form-control form-control-rounded form-control-prepended"
                            placeholder="Search" aria-label="Search">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fa fa-search"></span>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Navigation -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">
                            <i class="ni ni-tv-2 text-primary"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./clientes-ativos.php">
                            <i class="ni ni-bullet-list-67 text-red"></i> Clientes Ativos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./clientes-pendentes.php">
                            <i class="ni ni-bullet-list-67 text-red"></i> Clientes Pendentes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./todos-clientes.php">
                            <i class="ni ni-bullet-list-67 text-red"></i> Todos Clientes
                        </a>
                    </li>
                    <!--  <li class="nav-item">
                         <a class="nav-link" href="./pags/planos.php">
                             <i class="ni ni-bullet-list-67 text-red"></i> Planos
                         </a>
                     </li>-->
                </ul>
                <!-- Divider -->
                <hr class="my-3">
                <!-- Heading -->
                <h6 class="navbar-heading text-muted">Configurações</h6>
                <!-- Navigation -->
                <ul class="navbar-nav mb-md-3">
                    <!--   <li class="nav-item">
                          <a class="nav-link" href="./pags/configurações.php">
                              <i class="ni ni-settings-gear-65"></i> Configurações
                          </a>
                      </li>-->
                    <li class="nav-item">
                         <a class="nav-link" href="./../../../index.php">
                              <i class="ni ni-button-power"></i> Voltar
                          </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="main-content">
        <!-- Top navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
            <div class="container-fluid">
                <!-- Brand -->
                <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="../index.php">Usuários</a>
                <!-- Form -->
                <!-- User -->
                <ul class="navbar-nav align-items-center d-none d-md-flex">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#">
                            <div class="media align-items-center">
                                <div class="media-body ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold"></span>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Header -->
        <div class="header bg-gradient-crypto pb-8 pt-5 pt-md-8">
            <div class="container-fluid">
                <div class="header-body">
                    <?php if (!empty($_GET["statusDel"])) {?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                            <span class="alert-inner--text"><strong>Sucesso!</strong> Usuário Deletado com Sucesso</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } else {?>
                    <?php };?>
                    <!-- Card stats -->
                    <div class="row">
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Tráfego</h5>
                                            <span class="h2 font-weight-bold mb-0">350</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                <i class="fas fa-chart-bar"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-nowrap">Acessos Hoje</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Novos Usuários</h5>
                                            <span class="h2 font-weight-bold mb-0"><?php echo $_SESSION['qtdeUserMes'];?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-nowrap">Este Mês</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Vendas</h5>
                                            <span class="h2 font-weight-bold mb-0"><?php echo $_SESSION['qtdeVendasMes'];?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                                <i class="fas fa-shopping-cart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-nowrap">Este Mês</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Usuarios Ativos</h5>
                                            <span class="h2 font-weight-bold mb-0"><?php echo $_SESSION['qtdeUserAtivos'];?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-nowrap">Total</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--7">
            <!-- Table -->
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <h3 class="mb-0">Usuários</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Telefone</th>
                                    <th scope="col">CPF</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
                                $row['nome'];
                                $email = $row['email'];
                                $telefone = $row['telefone'];
                                $endereco = $row['endereco'];
                                $cpf_cliente = $row['cpf_cliente'];

                                ?>
                                <tr>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="mb-0 text-sm"><?php echo $row['nome']?></span>
                                            </div>
                                        </div>
                                    </th>
                                    <td>
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="mb-0 text-sm"><?php echo $row['email']?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                          <span class="badge badge-dot mr-4">
                                            <?php echo $row['telefone'] ?>
                                          </span>
                                    </td>
                                    <td>
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <small><?php echo $row['cpf_cliente']?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div id='menu0001' class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item"><small>Ações</small></a>
                                                <a class="dropdown-item" href="delete.php?delUser=<?= $row['idCliente'];?>">
                                                    Excluir Usuario</a>
                                                    <!-- data-target="#modalADDPlano" -->

                                                <a class="dropdown-item" href="" data-id="<?php echo $row['idCliente'];?>" data-toggle="modal">
                                                    Adicionar Plano</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade"  id="modalADDPlano" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Planos</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">Plano</th>
                                                    <th scope="col">Valor</th>
                                                    <th scope="col">Duração do Plano</th>
                                                    <th scope="col"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                while($row2 = mysqli_fetch_array($result2, MYSQLI_BOTH)){
                                                    ?>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="media align-items-center">
                                                                <div class="media-body">
                                                                    <span class="mb-0 text-sm"><?php echo $row2['nome_plano']?></span>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <td>
                                                            <div class="media align-items-center">
                                                                <div class="media-body">
                                                                    <span class="mb-0 text-sm"><?php echo $row2['valor']?></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="media align-items-center">
                                                                <div class="media-body ">
                                                                    <span class="text-sm"><?php echo $row2['duracao_meses']?></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <label class="custom-toggle">
                                                                <input id="planNumber<?php echo $row2['id_plano']?>" type="checkbox">
                                                                <span class="custom-toggle-slider rounded-circle"></span>
                                                            </label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button id="addUserPlan" type="button" class="btn btn-success" data-dismiss="modal">Confirmar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer py-4">
                            <nav aria-label="...">
                                <ul class="pagination justify-content-end mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">
                                            <i class="fas fa-angle-left"></i>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">
                                            <i class="fas fa-angle-right"></i>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="footer">
                <div class="row align-items-center justify-content-xl-between">
                    <div class="col-xl-6">
                        <div class="copyright text-center text-xl-left text-muted">
                            <p>
                                Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                                </script> <a href="https://cryptovortex.com.br" target="_blank">Crypto Vortex</a></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="./../assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="./../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Optional JS -->
    <script src="./../assets/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="./../assets/vendor/chart.js/dist/Chart.extension.js"></script>
    <!-- Argon JS -->
    <script src="./../assets/js/argon.js?v=1.0.0"></script>

    <script>
        $("#menu0001 a").on('click',function(){
            //Recuperado o id do cliente voce ira usar atraves do javascript para uma requisicao ajax
            var clientId = $(this).attr('data-id');
            var plan = 0;
            $("#modalADDPlano").modal("show");
            $(function(){
                $('#addUserPlan').on('click',function(){
                    // =====================================================
                    if($('#planNumber1').is(':checked')){
                        plan = 1;
                     }else if($('#planNumber2').is(':checked')){
                        plan = 2;
                     }else if($('#planNumber3').is(':checked')){
                        plan = 3;
                     }
                     // =====================================================
                     // ===================AJAX REQUEST======================

                     $.ajax({
                        url:'addPlano.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {clientId:clientId,plan:plan},
                        success: function(){

                        },
                        error: function(){

                        }
                     });

                     // ================END AJAX REQUEST=====================

                });
            });
            
        })
    </script>
</body>

</html>