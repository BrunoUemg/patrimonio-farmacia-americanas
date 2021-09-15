<?php 


include_once "sidebar.php";
include_once "../dao/conexao.php";

$resultado_unidade = "SELECT * FROM unidade";
$resultada_final_unidade = mysqli_query($con, $resultado_unidade);

?>

<div class="main-content">
              <div class="panel-row">
                  <button class="btn-panel" type="button" onclick="window.location.href = 'gerenciar_sala.php'">Voltar ao gerenciamento</button>
                  <button class="btn-panel" type="button" onclick="window.location.href= 'consultar_sala.php'" >Visualizar Sala</button>
              </div>
              <div class="painel-acoes" >
                <form action="../dao/envio_cadastro_sala.php" method="POST">
                    <div class="row">
                      <div class="col">
                          <label for="">Nome da Sala</label>
                      
                          <input type="text" required="required" class="form-control" name="nomeSala" id="">
                            
                        
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
                     
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                  </form>
              </div>
            </div>
        </main>
    </div>