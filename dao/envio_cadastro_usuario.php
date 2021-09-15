<?php 

include_once "conexao.php";



$nomeUsuario = $con->escape_string($_POST['nomeUsuario']);
$userAcesso = $con->escape_string($_POST['userAcesso']);
$idEntidade = $con->escape_string($_POST['idEntidade']);

$senha_segura = password_hash($userAcesso, PASSWORD_DEFAULT);

if($userAcesso == null){
    echo "<script>alert('Erro!');window.location='../view/cadastrar_usuario.php'</script>";
    exit;
}

$SELECT_USUARIO = $con->query("SELECT * FROM usuario WHERE userAcesso='$userAcesso'");

if(mysqli_num_rows($SELECT_USUARIO) > 0){
	echo "<script>alert('Usuário já cadastrado!');window.location='../view/cadastrar_usuario.php'</script>";
exit();
}else{
      $con->query("INSERT INTO usuario (nomeUsuario, userAcesso, senha, acesso, idEntidade)VALUES('$nomeUsuario', '$userAcesso', '$senha_segura', 2, '$idEntidade')"); 
      echo "<script>alert('Usuário cadastrada com sucesso!');window.location='../view/cadastrar_usuario.php'</script>";  
}

?>