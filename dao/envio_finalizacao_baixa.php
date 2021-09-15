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
$senha_db = $linha_usuario['senha'];

$senha_validacao = $_POST['senha_validacao'];
$check = $_POST['check'];
$idPatrimonio = $_POST['idPatrimonio'];


$result_patrimonio = "SELECT * FROM patrimonio where idPatrimonio = $idPatrimonio";
$res = $con->query($result_patrimonio);
$linha = $res->fetch_assoc();

$result_patrimonio = "SELECT * FROM unidade where idEntidade = $linha[idEntidade]";
$res = $con->query($result_patrimonio);
$linha2 = $res->fetch_assoc();

if(empty($check) || empty($idPatrimonio)){
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Não foi possível finalizar</div>';
    header("Location: ../view/patrimonio_baixado_pendente.php");
  exit; 
}

if(password_verify($senha_validacao,$senha_db)){

    $con->query("INSERT INTO patrimonio_baixado (idPatrimonio)VALUES('$idPatrimonio')");

    $con->query("INSERT INTO historico_movimentacoes (dataAlteracao, horaAlteracao, acao, idUsuario, idPatrimonio, idSala, idEntidade, 
    idUnidade)VALUES('$data_hoje', '$hora', 'Patrimônio em baixa finalizado', '$linha_usuario[idUsuario]', 
    '$idPatrimonio', '$linha[idSala]', '$linha[idEntidade]', '$linha2[idUnidade]')");

    if(!empty($_FILES["comprovanteBaixa"]["name"])){
    $pasta_arquivo = "../nota_fiscal/";
    
  
    $formatos = array("png","jpeg","jpg","pdf","PNG","JPEG","JPG");
    $extensao = pathinfo($_FILES['comprovanteBaixa']['name'], PATHINFO_EXTENSION);
  
    if(in_array($extensao, $formatos)){
      $pasta = "../comprovante_baixa/";
      $temporario = $_FILES['comprovanteBaixa']['tmp_name'];
      $arquivo = "comprovanteBaixa-".$idPatrimonio.".".$extensao;
  
      if(move_uploaded_file($temporario, $pasta.$arquivo)){
        $sql = "UPDATE patrimonio_baixado SET comprovanteBaixa = '$arquivo' where idPatrimonio = '$idPatrimonio'"; 
      }
    }
    if($con->query($sql)=== true){ 
     
    } else {
         echo "Erro para inserir: " . $con->error; }
  }

    $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Finalizado com sucesso</div>';
    header("Location: ../view/patrimonio_baixado_pendente.php");
    exit; 

}else{
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Senha incorreta!</div>';
    header("Location: ../view/patrimonio_baixado_pendente.php");
  exit; 
}



?>