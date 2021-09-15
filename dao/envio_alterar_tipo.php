<?php 

include_once "conexao.php";

$idTipo = $con->escape_string($_POST['idTipo']);
$descricaoTipo = $con->escape_string($_POST['descricaoTipo']);


$SELECT_TIPO = "SELECT * FROM tipo where descricaoTipo = '$descricaoTipo'";
$res = $con->query($SELECT_TIPO);
$linha = $res->fetch_assoc();

if(isset($linha['descricaoTipo']) && $linha['idTipo'] != $idTipo){
    echo "<script>alert('Tipo com esse nome ja cadastrado!');window.location='../view/consultar_tipo_sub.php'</script>";
    exit;
}else{

    $con->query("UPDATE tipo set descricaoTipo = '$descricaoTipo' where idTipo = '$idTipo'");
    echo "<script>alert('Alterado com sucesso!');window.location='../view/consultar_tipo_sub.php'</script>";
    exit;
}

?>