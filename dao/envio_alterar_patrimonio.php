<?php 

include_once "conexao.php";

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
session_start();
$data_hoje = date("Y-m-d");
$hora = date("H:i:s");


$sql_usuario = "SELECT * FROM usuario where idUsuario = $_SESSION[idUsuario]";
$res = $con->query($sql_usuario);
$linha_usuario = $res->fetch_assoc();
$idUsuario = $linha_usuario['idUsuario'];
$nomeUsuario = $linha_usuario['nomeUsuario'];


$idPatrimonio = $con->escape_string($_POST['idPatrimonio']);
if(!empty($_POST['idSala'])){
    $idSala = $con->escape_string($_POST['idSala']);
    $idEntidade = $con->escape_string($_POST['idEntidade']);
    $idUnidade = $con->escape_string($_POST['idUnidade']);
    $idSalaAnterior = $con->escape_string($_POST['idSalaAnterior']);
    $idEntidadeAnterior = $con->escape_string($_POST['idEntidadeAnterior']);
    $idUnidadeAnterior = $con->escape_string($_POST['idUnidadeAnterior']);
   
    
    $con->query("UPDATE patrimonio set idSala = '$idSala' where idPatrimonio = '$idPatrimonio'");
    $con->query("INSERT INTO historico_movimentacoes (dataAlteracao, horaAlteracao, acao, idUsuario, idPatrimonio, idSala, idEntidade, 
    idUnidade,idSalaAnterior, idEntidadeAnterior, idUnidadeAnterior)VALUES('$data_hoje', '$hora', 'Movimentou', '$idUsuario', 
    '$idPatrimonio', '$idSala', '$idEntidade', '$idUnidade', '$idSalaAnterior', '$idEntidadeAnterior', '$idUnidadeAnterior')");
    echo "<script>alert('Movimentação feita com sucesso!');window.location='../view/consultar_patrimonio.php'</script>";
    exit;
}else{


$codigoPatrimonio = $con->escape_string($_POST['codigoPatrimonio']);
$descricaoPatrimonio = $con->escape_string($_POST['descricaoPatrimonio']);
$conservacao = $con->escape_string($_POST['conservacao']);
$idStatus = $con->escape_string($_POST['idStatus']);
$idSubtipo = $con->escape_string($_POST['idSubtipo']);
$notaFiscal = $con->escape_string($_POST['notaFiscal']);

$SELECT_PATRIMONIO = "SELECT * FROM patrimonio where codigoPatrimonio = '$codigoPatrimonio'";
$res = $con->query($SELECT_PATRIMONIO);
$linha = $res->fetch_assoc();

if(isset($linha['codigoPatrimonio']) && $linha['idPatrimonio'] != $idPatrimonio){
    echo "<script>alert('Patrimônio com esse nome ja cadastrado!');window.location='../view/consultar_patrimonio.php'</script>";
    exit;
}else{

    $con->query("UPDATE patrimonio set descricaoPatrimonio = '$descricaoPatrimonio', codigoPatrimonio = '$codigoPatrimonio', conservacao = '$conservacao',
    idStatus = '$idStatus', idSubtipo = '$idSubtipo', notaFiscal = '$notaFiscal' where idPatrimonio = '$idPatrimonio'");
    echo "<script>alert('Alterado com sucesso!');window.location='../view/consultar_patrimonio.php'</script>";
    exit;
}

}

?>