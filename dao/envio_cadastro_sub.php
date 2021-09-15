<?php 

include_once "conexao.php";

$descricaoSubtipo = $con->escape_string($_POST['descricaoSubtipo']);
$idTipo = $con->escape_string($_POST['idTipo']);

if($descricaoSubtipo == null){
    echo "<script>alert('Erro!');window.location='../view/cadastrar_tipo_sub.php'</script>";
    exit;
}

$SELECT_SUB = $con->query("SELECT * FROM subtipo WHERE descricaoSubtipo = '$descricaoSubtipo' and idtipo = '$idTipo'");

if(mysqli_num_rows($SELECT_SUB) > 0){
	echo "<script>alert('Subtipo já cadastrado!');window.location='../view/cadastrar_tipo_sub.php'</script>";
exit();
}else{
      $con->query("INSERT INTO subtipo (descricaoSubtipo,idTipo)VALUES('$descricaoSubtipo', '$idTipo')"); 
      echo "<script>window.location='../view/cadastrar_tipo_sub.php'</script>";  
}




?>