<?php
include './../php/funcoes.php';
include './../php/constantes.php';
session_start();

$idDel = $_GET["del"];
$idDelUser = $_GET["delUser"];

deletaClientesAtivos($idDel);
deletaUsuario($idDelUser);

function deletaClientesAtivos($idDel) {
    $conexao = mysqli_connect("".HOSPEDEIRO_BD.":".PORTA_BD."", USUARIO_BD, SENHA_BD, NOME_BD);
    // Verifica conexão:
    if (!$conexao) {
        // Falha na conexão:
        return false;
    } else {
        $comandoSQL = $conexao->prepare('DELETE FROM `clientes_ativos` WHERE id = ?');
        if (!$comandoSQL) {
            return false;
        }
        $comandoSQL->bind_param('s', $idDel);
        $comandoSQL->execute();
        $comandoSQL->close();
        header("location: clientes-ativos.php?statusDel=success");

        return true;
    }
}

function deletaUsuario($idDelUser) {
    $conexao = mysqli_connect("".HOSPEDEIRO_BD.":".PORTA_BD."", USUARIO_BD, SENHA_BD, NOME_BD);
    // Verifica conexão:
    if (!$conexao) {
        // Falha na conexão:
        return false;
    } else {
        $comandoSQL = $conexao->prepare('DELETE FROM `clientes` WHERE idCliente = ?');
        if (!$comandoSQL) {
            return false;
        }
        $comandoSQL->bind_param('s', $idDelUser);
        $comandoSQL->execute();
        $comandoSQL->close();
        header("location: clientes-ativos.php?statusDel=success");

        return true;
    }
}