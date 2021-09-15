<?php 

include_once "sidebar.php";

?>

<div class="main-content">
              <div class="panel-row">
                  <button class="btn-panel" type="button" onclick="window.location.href = 'gerenciar_responsavel.php'">Voltar ao gerenciamento</button>
                  <button class="btn-panel" type="button" onclick="window.location.href= 'consultar_responsavel.php'" >Visualizar responsavel</button>
              </div>
              <div class="painel-acoes" >
              <?php include_once("../dao/conexao.php"); 
				if(!empty($_SESSION['msg'])){
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);
				    }
			        ?>
                    
                <form action="../dao/envio_cadastro_responsavel.php" method="POST">
               
                    <div class="row">
                      <div class="col">
                          <label for="">Nome do responsável</label>
                       <input type="text" name="nomeResponsavel" required="required" maxlength="80" class="form-control" id="">
                            
                        </select>
                      </div>
                      <div class="col">
                          <label for="">CPF</label>
                        <input type="text" class="form-control" name="cpf" required="required" placeholder="CPF" onkeyup="mascara('###.###.###-##',this,event,true)">
                      </div>
                     
                    </div>
                    <div class="row">
                    <div class="col">
                          <label for="">RG</label>
                        <input type="text" class="form-control" name="rg" maxlength="30" placeholder="RG">
                      </div>
                        <div class="col ">
                            <label for="">Contato</label>
                            <input type="text" class="form-control" name="telefoneContato"  required="required" onkeyup="mascara('(##) #####-####',this,event,true)" id="">
                        </div>
                        <div class="col ">
                            <label for="">E-mail</label>
                            <input type="email" class="form-control" name="email" maxlength="60"  id="">
                        </div>
                        
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                  </form>
              </div>
            </div>
        </main>
    </div>