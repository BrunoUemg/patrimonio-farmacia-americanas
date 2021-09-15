
<?php 

include_once "dao/conexao.php";
session_start();
if (isset($_SESSION['patrimonio'])) {
    //login ok!
} else {
    header('location: login.php');
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/americanas.png" type="image/x-icon"/>
    <title>Patrimônio</title>
    <link rel="stylesheet" href="assets/all.css">
    <!-- css boostrap -->
    <link href="assets/bootstrap.min.css" rel="stylesheet" >
    <!--<link rel="stylesheet" type="text/css" href="assets/dataTables.bootstrap4.min.css"> outro layout para o datatables-->
</head>
<body>
    <div class="flex-dashboard">
        <!--Barra lateral-->
        <sidebar id="sideBar">
          <div class="sidebar-title" onclick="window.location.href = 'index.php'">
              <img src="img/americanas.png" alt="">
              <h2 >Patrimônio</h2>
          </div>
          <!--Menu da barra lateral-->
         <?php if($_SESSION['acesso'] == 1){ ?>
          <div class="menu">
              <ul>
                <li onclick="window.location.href = 'view/gerenciar_patrimonio.php'">
                <i class="fas fa-chair"></i>
                    <a href="view/gerenciar_patrimonio.php"></i>Patrimônio</a>
                  </li>
                  <li onclick="window.location.href = 'view/gerenciar_entidade.php'">
                <i class="fas fa-university"></i>
                    <a href="view/gerenciar_entidade.php">Entidade</a>
                </li>
                  <li id="" onclick="window.location.href = 'view/gerenciar_unidade.php'">
                    <i class="far fa-building"></i>
                    <a href="view/gerenciar_unidade.php">Unidade</a>
                </li>
                <li onclick="window.location.href = 'view/gerenciar_sala.php'">
                <i class="fas fa-house-user"></i>
                    <a href="gerenciar_sala.php">Sala</a>
                </li>
                <li onclick="window.location.href = 'view/gerenciar_tipo_sub.php'"> 
                <i class="fas fa-tags"></i>
                    <a href="view/gerenciar_tipo_sub.php">Tipo e subtipo</a>
                </li>
                <li onclick="window.location.href = 'view/movimentacao_patrimonio.php'"> 
                <i class="fas fa-exchange-alt"></i>
                    <a href="view/movimentacao_patrimonio.php">Movimentar patrimônio</a>
                </li>
                <li onclick="window.location.href = 'view/gerenciar_relatorios.php'"> 
                <i class="fas fa-file-pdf"></i>
                    <a href="view/gerenciar_relatorios.php">Relatórios</a>
                </li>
                <li onclick="window.location.href = 'view/gerenciar_inventario.php'"> 
                <i class="fas fa-map-marked-alt"></i>
                    <a href="view/gerenciar_inventario.php">Iventários</a>
                </li>
                <li onclick="window.location.href = 'view/gerenciar_responsavel.php'"> 
                <i class="fas fa-user-tag"></i>
                    <a href="view/gerenciar_responsavel.php">Responsável</a>
                </li>

              
                <li onclick="window.location.href = 'view/gerenciar_usuario.php'">
                    <i class="fas fa-user"></i>
                    <a href="view/gerenciar_usuario.php">Usuário</a>
                </li>
                
             
              </ul>
          </div>
          <?php }?>
         <?php if($_SESSION['acesso'] == 2){ ?>
          <div class="menu">
              <ul>
                <li onclick="window.location.href = 'view/gerenciar_patrimonio.php'">
                <i class="fas fa-chair"></i>
                    <a href="view/gerenciar_patrimonio.php"></i>Patrimônio</a>
                  </li>
                  
                <li onclick="window.location.href = 'view/gerenciar_sala.php'">
                <i class="fas fa-house-user"></i>
                    <a href="gerenciar_sala.php">Sala</a>
                </li>
                <li onclick="window.location.href = 'view/gerenciar_tipo_sub.php'"> 
                <i class="fas fa-tags"></i>
                    <a href="view/gerenciar_tipo_sub.php">Tipo e subtipo</a>
                </li>
                <li onclick="window.location.href = 'view/movimentacao_patrimonio.php'"> 
                <i class="fas fa-exchange-alt"></i>
                    <a href="view/movimentacao_patrimonio.php">Movimentar patrimônio</a>
                </li>
                <li onclick="window.location.href = 'view/gerenciar_relatorios.php'"> 
                <i class="fas fa-file-pdf"></i>
                    <a href="view/gerenciar_relatorios.php">Relatórios</a>
                </li>
                <li onclick="window.location.href = 'view/gerenciar_inventario.php'"> 
                <i class="fas fa-map-marked-alt"></i>
                    <a href="view/gerenciar_inventario.php">Iventários</a>
                </li>

              
                <li onclick="window.location.href = 'view/gerenciar_usuario.php'">
                    <i class="fas fa-user"></i>
                    <a href="view/gerenciar_usuario.php">Usuário</a>
                </li>
                
             
              </ul>
          </div>
          <?php }?>
        </sidebar>
        <!--Todo conteudo da pagina-->
        <main id="mainContent">
            <!--Topo da pagina-->
            <header>
                <i id="iconMenu" onclick="responsiveSideBar()"  class="fas fa-bars"></i>
               <a  data-bs-toggle="modal" data-bs-target="#saida"><i class="fas fa-sign-out-alt"></i>Sair</a>
              
            </header>
                <!--Conteudo central da pagina-->
            <div class="main-content">
              <div class="panel-row">
                
              </div>
              <div class="painel-acoes">
              <!--ambiente onde fica as tabelas e formularios-->
              <div class="alert alert-success" role="alert">
               Seja bem vindo !
              </div>
                  </div>
            </div>
        </main>
    </div>

    <!--Modal de saida-->

    <div class="modal" tabindex="-1" id="saida">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Logout</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Deseja sair do sistema ?</p>
            </div>
            <div class="modal-footer">
              <button type="button" onclick="location.href='logout.php'" class="btn btn-danger">Sair</button>
            </div>
          </div>
        </div>
      </div>

<!--Jquery datatables-->
<script src="js/jquery-3.4.1.min.js"></script>  

<!-- script boostrap 5.0.1 -->
<script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
<!-- Fontawesome -->
<script src="https://kit.fontawesome.com/5b060b80da.js" crossorigin="anonymous"></script>

<!--Script datatables-->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script src="js/datatables.min.js"></script>
<!--Menu bars-->
<script src="js/menu.js"></script>
</body>
</html>