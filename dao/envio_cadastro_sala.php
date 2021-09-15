<?php 

include_once "conexao.php";

$nomeSala = $con->escape_string($_POST['nomeSala']);
$idUnidade = $con->escape_string($_POST['idUnidade']);

if($nomeSala == null){
    echo "<script>alert('Erro!');window.location='../view/cadastrar_sala.php'</script>";
    exit;
}

$SELECT_SALA = $con->query("SELECT * FROM sala WHERE nomeSala = '$nomeSala' and idUnidade = '$idUnidade'");

if(mysqli_num_rows($SELECT_SALA) > 0){
	echo "<script>alert('Sala já cadastrada!');window.location='../view/cadastrar_sala.php'</script>";
exit();
}else{
      $con->query("INSERT INTO sala (nomeSala,idUnidade,inventario)VALUES('$nomeSala', '$idUnidade', 1)"); 
      echo "<script>alert('Sala cadastrada com sucesso!');window.location='../view/cadastrar_sala.php'</script>";  
}




?>