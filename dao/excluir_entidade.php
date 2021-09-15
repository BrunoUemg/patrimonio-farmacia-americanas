<?php 
include_once "conexao.php";

$idEntidade = $_GET['idEntidade'];

$delete_entidade = "DELETE FROM entidade where idEntidade = '$idEntidade'";

if($con->query($delete_entidade) === true){
echo "<script>alert('Excluido com sucesso!');window.location='../view/consultar_entidade.php'</script>";
}else{
    echo "<script>alert('Entidade possui relação com patrimônio!');window.location='../view/consultar_sala.php'</script>";
}
exit;
?>