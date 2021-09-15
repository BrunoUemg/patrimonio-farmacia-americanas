<?php 

include_once "sidebar.php";

?>

<div class="main-content">
              <div class="panel-row">
                  <button class="btn-panel" type="button" onclick="window.location.href = 'iniciar_inventario_patrimonio.php'">Iniciar inventário</button>
                  <button class="btn-panel" type="button" onclick="window.location.href = 'patrimonio_achado.php'">Patrimônio achado</button>
                  
                  
              </div>
              <?php if($_SESSION['acesso'] == 1){ ?>
              <div class="panel-row">
                  <button class="btn-panel" type="button" onclick="window.location.href = 'consultar_patrimonio_perdido.php'">Patrimônios perdidos </button>
         
              </div>
              <?php }?>
              <div class="painel-acoes" >
                <div class="alert alert-success" role="alert">
                    Gerenciar inventários
                   </div>
                  <ul>
                      <li>
                          Inventário é localizar os patrimônios fisicamente e dar baixa no sistema, para saber se estão na respectiva sala.
                      </li>
                      <li>
                          Fazer pelo menos a cada 3 meses.
                      </li>
                  </ul>
              </div>
            </div>
        </main>
    </div>