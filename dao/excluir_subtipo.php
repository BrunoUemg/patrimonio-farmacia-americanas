<?php 
include_once "conexao.php";

$idSubtipo = $_GET['idSubtipo'];

$delete_subtipo = "DELETE FROM subtipo where idSubtipo = '$idSubtipo'";

if($con->query($delete_subtipo) === true){
echo "<script>alert('Excluido com sucesso!');window.location='../view/consultar_tipo_sub.php'</script>";
}else{
    echo "<script>alert('Subtipo possui relação com patrimônio!');window.location='../view/consultar_tipo_sub.php'</script>";
}
exit;
?>