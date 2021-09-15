<?php 

include_once "conexao.php";

$idUnidade = $con->escape_string($_POST['idUnidade']);
$nomeUnidade = $con->escape_string($_POST['nomeUnidade']);

$SELECT_UNIDADE = "SELECT * FROM unidade where nomeUnidade = '$nomeUnidade'";
$res = $con->query($SELECT_UNIDADE);
$linha = $res->fetch_assoc();

if(isset($linha['nomeUnidade']) && $linha['idUnidade'] != $idUnidade){
    echo "<script>alert('Unidade com esse nome ja cadastrada!');window.location='../view/consultar_unidade.php'</script>";
    exit;
}else{

    $con->query("UPDATE unidade set nomeUnidade = '$nomeUnidade' where idUnidade = '$idUnidade'");
    echo "<script>alert('Alterado com sucesso!');window.location='../view/consultar_unidade.php'</script>";
    exit;
}



?>