<?php 
include_once "conexao.php";

$idTipo = $_GET['idTipo'];

$delete_tipo = "DELETE FROM tipo where idTipo = '$idTipo'";

if($con->query($delete_tipo) === true){
echo "<script>alert('Excluido com sucesso!');window.location='../view/consultar_tipo_sub.php'</script>";
}else{
    echo "<script>alert('Tipo possui relação com patrimônio!');window.location='../view/consultar_tipo_sub.php'</script>";
}
exit;
?>