<?php 


include_once "sidebar.php";
include_once "../dao/conexao.php";

$resultado_subtipo = "SELECT * FROM tipo";
$resultada_final_subtipo = mysqli_query($con, $resultado_subtipo);

?>

<div class="main-content">
              <div class="panel-row">
                  <button class="btn-panel" type="button" onclick="window.location.href = 'gerenciar_tipo_sub.php'">Voltar ao gerenciamento</button>
                  <button class="btn-panel" type="button" onclick="window.location.href= 'consultar_tipo_sub.php'" >Visualizar Tipo e subtipo</button>
              </div>
              <div class="painel-acoes" >
              <center><h3>Cadastro de tipo</h3></center>
              <br>
                <form action="../dao/envio_cadastro_tipo.php" method="POST">
                    <div class="row">
                      <div class="col">
                      
                          <label for="">Descrição do tipo</label>
                      
                          <input type="text" required="required" class="form-control" name="descricaoTipo" id="">
                            
                        
                      </div>
                     
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                  </form>
              </div>

              <div class="painel-acoes" >
              <center><h3>Cadastro de Subtipo</h3></center>
              <br>
                <form action="../dao/envio_cadastro_sub.php" method="POST">
                    <div class="row">
                      <div class="col">
                      
                          <label for="">Descrição subtipo</label>
                      
                          <input type="text" required="required" class="form-control" name="descricaoSubtipo" id="">
                            
                        
                      </div>
                      <div class="col">
                          <label for="">Tipo</label>
                      
                        <select name="idTipo" required="required" class="form-control" id="">
                        <option value="">Selecione</option>
                        <?php while( $rows_sub = mysqli_fetch_assoc($resultada_final_subtipo)){ ?>                            
                        <option value="<?php echo $rows_sub['idTipo'] ?>"><?php echo $rows_sub['descricaoTipo']; ?></option>
                        <?php } ?>
                        </select>
                            
                        
                      </div>
                     
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                  </form>
              </div>
            </div>
        </main>
    </div>