<?php 

include_once "conexao.php";



$nomeFantasia = $con->escape_string($_POST['nomeFantasia']);
$razaoSocial = $con->escape_string($_POST['razaoSocial']);
$cnpj = $con->escape_string($_POST['cnpj']);
$contato = $con->escape_string($_POST['contato']);

if($nomeFantasia == null){
    echo "<script>alert('Erro!');window.location='../view/cadastrar_entidade.php'</script>";
    exit;
}

$SELECT_FANTASIA = $con->query("SELECT * FROM entidade WHERE nomeFantasia = '$nomeFantasia'");

if(mysqli_num_rows($SELECT_FANTASIA) > 0){
	echo "<script>alert('Entidade já cadastrada!');window.location='../view/cadastrar_entidade.php'</script>";
exit();
}else{
      $con->query("INSERT INTO entidade (nomeFantasia, razaoSocial, cnpj, contato)VALUES('$nomeFantasia', '$razaoSocial', '$cnpj', '$contato')"); 
      echo "<script>alert('Entidade cadastrada com sucesso!');window.location='../view/cadastrar_entidade.php'</script>";  
}

?>