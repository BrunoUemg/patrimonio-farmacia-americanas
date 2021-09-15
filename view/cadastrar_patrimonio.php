<?php 

include_once "sidebar.php";

$resultado_unidade = "SELECT * FROM unidade";
$resultada_final_unidade = mysqli_query($con, $resultado_unidade);




$result_status = "SELECT * FROM status where id != 2";
$resultado_status = mysqli_query($con, $result_status);

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
                  <button class="btn-panel" type="button" onclick="window.location.href = 'gerenciar_patrimonio.php'">Voltar ao gerenciamento</button>
                  <button class="btn-panel" type="button" onclick="window.location.href= 'consultar_patrimonio.php'" >Visualizar Patrimônio</button>
              </div>
              <div class="painel-acoes" >
              <?php include_once("../dao/conexao.php"); 
				if(!empty($_SESSION['msg'])){
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);
				}
			?>
                <form method="POST" action="../dao/envio_cadastro_patrimonio.php"  enctype="multipart/form-data">
                   
                   <div class="row">
                   <div class="col">
                        <label for="">Descrição do patrimônio</label>
                        <input type="text" name="descricaoPatrimonio" class="form-control" id="">
                        </div>
                   
                        <div class="col">
                    <label for="">Código do patrimonio (etiqueta)</label>
                    <input type="text" required="required" class="form-control" name="codigoPatrimonio" id="">
                    </div>
                   
                      </div>
                   
                    <div class="row">


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
                            <label for="">Conservação</label>
                           <select name="conservacao" required="required" class="form-control" id="">
                               <option value="">Selecione</option>
                               <option value="Bom">Bom</option>
                               <option value="Regular">Regular</option>
                               <option value="Ruim">Ruim</option>
                               <option value="Sucata">Sucata</option>
                           </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                            <label for="">Status</label>
                           <select name="idStatus" required="required" class="form-control" id="">
                               <option value="">Selecione</option>
                               <?php
                               while($rows_status = mysqli_fetch_assoc($resultado_status) ) {
                              echo '<option value="'.$rows_status['id'].'">'.$rows_status['nome'].'</option>';
                                } ?>
                           </select>
                        </div>
                       
                        <div class="col">
                        <label for="">Nota fiscal</label>
                        <input type="text" name="notaFiscal" class="form-control" id="">
                        </div>
                        </div>
                        <div class="row">
                        <div class="col">
                          <label for="">Tipo do patrimônio</label>
                      
                          <select name="idTipo" class="form-control" id="idTipo">
                <option value="0">Escolha o tipo</option>
                <?php
                  $result_tipo = "SELECT * FROM tipo ORDER BY descricaoTipo";
                  $resultado_tipo = mysqli_query($con, $result_tipo);
                  while($rows_tipo = mysqli_fetch_assoc($resultado_tipo) ) {
                    echo '<option value="'.$rows_tipo['idTipo'].'">'.$rows_tipo['descricaoTipo'].'</option>';
                  }
                ?>
              </select>
                              </div>
                          
    

                      <div class="col">
                      <label>Subtipo</label>
                    <span class="carregando2"><div class="alert alert-danger" role="alert">
                        Ops, sem subtipo, campo obrigatório!
                  </div></span>
                  <select name="idSubtipo" required="required" class="form-control" id="idSubtipo">
                    <option value="">Escolha o subtipo</option>
                  </select>
                      </div>

                      <div class="col">
                  <label for="">Nota fiscal</label>
                  <input type="file" name="comprovanteFiscal" class="form-control" id="">

                      </div>
                      <div class="col">
                  <label for="">Foto do patrimônio</label>
                  <input type="file" required name="fotoPatrimonio" class="form-control" id="">

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