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

$cont = 0;
if(password_verify($senha_validacao,$senha)){
    if(!empty($_POST['inventario'])){
        $iven['inventario'] = $_POST['inventario']; 
        foreach($iven['inventario'] as $idPatrimonio){
            $con->query("UPDATE patrimonio set inventario = 0 where idPatrimonio = '$idPatrimonio'");

            
           
            $cont += 1;
           
        }
    }else{
        $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Todos patrimônios em sala, finalizado com sucesso!</div>';
    echo "<script>window.location='../view/iniciar_inventario_patrimonio.php'</script>";
    exit();
    }

}else{
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Senha invalida!</div>';
    echo "<script>window.location='../view/iniciar_inventario_patrimonio.php'</script>";
    exit();
}

$_SESSION['msg'] = '<div class="alert alert-primary" role="alert">'.$cont.' patrimônio(s) em falta nessa sala!</div>';
echo "<script>window.location='../view/iniciar_inventario_patrimonio.php'</script>";
exit();


?>