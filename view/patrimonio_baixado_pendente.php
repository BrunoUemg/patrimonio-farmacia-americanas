<?php 

include_once "sidebar.php";


$result_patrimonio = "SELECT * FROM patrimonio P INNER JOIN sala S ON S.idSala = P.idSala 
INNER JOIN entidade E ON E.idEntidade = P.idEntidade INNER JOIN status T ON T.id = P.idStatus
INNER JOIN subtipo U ON U.idSubtipo = P.idSubtipo INNER JOIN unidade I ON I.idUnidade = S.idUnidade where T.nome = 'Desuso'";
$resultado_patrimonio = mysqli_query($con, $result_patrimonio);
?>
<style type="text/css">
			.carregando{
			
				display:none;
			}
      .carregando2{
			
      display:none;
    }
		</style>



<div class="main-content">
              <div class="panel-row">
                  <button class="btn-panel" type="button" onclick="window.location.href = 'cadastrar_patrimonio.php'">Cadastrar Patrimônio</button>
                  <button class="btn-panel" type="button" onclick="window.location.href = 'gerenciar_patrimonio.php'">Voltar ao gerenciamento</button>
                  
              </div>
              <div class="painel-acoes">
              <?php include_once("../dao/conexao.php"); 
				if(!empty($_SESSION['msg'])){
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);
				}
			?>
                    <!--ambiente onde fica as tabelas e formularios-->
                <div class="table-responsive">
                <table id="basic-datatables" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Descrição</th>
                            <th>Código Patrimonio</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($rows_patrimonio = mysqli_fetch_assoc($resultado_patrimonio)){ 
                          if($_SESSION['idEntidade'] == $rows_patrimonio['idEntidade'] || $_SESSION['idEntidade'] == 0){
                        $result_patrimonioBaixado = mysqli_query($con, "SELECT * FROM patrimonio_baixado where idPatrimonio = $rows_patrimonio[idPatrimonio]");

                        if(mysqli_num_rows($result_patrimonioBaixado) < 1){
                        
                        ?>
                       
                        
                       
                        <tr>
                        <td><?php echo $rows_patrimonio['descricaoPatrimonio']; ?></td>
                            <td><?php echo $rows_patrimonio['codigoPatrimonio']; ?></td>
                           
                            <td>
                            <a class="btn btn-primary" data-bs-toggle="modal" href="#finalizar<?php echo $rows_patrimonio['idPatrimonio']; ?>" role="button"><i class="fa fa-check"></i></a>
                            <a class="btn btn-primary" data-bs-toggle="modal" target="_blank" href="<?php echo '../foto_patrimonio/'. $rows_patrimonio['fotoPatrimonio']; ?>" role="button">Foto</a>
                            <a class="btn btn-primary" data-bs-toggle="modal" target="_blank" href="<?php echo '../nota_fiscal/'. $rows_patrimonio['comprovanteFiscal']; ?>" role="button">Nota fiscal</a>
                            
                            <?php  echo "<a  class='btn btn-danger' title='Excluir' href='../funcoes/imprimir_historico_movimentacoes.php?idPatrimonio=" .$rows_patrimonio['idPatrimonio']. "'>"?> Histórico<?php echo "</a>";  ?>
                            
                            
                            
                            
                            <div class="modal fade" id="finalizar<?php echo $rows_patrimonio['idPatrimonio']; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                            <div class="modal-dialog modal-fullscreen-sm-down">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalToggleLabel">Finalizar</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <form action="../dao/envio_finalizacao_baixa.php" method="POST"  enctype="multipart/form-data">

                                <center><h4>Finalizar baixa do patrimônio</h4></center>
                             

                               
                               
                                <div class="col">
                                <input type="text" hidden readOnly name="idPatrimonio" value="<?php echo $rows_patrimonio['idPatrimonio']; ?>">
                                <label for="">Descrição</label>
                                <input type="text" class="form-control"  required="required" readOnly name="descricaoPatrimonio" value="<?php echo $rows_patrimonio['descricaoPatrimonio'] ?>" id="">
                                </div>
                               
                                <div class="col">
                                <label for="">Código do patrimonio</label>
                                <input type="text" class="form-control" required="required" readOnly  name="codigoPatrimonio" value="<?php echo $rows_patrimonio['codigoPatrimonio'] ?>" id="">
                                </div>
                                <hr>
                                <div class="col">
                                <label for="">Declaração de baixa</label>
                                <input type="file" class="form-control" required="required"  name="comprovanteBaixa">
                                <label for="">Senha para validação</label>
                                <input type="password" class="form-control" required="required"  name="senha_validacao">
                                <input type="checkBox" required name="check" value="check" id=""> <label for=""> <p> Confirmo a baixa desse patrimônio.</p></label>
                                </div>

                              
                             
                                
                                <br>

                                <input type="submit" class="btn btn-success" value="Confirmar">
                                </div> 
                                </form>
    
                           
                                
                            </div>
                            </div>

                           


                            
                            </td>


                            </td>






                        </tr>



            
                      <?php } } }?>
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