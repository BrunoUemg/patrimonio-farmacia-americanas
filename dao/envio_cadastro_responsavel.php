<?php

include_once "conexao.php";
session_start();
$nomeResponsavel = $con->escape_string($_POST['nomeResponsavel']);
$cpf = $con->escape_string($_POST['cpf']);
$rg = $con->escape_string($_POST['rg']);
$telefoneContato = $con->escape_string($_POST['telefoneContato']);
$email = $con->escape_string($_POST['email']);

if($nomeResponsavel == null || $cpf == null){
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro: Falha ao cadastrar!</div>';
    header("Location: ../view/cadastrar_responsavel.php");
    exit();
}

$select_cpf = mysqli_query($con, "SELECT * FROM responsavel_patrimonio where cpf = '$cpf'");

if(mysqli_num_rows($select_cpf) > 0){
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Responsável ja cadastrado!</div>';
    header("Location: ../view/cadastrar_responsavel.php");
    exit();
}

    $con->query("INSERT INTO responsavel_patrimonio (nomeResponsavel, cpf, rg, telefoneContato, email)
    VALUES('$nomeResponsavel', '$cpf', '$rg', '$telefoneContato', '$email')");
    $_SESSION['msg'] = '<div class="alert alert-success" role="alert">'.$nomeResponsavel.' cadastrado como sucesso!</div>';
    echo "<script>window.location='../view/cadastrar_responsavel.php'</script>";  
    exit();
