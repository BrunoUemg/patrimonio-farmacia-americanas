<?php 

include_once "sidebar.php";

?>

<div class="main-content">
              <div class="panel-row">
                  <button class="btn-panel" type="button" onclick="window.location.href = 'cadastrar_sala.php'">Cadastrar Sala</button>
                  <button class="btn-panel" onclick="window.location.href = 'consultar_sala.php'">Visualizar Sala</button>
              </div>
              <div class="panel-row">
                  <?php if($_SESSION['acesso'] == 1){ ?>
                  <button class="btn-panel" type="button" onclick="window.location.href = 'cadastrar_termo.php'">Inserir Termo</button>
                  <button class="btn-panel" type="button" onclick="window.location.href = 'relatorio_termos.php'">Relátorio de termos</button>
                 
              </div>
              <?php } ?>
              <div class="painel-acoes" >
                <div class="alert alert-success" role="alert">
                    Gerenciar Sala
                   </div>
              </div>
            </div>
        </main>
    </div>