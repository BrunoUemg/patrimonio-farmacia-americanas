<?php 

include_once "sidebar.php";

$result_unidade = "SELECT * FROM unidade U INNER JOIN entidade E ON E.idEntidade = U.idEntidade";
$resultado_unidade = mysqli_query($con, $result_unidade);

?>

<div class="main-content">
              <div class="panel-row">
                  <button class="btn-panel" type="button" onclick="window.location.href = 'cadastrar_unidade.php'">Cadastrar Unidade</button>
                  <button class="btn-panel" type="button" onclick="window.location.href = 'gerenciar_unidade.php'">Voltar ao gerenciamento</button>
              </div>
              <div class="painel-acoes">
                    <!--ambiente onde fica as tabelas e formularios-->
                <div class="table-responsive">
                <table id="basic-datatables" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome da unidade</th>
                            <th>Entidade</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($rows_unidade = mysqli_fetch_assoc($resultado_unidade)){ ?>
                        <tr>
                            <td><?php echo $rows_unidade['idUnidade']; ?></td>
                            <td><?php echo $rows_unidade['nomeUnidade']; ?></td>
                            <td><?php echo $rows_unidade['nomeFantasia']; ?></td>
                            <td>
                            <a class="btn btn-primary" data-bs-toggle="modal" href="#alterar<?php echo $rows_unidade['idUnidade']; ?>" role="button"><i class="fa fa-edit"></i></a>
                            <?php  echo "<a  class='btn btn-danger' title='Excluir' href='../dao/excluir_unidade.php?idUnidade=" .$rows_unidade['idUnidade']. "' onclick=\"return confirm('Tem certeza que deseja deletar esse registro?');\">"?> <i class='fas fa-trash-alt'></i><?php echo "</a>";  ?>
                            
                            
                            
                            <div class="modal fade" id="alterar<?php echo $rows_unidade['idUnidade']; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalToggleLabel">Alterar unidade</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <form action="../dao/envio_alterar_unidade.php" method="POST">

                                <input type="text" hidden name="idUnidade" value="<?php echo $rows_unidade['idUnidade']; ?>">
                                <label for="">Nome da unidade</label>
                                <input type="text" class="form-control" name="nomeUnidade" value="<?php echo $rows_unidade['nomeUnidade'] ?>" id="">
                                   
                                
                                
                                </div>
                                <div class="modal-footer">
                                <input type="submit" class="btn btn-success" value="Salvar">
                                <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Fechar</button>
                                </div>
                                </form>
                                </div>
                            </div>
                            </div>


                            
                            </td>
                        </tr>
            <?php } ?>

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