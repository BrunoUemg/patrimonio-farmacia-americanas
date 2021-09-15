<?php 
include_once "conexao.php";

$idSala = $_GET['idSala'];

$delete_sala = "DELETE FROM sala where idSala = '$idSala'";

if($con->query($delete_sala) === true){
echo "<script>alert('Excluido com sucesso!');window.location='../view/consultar_sala.php'</script>";
}else{
    echo "<script>alert('Sala possui relação com patrimônio!');window.location='../view/consultar_sala.php'</script>";
}
exit;
?>