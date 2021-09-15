<?php 

include_once "sidebar.php";

include_once "../dao/conexao.php";

if(isset($_POST['idEntidade'])){
$idSala = $_POST['idSala'];
$idEntidade = $_POST['idEntidade'];

$result_termo = "SELECT * FROM sala_has_responsavel H INNER JOIN sala S ON S.idSala = H.idSala 
INNER JOIN responsavel_patrimonio R ON R.idResponsavel_patrimonio = H.idResponsavel where H.idSala = '$idSala' ";
$resultado_termo = mysqli_query($con, $result_termo);
}
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
                 
                  <button class="btn-panel" type="button" onclick="window.location.href = 'gerenciar_sala.php'">Voltar ao gerenciamento</button>
              </div>
              <div class="painel-acoes">
            <form action="" method="POST">
                <h3>Relatório dos termos</h3>
                <br>
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
        </div>
            <br>
        <button type="submit" class="btn btn-primary">Pesquisar</button>
            </form>
            </div>
            <?php if(isset($_POST['idEntidade'])){ ?>
              <div class="painel-acoes">
                    <!--ambiente onde fica as tabelas e formularios-->
                <div class="table-responsive">
                <table id="basic-datatables" class="table table-bordered">
                    <thead>
                        <tr>
                            
                            <th>Responsável</th>
                            <th>Sala</th>
                            <th>Data inserida</th>
                            <th>Termo</th>
                        
                         
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($rows_termo = mysqli_fetch_assoc($resultado_termo)){ ?>
                        <tr>
                            
                            <td><?php echo $rows_termo['nomeResponsavel']; ?></td>
                            <td><?php echo $rows_termo['nomeSala']; ?></td>
                            <td><?php echo date("d/m/Y", strtotime($rows_termo['data'])); ?></td>
                            <td><a class="btn btn-primary" href="../termo/<?php echo $rows_termo['srcTermo']; ?>" target="_blank" rel="noopener noreferrer">Visualizar</a></td>
                           
                        </tr>
            <?php } ?>

                    </tbody>
                </table>
                </div>
              </div>
            </div>
        </main>
    </div>

<?php } ?>
   
  

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
