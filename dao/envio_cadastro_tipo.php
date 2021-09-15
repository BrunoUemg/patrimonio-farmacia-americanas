<?php 

include_once "conexao.php";

$descricaoTipo = $con->escape_string($_POST['descricaoTipo']);

if($descricaoTipo == null){
    echo "<script>alert('Erro!');window.location='../view/cadastrar_tipo_sub.php'</script>";
    exit;
}

$SELECT_TIPO = $con->query("SELECT * FROM tipo WHERE descricaoTipo = '$descricaoTipo'");

if(mysqli_num_rows($SELECT_TIPO) > 0){
	echo "<script>alert('Tipo já cadastrado!');window.location='../view/cadastrar_tipo_sub.php'</script>";
exit();
}else{
      $con->query("INSERT INTO tipo (descricaoTipo)VALUES('$descricaoTipo')"); 
      echo "<script>window.location='../view/cadastrar_tipo_sub.php'</script>";  
}




?>