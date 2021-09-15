<?php 

include_once "conexao.php";
session_start();
$idResponsavel_patrimonio = $con->escape_string($_POST['idResponsavel_patrimonio']);
$nomeResponsavel = $con->escape_string($_POST['nomeResponsavel']);
$cpf = $con->escape_string($_POST['cpf']);
$rg = $con->escape_string($_POST['rg']);
$email = $con->escape_string($_POST['email']);
$telefoneContato = $con->escape_string($_POST['telefoneContato']);

$SELECT_RESPONSAVEL = "SELECT * FROM responsavel_patrimonio where cpf = '$cpf'";
$res = $con->query($SELECT_RESPONSAVEL);
$linha = $res->fetch_assoc();

if(isset($linha['cpf']) && $linha['idResponsavel_patrimonio'] != $idResponsavel_patrimonio){
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro: Esse CPF já foi cadastrado no sistema, tente novamente!</div>';
    header("Location: ../view/consultar_responsavel.php");
    exit();
}else{

    $con->query("UPDATE responsavel_patrimonio set nomeResponsavel = '$nomeResponsavel', cpf = '$cpf', rg = '$rg', 
    email = '$email', telefoneContato = '$telefoneContato' where idResponsavel_patrimonio = '$idResponsavel_patrimonio'");
    $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Alterado com sucesso!!</div>';
    header("Location: ../view/consultar_responsavel.php");
    exit();
}



?>