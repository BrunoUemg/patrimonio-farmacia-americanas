<?php 
include_once "conexao.php";

$idUnidade = $_GET['idUnidade'];

$delete_Unidade = "DELETE FROM unidade where idUnidade = '$idUnidade'";

if($con->query($delete_Unidade) === true){
echo "<script>alert('Excluido com sucesso!');window.location='../view/consultar_unidade.php'</script>";
}else{
    echo "<script>alert('Unidade possui relação com patrimônio!');window.location='../view/consultar_unidade.php'</script>";
}
exit;
?>