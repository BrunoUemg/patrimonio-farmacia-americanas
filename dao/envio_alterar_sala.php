<?php 

include_once "conexao.php";

$idSala = $con->escape_string($_POST['idSala']);
$nomeSala = $con->escape_string($_POST['nomeSala']);
$idUnidade = $con->escape_string($_POST['idUnidade']);

$SELECT_SALA = "SELECT * FROM sala where nomeSala = '$nomeSala'";
$res = $con->query($SELECT_SALA);
$linha = $res->fetch_assoc();

if(isset($linha['nomeSala']) && $linha['idSala'] != $idSala && $linha['idUnidade'] == $idUnidade){
    echo "<script>alert('Sala com esse nome ja cadastrada!');window.location='../view/consultar_sala.php'</script>";
    exit;
}else{

    $con->query("UPDATE sala set nomeSala = '$nomeSala', idUnidade = '$idUnidade' where idSala = '$idSala'");
    echo "<script>alert('Alterado com sucesso!');window.location='../view/consultar_sala.php'</script>";
    exit;
}

?>