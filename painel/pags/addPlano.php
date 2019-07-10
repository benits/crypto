<?php

include '../php/funcoes.php';
include '../php/constantes.php';
session_start();

$idCliente = $_GET["idUser"];
$idPlano = $_GET["idPlano"];
$idDel = $_GET["id"];

atribuiValoresDaSessao($idCliente);
atribuiValoresDaSessaoPlano($idPlano);

$idCliente = $_SESSION["idCliente"];
$idPlano = $_SESSION["idPlano"];
$nomeCliente = $_SESSION["nome"];
$nomePlano = $_SESSION["nome_plano"];
$valor = $_SESSION["valor"];

global $pdo;
try{
    $pdo = new PDO('mysql:dbname='.NOME_BD.';host='.HOSPEDEIRO_BD,USUARIO_BD,SENHA_BD);
}catch(PDOException $e){
    echo $e->getMessage();
}

if(isset($_POST['clientId']) && isset($_POST['plan'])){
   
    $clientId = addslashes($_POST['clientId']);
    $plan = addslashes($_POST['plan']);


    $sql = $pdo->query("SELECT * FROM clientes WHERE idCliente = $clientId");
    if($sql->rowCount() > 0){
        $sql = $sql->fetch();
    }else{
        echo 'Erro inesperado, cliente nao encontrado no banco de dados!';
    }


    $sql2 = $pdo->query("SELECT * FROM planos WHERE id_plano = $plan");
    if($sql2->rowCount() > 0){
        $sql2 = $sql2->fetch();
    }else{
        echo 'Erro inesperado, plano nao encontrado no banco de dados';
    }

    insereTabelaClientesAtivosPainel($clientId,$plan,$sql['nome'],$sql2['nome_plano'],$sql2['valor']);
}


insereTabelaClientesAtivosPainel($idCliente,$idPlano,$nomeCliente,$nomePlano,$valor);
deletaClientesPendentes($idDel);

function insereTabelaClientesAtivosPainel($idCliente,$idPlano,$nomeCliente,$nomePlano,$valor) {

    // Cria uma conexão:
    $conexao = mysqli_connect("".HOSPEDEIRO_BD.":".PORTA_BD."", USUARIO_BD, SENHA_BD, NOME_BD);
    // Verifica conexão:
    if (!$conexao) {
        // Falha na conexão:

        return false;
    } else {
        $datePlano = '';

        switch($idPlano){
            case 1:
                $datePlano = 31;
                break;

            case 2:
                $datePlano = 90;
                break;

            case 3:
                $datePlano = 182;
                break;
        };

        $duracao = date("Y-m-d H:i:s", strtotime("+".$datePlano."days"));
        $comandoSQL = $conexao->prepare('INSERT INTO clientes_ativos (id_cliente,id_plano,nome_cliente,nome_plano,valor,data_adesao,data_exclusao) VALUES (?, ?, ?, ?, ?,NOW(),?)');
        // Verifica o comando SQL:
        if (!$comandoSQL) {
            // Falha na criação do comando SQL:
            return false;
        }
        $comandoSQL->bind_param('ssssss', $idCliente,$idPlano,$nomeCliente,$nomePlano,$valor,$duracao);
        $comandoSQL->execute();
        $comandoSQL->close();
        mysqli_close($conexao);
        return true;
    }





}

function deletaClientesPendentes($idDel) {
    $conexao = mysqli_connect("".HOSPEDEIRO_BD.":".PORTA_BD."", USUARIO_BD, SENHA_BD, NOME_BD);
    // Verifica conexão:
    if (!$conexao) {
        // Falha na conexão:
        return false;
    } else {
        $comandoSQL = $conexao->prepare('DELETE FROM `clientes_pendentes` WHERE id = ?');
        if (!$comandoSQL) {
            return false;
        }
        $comandoSQL->bind_param('s', $idDel);
        $comandoSQL->execute();
        $comandoSQL->close();
        header("location: clientes-pendentes.php?statusUPDT=success");
        return true;
    }
}