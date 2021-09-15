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
$senha = $linha_usuario['senha'];

$senha_validacao = $_POST['senha_validacao'];
$idSala = $_POST['idSala'];
$idEntidade = $_POST['idEntidade'];
$idUnidade = $_POST['idUnidade'];

if(password_verify($senha_validacao,$senha)){
    if(!empty($_POST['movimentar'])){
        $movi['movimentar'] = $_POST['movimentar']; 
        foreach($movi['movimentar'] as $idPatrimonio){
            $con->query("UPDATE patrimonio set idSala = '$idSala', idEntidade = '$idEntidade' where idPatrimonio = '$idPatrimonio'");

            $con->query("INSERT INTO historico_movimentacoes (dataAlteracao, horaAlteracao, acao, idUsuario, idPatrimonio, idSala, idEntidade, 
            idUnidade)VALUES('$data_hoje', '$hora', 'Movimentou o patrimônio', '$idUsuario', 
            '$idPatrimonio', '$idSala', '$idEntidade', '$idUnidade')");

           
        }
    }else{
        $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Nenhum patrimônio foi selecionado!</div>';
    echo "<script>window.location='../view/movimentacao_patrimonio.php'</script>";
    exit();
    }

}else{
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Senha invalida!</div>';
    echo "<script>window.location='../view/movimentacao_patrimonio.php'</script>";
    exit();
}

$_SESSION['msg'] = '<div class="alert alert-success" role="alert">Movimentação feita com sucesso!</div>';
echo "<script>window.location='../view/movimentacao_patrimonio.php'</script>";
exit();


?>