<?php
include_once "conexao.php";

$userAcesso = $_POST['userAcesso'];
$senha = $_POST['senha'];

if($userAcesso == null || $senha == null){
    session_start();
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Usuário ou senha inválido!</div>';
    header("Location: ../login.php");
    exit();
}

$result_usuario = "SELECT * FROM usuario where userAcesso = '$userAcesso'";
$res = $con->query($result_usuario);
$linha = $res->fetch_assoc();

$idUsuario = $linha['idUsuario'];
$nomeUsuario = $linha['nomeUsuario'];
$userAcesso_db = $linha['userAcesso'];
$senha_db = $linha['senha'];
$acesso = $linha['acesso'];
$idEntidade = $linha['idEntidade'];

if($userAcesso_db = $userAcesso && password_verify($senha,$senha_db) ){
    session_start();

    $_SESSION['nomeUsuario'] = $nomeUsuario;
    $_SESSION['idUsuario'] = $idUsuario;
    $_SESSION['acesso'] = $acesso;
    $_SESSION['idEntidade'] = $idEntidade;
    $_SESSION['patrimonio'] = true;
    header('location: ../index.php');

}else{
    session_start();
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Usuário ou senha inválido!</div>';
        header("Location: ../login.php");
        exit();
}








