<?php 

include_once "sidebar.php";

$result_usuario = "SELECT * FROM usuario where acesso != 1";
$resultado_usuario = mysqli_query($con, $result_usuario);

?>

<div class="main-content">
              <div class="panel-row">
                  <button class="btn-panel" type="button" onclick="window.location.href = 'cadastrar_usuario.php'">Cadastrar usuario</button>
                  <button class="btn-panel" type="button" onclick="window.location.href = 'gerenciar_usuario.php'">Voltar ao gerenciamento</button>
              </div>
              <div class="painel-acoes">
                    <!--ambiente onde fica as tabelas e formularios-->
                <div class="table-responsive">
                <table id="basic-datatables" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome do usuario</th>
                            <th>User acesso</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($rows_usuario = mysqli_fetch_assoc($resultado_usuario)){ ?>
                        <tr>
                            <td><?php echo $rows_usuario['idUsuario']; ?></td>
                            <td><?php echo $rows_usuario['nomeUsuario']; ?></td>
                            <td><?php echo $rows_usuario['userAcesso']; ?></td>
                            <td>
                           
                            <?php  echo "<a  class='btn btn-danger' title='Excluir' href='../dao/excluir_usuario.php?idUsuario=" .$rows_usuario['idUsuario']. "' onclick=\"return confirm('Tem certeza que deseja deletar esse registro?');\">"?> <i class='fas fa-trash-alt'></i><?php echo "</a>";  ?>
                            
                            
                            
                            <div class="modal fade" id="alterar<?php echo $rows_usuario['idUsuario']; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalToggleLabel">Alterar usuario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <form action="../dao/envio_alterar_usuario.php" method="POST">

                                <input type="text" hidden name="idUsuario" value="<?php echo $rows_usuario['idUsuario']; ?>">
                                <label for="">Nome da usuario</label>
                                <input type="text" class="form-control" name="nomeUsuario" value="<?php echo $rows_usuario['nomeUsuario'] ?>" id="">
                                   
                                
                                
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