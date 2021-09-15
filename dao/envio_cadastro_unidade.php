<?php 

include_once "conexao.php";



$nomeUnidade = $con->escape_string($_POST['nomeUnidade']);
$idEntidade = $con->escape_string($_POST['idEntidade']);

if($nomeUnidade == null){
    echo "<script>alert('Erro!');window.location='../view/cadastrar_unidade.php'</script>";
    exit;
}

$SELECT_UNIDADE = $con->query("SELECT * FROM unidade WHERE nomeUnidade='$nomeUnidade' and idEntidade = '$idEntidade'");

if(mysqli_num_rows($SELECT_UNIDADE) > 0){
	echo "<script>alert('Unidade já cadastrada!');window.location='../view/cadastrar_unidade.php'</script>";
exit();
}else{
      $con->query("INSERT INTO unidade (nomeUnidade, idEntidade)VALUES('$nomeUnidade', '$idEntidade')"); 
      echo "<script>alert('Unidade cadastrada com sucesso!');window.location='../view/cadastrar_unidade.php'</script>";  
}

?>