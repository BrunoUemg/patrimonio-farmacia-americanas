<?php 

include_once "conexao.php";
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
session_start();
$data_hoje = date("Y-m-d");
$hora = date("H:i:s");


$sql_usuario = "SELECT * FROM usuario where idUsuario = $_SESSION[idUsuario]";
$res = $con->query($sql_usuario);
$linha_usuario = $res->fetch_assoc();
$idUsuario = $linha_usuario['idUsuario'];
$nomeUsuario = $linha_usuario['nomeUsuario'];


$codigoPatrimonio = $con->escape_string($_POST['codigoPatrimonio']);
$descricaoPatrimonio = $con->escape_string($_POST['descricaoPatrimonio']);
$idSala = $con->escape_string($_POST['idSala']);
$conservacao = $con->escape_string($_POST['conservacao']);
$idStatus = $con->escape_string($_POST['idStatus']);
$idEntidade = $con->escape_string($_POST['idEntidade']);
$idUnidade = $con->escape_string($_POST['idUnidade']);
$idSubtipo = $con->escape_string($_POST['idSubtipo']);
$notaFiscal = $con->escape_string($_POST['notaFiscal']);

if($idSala == null || $idSubtipo == null || $idStatus == null || $conservacao == null || $descricaoPatrimonio == null){
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Não foi possível fazer o cadastro, campos em branco</div>';
		header("Location: ../view/cadastrar_patrimonio.php");
      exit; 
}

$SELECT_PATRIMONIO = $con->query("SELECT * FROM patrimonio WHERE codigoPatrimonio='$codigoPatrimonio'");

if(mysqli_num_rows($SELECT_PATRIMONIO) > 0){
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Patrimônio já cadastrado!</div>';
    header("Location: ../view/cadastrar_patrimonio.php");
exit();
}else{
      $con->query("INSERT INTO patrimonio (descricaoPatrimonio,codigoPatrimonio, idSala, conservacao, idStatus, idEntidade, notaFiscal, idSubtipo, inventario)
      VALUES('$descricaoPatrimonio','$codigoPatrimonio', '$idSala', '$conservacao','$idStatus', '$idEntidade', '$notaFiscal', '$idSubtipo', 1)"); 
      

      $query = mysqli_query($con, "SELECT Max(idPatrimonio)  AS codigo FROM patrimonio");
      $result = mysqli_fetch_array($query);
      
      $idPatrimonio = $result['codigo'];

      $con->query("INSERT INTO historico_movimentacoes (dataAlteracao, horaAlteracao, acao, idUsuario, idPatrimonio, idSala, idEntidade, 
      idUnidade)VALUES('$data_hoje', '$hora', 'Primeiro cadastro', '$idUsuario', 
      '$idPatrimonio', '$idSala', '$idEntidade', '$idUnidade')");

      

       if(!empty($_FILES["comprovanteFiscal"]["name"])){
        $pasta_arquivo = "../nota_fiscal/";
        
      
        $formatos = array("png","jpeg","jpg","pdf","PNG","JPEG","JPG");
        $extensao = pathinfo($_FILES['comprovanteFiscal']['name'], PATHINFO_EXTENSION);
      
        if(in_array($extensao, $formatos)){
          $pasta = "../nota_fiscal/";
          $temporario = $_FILES['comprovanteFiscal']['tmp_name'];
          $arquivo = "comprovanteFiscal-".$idPatrimonio.".".$extensao;
      
          if(move_uploaded_file($temporario, $pasta.$arquivo)){
            $sql = "UPDATE patrimonio SET comprovanteFiscal = '$arquivo' where idPatrimonio = '$idPatrimonio'"; 
          }
        }
        if($con->query($sql)=== true){ 
         
        } else {
             echo "Erro para inserir: " . $con->error; }
      }
       if(!empty($_FILES["fotoPatrimonio"]["name"])){
        $pasta_arquivo = "../nota_fiscal/";
        
      
        $formatos = array("png","jpeg","jpg","pdf","PNG","JPEG","JPG");
        $extensao = pathinfo($_FILES['fotoPatrimonio']['name'], PATHINFO_EXTENSION);
      
        if(in_array($extensao, $formatos)){
          $pasta = "../foto_patrimonio/";
          $temporario = $_FILES['fotoPatrimonio']['tmp_name'];
          $arquivo = "fotoPatrimonio-".$idPatrimonio.".".$extensao;
      
          if(move_uploaded_file($temporario, $pasta.$arquivo)){
            $sql = "UPDATE patrimonio SET fotoPatrimonio = '$arquivo' where idPatrimonio = '$idPatrimonio'"; 
          }
        }
        if($con->query($sql)=== true){ 
         
        } else {
             echo "Erro para inserir: " . $con->error; }
      }
      
      
      echo "<script>alert('Patrimônio cadastrado com sucesso!');window.location='../view/cadastrar_patrimonio.php'</script>";  
}

?>