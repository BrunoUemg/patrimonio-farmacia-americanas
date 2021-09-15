<?php 

include_once "sidebar.php";

$result_sala = "SELECT * FROM sala S INNER JOIN unidade U ON U.idUnidade = S.idUnidade INNER JOIN entidade E ON E.idEntidade = U.idEntidade ";
$resultado_sala = mysqli_query($con, $result_sala);

?>

<div class="main-content">
              <div class="panel-row">
                  <button class="btn-panel" type="button" onclick="window.location.href = 'cadastrar_sala.php'">Cadastrar Sala</button>
                  <button class="btn-panel" type="button" onclick="window.location.href = 'gerenciar_sala.php'">Voltar ao gerenciamento</button>
              </div>
              <div class="painel-acoes">
                    <!--ambiente onde fica as tabelas e formularios-->
                <div class="table-responsive">
                <table id="basic-datatables" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome da Sala</th>
                            <th>Nome da Unidade</th>
                            <th>Entidade</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($rows_sala = mysqli_fetch_assoc($resultado_sala)){ 
                        if($_SESSION['idEntidade'] == $rows_sala['idEntidade'] || $_SESSION['idEntidade'] == 0){
                      ?>
                      
                      
                      
                      <tr>
                            <td><?php echo $rows_sala['idSala']; ?></td>
                            <td><?php echo $rows_sala['nomeSala']; ?></td>
                            <td><?php echo $rows_sala['nomeUnidade']; ?></td>
                            <td><?php echo $rows_sala['nomeFantasia']; ?></td>
                            <td>
                            <a class="btn btn-primary" data-bs-toggle="modal" href="#alterar<?php echo $rows_sala['idSala']; ?>" role="button"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-primary" data-bs-toggle="modal" href="#pdf<?php echo $rows_sala['idSala']; ?>" role="button"><i class="fa fa-file-pdf"></i></a>
                            <?php  echo "<a  class='btn btn-danger' title='Excluir' href='../dao/excluir_sala.php?idSala=" .$rows_sala['idSala']. "' onclick=\"return confirm('Tem certeza que deseja deletar esse registro?');\">"?> <i class='fas fa-trash-alt'></i><?php echo "</a>";  ?>
                           
                            
                            
                            
                            <div class="modal fade" id="alterar<?php echo $rows_sala['idSala']; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalToggleLabel">Alterar Sala</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <form action="../dao/envio_alterar_sala.php" method="POST">

                                <input type="text" hidden name="idSala" value="<?php echo $rows_sala['idSala']; ?>">
                                <label for="">Nome da sala</label>
                                <input type="text" class="form-control" required="required" name="nomeSala" value="<?php echo $rows_sala['nomeSala'] ?>" id="">
                                <label for="">Unidade dessa sala</label>   
                                <select name="idUnidade" required="required" class="form-control" id="">
                                <option value="">Selecione</option>
                                <?php 
                                $result_unidade = "SELECT * FROM unidade where idEntidade = $rows_sala[idEntidade] ";
                                $resultado_unidade = mysqli_query($con, $result_unidade); 
                                   while($rows_unidade = mysqli_fetch_assoc($resultado_unidade)){     
                                ?>
                                <option value="<?php echo $rows_unidade['idUnidade'] ?>"<?php if($rows_sala['idUnidade'] == $rows_unidade['idUnidade']) echo 'selected'; ?>><?php echo $rows_unidade['nomeUnidade']; ?></option>   
                                <?php } ?>
                                </select>
                                
                                </div>
                                <div class="modal-footer">
                                <input type="submit" class="btn btn-success" value="Salvar">
                                <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Fechar</button>
                                </div>
                                </form>
                                </div>
                            </div>
                            </div>
                            <div class="modal fade" id="pdf<?php echo $rows_sala['idSala']; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalToggleLabel">Gerar pdf com os dados do responsável</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <form action="../funcoes/gerar_termo_responsabilidade.php" method="POST">

                                <input type="text" name="idSala" hidden value="<?php echo $rows_sala['idSala']; ?>" id="">
                                <label for="">Escolha o responsável</label>   
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
                                <div class="modal-footer">
                                <input type="submit" class="btn btn-success" value="Gerar">
                                <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Fechar</button>
                                </div>
                                </form>
                                </div>
                            </div>
                            </div>


                            
                            </td>
                        </tr>
            <?php } } ?>

                    </tbody>
                </table>
                </div>
              </div>
            </div>
        </main>
    </div>


   
  

<script>
    $(document).ready(function() {
      $('#basic-datatables').DataTable({
        "language": {
          "sEmptyTable": "Nenhum registro encontrado",
          "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
          "sInfoFiltered": "(Filtrados de _MAX_ registros)",
          "sInfoPostFix": "",
          "sInfoThousands": ".",
          "sLengthMenu": "_MENU_ resultados por página",
          "sLoadingRecords": "Carregando...",
          "sProcessing": "Processando...",
          "sZeroRecords": "Nenhum registro encontrado",
          "sSearch": "Pesquisar",
          "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
          },
          "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
          }
        }
      });
    });
  </script>

