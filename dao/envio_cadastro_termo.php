<?php 

include_once "conexao.php";
session_start();
$idResponsavel_patrimonio = $con->escape_string($_POST['idResponsavel_patrimonio']);
$idSala = $con->escape_string($_POST['idSala']);
$data = date("Y-m-d");

if($idResponsavel_patrimonio == null || $idSala == null){
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro: Falha ao cadastrar!</div>';
    header("Location: ../view/cadastrar_termo.php");
    exit();
}

if(!empty($_FILES["srcTermo"]["name"])){
    $pasta_arquivo = "../termo/";
    
  
    $formatos = array("png","jpeg","jpg","pdf","PNG","JPEG","JPG");
    $extensao = pathinfo($_FILES['srcTermo']['name'], PATHINFO_EXTENSION);
  
    if(in_array($extensao, $formatos)){
      $pasta = "../termo/";
      $temporario = $_FILES['srcTermo']['tmp_name'];
      $arquivo = uniqid().".".$extensao;
  
      if(move_uploaded_file($temporario, $pasta.$arquivo)){
        $sql = "INSERT INTO sala_has_responsavel (idResponsavel, idSala, srcTermo, data)VALUES('$idResponsavel_patrimonio', '$idSala', '$arquivo', '$data')"; 
        if($con->query($sql)=== true){ 
            $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Termo cadastrado com sucesso!</div>';
            header("Location: ../view/cadastrar_termo.php");
            exit();
        }else {
             echo "Erro para inserir: " . $con->error; }
        }else{
            $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro: Não foi possível enviar o arquivo!</div>';
            header("Location: ../view/cadastrar_termo.php");
            exit();
        } 
      }else{
        $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro: Extensão não reconhecida pelo sistema!</div>';
        header("Location: ../view/cadastrar_termo.php");
        exit();
      }
    }
   