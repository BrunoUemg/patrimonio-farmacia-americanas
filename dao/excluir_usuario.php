<?php 
include_once "conexao.php";

$idUsuario = $_GET['idUsuario'];

$delete_Usuario = "DELETE FROM usuario where idUsuario = '$idUsuario'";

if($con->query($delete_Usuario) === true){
echo "<script>alert('Excluido com sucesso!');window.location='../view/consultar_usuario.php'</script>";
}else{
    echo "<script>alert('Usuario possui relação com patrimônio!');window.location='../view/consultar_usuario.php'</script>";
}
exit;
?>