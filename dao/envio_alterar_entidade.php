<?php 

include_once "conexao.php";

$idEntidade = $con->escape_string($_POST['idEntidade']);
$nomeFantasia = $con->escape_string($_POST['nomeFantasia']);
$cnpj = $con->escape_string($_POST['cnpj']);
$contato = $con->escape_string($_POST['contato']);
$razaoSocial = $con->escape_string($_POST['razaoSocial']);

$SELECT_Entidade = "SELECT * FROM entidade where nomeFantasia = '$nomeFantasia'";
$res = $con->query($SELECT_Entidade);
$linha = $res->fetch_assoc();

if(isset($linha['nomeFantasia']) && $linha['idEntidade'] != $idEntidade){
    echo "<script>alert('Entidade com esse nome ja cadastrada!');window.location='../view/consultar_entidade.php'</script>";
    exit;
}else{

    $con->query("UPDATE entidade set nomeFantasia = '$nomeFantasia', razaoSocial = '$razaoSocial', 
    contato = '$contato', cnpj = '$cnpj' where idEntidade = '$idEntidade'");
    echo "<script>alert('Alterado com sucesso!');window.location='../view/consultar_entidade.php'</script>";
    exit;
}



?>