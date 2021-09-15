<?php 

include_once "sidebar.php";

$result_subtipo = "SELECT * FROM subtipo S INNER JOIN tipo U ON U.idTipo = S.idTipo ";
$resultado_subtipo = mysqli_query($con, $result_subtipo);

$result_tipo = "SELECT * FROM tipo";
$resultado_tipo = mysqli_query($con, $result_tipo);

?>

<div class="main-content">
              <div class="panel-row">
                  <button class="btn-panel" type="button" onclick="window.location.href = 'cadastrar_tipo_sub.php'">Cadastrar Tipo</button>
                  <button class="btn-panel" type="button" onclick="window.location.href = 'gerenciar_tipo_sub.php'">Voltar ao gerenciamento</button>
              </div>
              <div class="painel-acoes">
                    <!--ambiente onde fica as tabelas e formularios-->
                    <center><h3>Dados de tipo</h3></center>
                <div class="table-responsive">
                <table id="basic-datatables" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Descrição</th>
                           
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($rows_tipo = mysqli_fetch_assoc($resultado_tipo)){ ?>
                        <tr>
                            <td><?php echo $rows_tipo['idTipo']; ?></td>
                            <td><?php echo $rows_tipo['descricaoTipo']; ?></td>
                           
                            <td>
                            <a class="btn btn-primary" data-bs-toggle="modal" href="#alterar<?php echo $rows_tipo['idTipo']; ?>" role="button"><i class="fa fa-edit"></i></a>
                            <?php  echo "<a  class='btn btn-danger' title='Excluir' href='../dao/excluir_tipo.php?idTipo=" .$rows_tipo['idTipo']. "' onclick=\"return confirm('Tem certeza que deseja deletar esse registro?');\">"?> <i class='fas fa-trash-alt'></i><?php echo "</a>";  ?>
                            
                            
                            
                            <div class="modal fade" id="alterar<?php echo $rows_tipo['idTipo']; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalToggleLabel">Alterar Tipo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <form action="../dao/envio_alterar_tipo.php" method="POST">

                                <input type="text" hidden name="idTipo" value="<?php echo $rows_tipo['idTipo']; ?>">
                                <label for="">Descrição Tipo</label>
                                <input type="text" class="form-control" required="required" name="descricaoTipo" value="<?php echo $rows_tipo['descricaoTipo'] ?>" id="">
                               
                                
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

              <div class="painel-acoes">
                    <!--ambiente onde fica as tabelas e formularios-->
                    <center><h3>Dados subtipo</h3></center>
                <div class="table-responsive">
                <table id="basic-datatables2" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>tipo</th>
                            <th>Subtipo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($rows_subtipo = mysqli_fetch_assoc($resultado_subtipo)){ ?>
                        <tr>
                            <td><?php echo $rows_subtipo['idSubtipo']; ?></td>
                            <td><?php echo $rows_subtipo['descricaoTipo']; ?></td>
                            <td><?php echo $rows_subtipo['descricaoSubtipo']; ?></td>
                            <td>
                            <a class="btn btn-primary" data-bs-toggle="modal" href="#alterarSub<?php echo $rows_subtipo['idSubtipo']; ?>" role="button"><i class="fa fa-edit"></i></a>
                            <?php  echo "<a  class='btn btn-danger' title='Excluir' href='../dao/excluir_subtipo.php?idSubtipo=" .$rows_subtipo['idSubtipo']. "' onclick=\"return confirm('Tem certeza que deseja deletar esse registro?');\">"?> <i class='fas fa-trash-alt'></i><?php echo "</a>";  ?>
                            
                            
                            
                            <div class="modal fade" id="alterarSub<?php echo $rows_subtipo['idSubtipo']; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalToggleLabel">Alterar Subtipo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <form action="../dao/envio_alterar_sub.php" method="POST">

                                <input type="text" hidden name="idSubtipo" value="<?php echo $rows_subtipo['idSubtipo']; ?>">
                                <label for="">Descrição Subtipo</label>
                                <input type="text" class="form-control" required="required" name="descricaoSubtipo" value="<?php echo $rows_subtipo['descricaoSubtipo'] ?>" id="">
                                <label for="">Seu tipo</label>   
                                <select name="idTipo" required="required" class="form-control" id="">
                                <option value="">Selecione</option>
                                <?php 
                                $result_type = "SELECT * FROM tipo ";
                                $resultado_type = mysqli_query($con, $result_type); 
                                   while($rows_type = mysqli_fetch_assoc($resultado_type)){     
                                ?>
                                <option value="<?php echo $rows_type['idTipo'] ?>"<?php if($rows_subtipo['idTipo'] == $rows_type['idTipo']) echo 'selected'; ?>><?php echo $rows_type['descricaoTipo']; ?></option>   
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

    $(document).ready(function() {
      $('#basic-datatables2').DataTable({
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

<footer class="footer">
	<div class="container-fluid">
		<div class="copyright ml-auto">

		<?php $ano = date("Y"); ?>
		<center>&copy; Copyrights <?php echo $ano; ?> <strong>Desenvolvido pelo Núcleo de Práticas em Sistemas de Informação UEMG Frutal MG. Todos os direitos reservados.</strong></center>	
		</div>
	</div>
</footer>