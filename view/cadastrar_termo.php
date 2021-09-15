<?php 

include_once "sidebar.php";


$result_entidade = "SELECT * FROM entidade";
$resultado_entidade = mysqli_query($con, $result_entidade);

?>
	<style type="text/css">
			.carregando{
			
				display:none;
			}
      .carregando2{
			
      display:none;
    }
      .carregando3{
			
      display:none;
    }
		</style>

<div class="main-content">
              <div class="panel-row">
                  <button class="btn-panel" type="button" onclick="window.location.href = 'gerenciar_sala.php'">Voltar ao gerenciamento</button>
                  <button class="btn-panel" type="button" onclick="window.location.href= 'consultar_sala.php'" >Visualizar Sala</button>
              </div>
              <div class="painel-acoes" >
                  <center><h4>Inserir termo de responsabilidade</h4></center><br>
              <?php include_once("../dao/conexao.php"); 
				if(!empty($_SESSION['msg'])){
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);
				}
			?>
                <form method="POST" action="../dao/envio_cadastro_termo.php"  enctype="multipart/form-data">
                   
                   <div class="row">
                   <div class="col">
                        <label for="">Responsável</label>
                        <select name="idResponsavel_patrimonio" required="required" class="form-control" id="">
                        <option value="">Selecione</option>
                        <?php 
                        $result_responsavel = "SELECT * FROM responsavel_patrimonio ";
                        $resultado_responsavel = mysqli_query($con, $result_responsavel); 
                        while($rows_responsavel = mysqli_fetch_assoc($resultado_responsavel)){     
                        ?>
                        <option value="<?php echo $rows_responsavel['idResponsavel_patrimonio'] ?>"><?php echo $rows_responsavel['nomeResponsavel']; ?></option>   
                        <?php } ?>
                         </select>
                        </div>
                        <div class="col">
                          <label for="">Entidade</label>
                      
                          <select name="idEntidade" class="form-control" id="idEntidade">
                <option value="">Escolha a entidade</option>
                <?php
                  $result_entidade = "SELECT * FROM entidade ORDER BY nomeFantasia";
                  $resultado_entidade = mysqli_query($con, $result_entidade);
                  while($row_entidade = mysqli_fetch_assoc($resultado_entidade) ) {
                    if($_SESSION['idEntidade'] == $row_entidade['idEntidade'] || $_SESSION['idEntidade'] == 0){
                    echo '<option value="'.$row_entidade['idEntidade'].'">'.$row_entidade['nomeFantasia'].'</option>';
                  } }
                ?>
              </select>
                              </div>
                   
                      </div>
                   
                    <div class="row">

                    <div class="col">
                          <label for="">Unidade</label>
                          <span class="carregando3"><div class="alert alert-danger" role="alert">
                        Ops, sem sala nessa unidade, campo obrigatório!
                  </div></span>
                  <span id="span"></span>
                          <select name="idUnidade" class="form-control" id="idUnidade">
                <option value="">Escolha a unidade</option>
              </select>
                              </div>
                          
    

                      <div class="col">
                      <label>Sala</label>
                    <span class="carregando"><div class="alert alert-danger" role="alert">
                        Ops, sem sala nessa unidade, campo obrigatório!
                  </div></span>
                  <span id="span"></span>
                  <select name="idSala" required="required"  class="form-control" id="idSala">
                    <option value="">Escolha a sala</option>
                  </select>
                      </div>
                    
                      <div class="col">
                          <label for="">Termo</label>
                          <input type="file" name="srcTermo" class="form-control" required="required" id="">
                      </div>

                       
                      </div>
                    
                        
                    <br>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                  </form>
              </div>
            </div>
        </main>
    </div>

    

    <script type="text/javascript" src="../js/loader.js"></script>
		<script src="../js/jquery.min.js"></script>
		<!-- onde faz o reload dos selects -->
		<script type="text/javascript" src="../js/reload_jquery.js">

		</script>