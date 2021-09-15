<?php 

include_once "sidebar.php";

?>

<div class="main-content">

        
              <div class="panel-row">
                  <button class="btn-panel" type="button" onclick="window.location.href = 'gerenciar_usuario.php'">Voltar ao gerenciamento</button>
                  <button class="btn-panel" type="button" onclick="window.location.href= 'consultar_usuario.php'" >Visualizar Usuário</button>
              </div>
              
              <div class="painel-acoes" >
                <form action="../dao/envio_cadastro_usuario.php" method="POST">
                    <div class="row">
                      <div class="col">
                          <label for="">Nome do usuário</label>
                      
                          <input type="text" required="required" class="form-control" name="nomeUsuario" id="">
                        
                          <label for="">Usuário de acesso</label>
                      
                      <input type="text" required="required" class="form-control" name="userAcesso" id="">
                        <ul>
                        <li>
                        <p>A senha é o nome do usuário de acesso</p>
                        </li>
                        </ul>
                      </div>
                      <div class="col">
                          <label for="">Entidade</label>
                      
                          <select name="idEntidade" class="form-control" id="idEntidade">
                <option value="">Escolha a entidade</option>
                <?php
                  $result_entidade = "SELECT * FROM entidade ORDER BY nomeFantasia";
                  $resultado_entidade = mysqli_query($con, $result_entidade);
                  while($row_entidade = mysqli_fetch_assoc($resultado_entidade) ) {
                    echo '<option value="'.$row_entidade['idEntidade'].'">'.$row_entidade['nomeFantasia'].'</option>';
                  }
                ?>
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