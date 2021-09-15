<?php 

include_once "conexao.php";

$idSubtipo = $con->escape_string($_POST['idSubtipo']);
$descricaoSubtipo = $con->escape_string($_POST['descricaoSubtipo']);
$idTipo = $con->escape_string($_POST['idTipo']);

$SELECT_SUBTIPO = "SELECT * FROM subtipo where descricaoSubtipo = '$descricaoSubtipo'";
$res = $con->query($SELECT_SUBTIPO);
$linha = $res->fetch_assoc();

if(isset($linha['descricaoSubtipo']) && $linha['idSubtipo'] != $idSubtipo && $linha['idTipo'] == $idTipo){
    echo "<script>alert('Subtipo com esse nome ja cadastrado!');window.location='../view/consultar_tipo_sub.php'</script>";
    exit;
}else{

    $con->query("UPDATE subtipo set descricaoSubtipo = '$descricaoSubtipo', idTipo = '$idTipo' where idSubtipo = '$idSubtipo'");
    echo "<script>alert('Alterado com sucesso!');window.location='../view/consultar_tipo_sub.php'</script>";
    exit;
}

?>