<?php 

include_once "sidebar.php";

?>

<div class="main-content">

            <?php if($_SESSION['acesso'] == 1){ ?>
              <div class="panel-row">
                  <button class="btn-panel" type="button" onclick="window.location.href = 'cadastrar_usuario.php'">Cadastrar Usuário</button>
                  <button class="btn-panel" onclick="window.location.href = 'consultar_usuario.php'">Visualizar Usuário</button>
                
              </div>
              <?php } ?>
             
             
              <div class="painel-acoes" >
                <div class="alert alert-success" role="alert">
                    Gerenciar Usuário
                   </div>
                   <a class="btn btn-primary"  data-bs-toggle="modal" href="#alterar" role="button">Alterar minha senha</a>
              </div>
              <div class="modal fade" id="alterar" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalToggleLabel">Alterar Senha</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <form action="../dao/alterar_senha.php" method="POST">

                                
                                <p>Digite sua senha atual</p>
                            <input type="password" name="senha_atual" autocomplete="off" class="form-control placeholder-no-fix" required>
                        </div>

                        <div class="modal-body">
                            <p>Digite sua nova senha</p>
                            <input type="password" name="nova_senha" id="nova_senha" autocomplete="off" class="form-control placeholder-no-fix" required>
                        </div>

                        <div class="modal-body">
                            <p>Confirme sua nova senha</p>
                            <input type="password" name="confirma_senha" id="confirma_senha" autocomplete="off" class="form-control placeholder-no-fix" required>
                                   
                                
                                
                                </div>
                                <div class="modal-footer">
                                <input type="submit" class="btn btn-success" value="Salvar">
                                <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Fechar</button>
                                </div>
                                </form>
                                </div>
                            </div>
                            </div>
            </div>
        </main>
    </div>