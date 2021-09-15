<?php 

include_once "sidebar.php";

?>

<div class="main-content">
              <div class="panel-row">
                  <button class="btn-panel" type="button" onclick="window.location.href = 'cadastrar_patrimonio.php'">Cadastrar Patrimônio</button>
                 
                  <button class="btn-panel" onclick="window.location.href = 'consultar_patrimonio.php'">Visualizar Patrimonio</button>
              </div>
              <div class="panel-row">
                  <button class="btn-panel" type="button" onclick="window.location.href = 'patrimonio_baixado_pendente.php'">Baixados pendentes</button>
                  <button class="btn-panel" type="button" onclick="window.location.href = 'consultar_patrimonio_baixado.php'">Visualizar Patrimônio baixado</button>
                 
                
              </div>
              <div class="painel-acoes" >
                <div class="alert alert-success" role="alert">
                    Gerenciar Patrimônio
                   </div>
                   <h4>Informações sobre o gerenciamento.</h4>
                 <ul>
                 <li>
                 <p>Patrimônio baixado são todos que estão em desuso.</p>
                 </li>
                 </ul>
                 
              </div>
            </div>
        </main>
    </div>