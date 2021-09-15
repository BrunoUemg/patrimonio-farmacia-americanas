<?php 

include_once "sidebar.php";

include_once "../dao/conexao.php";

if(isset($_POST['idEntidade'])){
    $idSala = $_POST['idSala'];
    $idEntidade = $_POST['idEntidade'];
    $idSala2 = $_POST['idSala2'];
    $idEntidade2 = $_POST['idEntidade2'];
    $idUnidade2 = $_POST['idUnidade2'];
    
    $result_patrimonio = "SELECT * FROM patrimonio P INNER JOIN sala S ON S.idSala = P.idSala 
    INNER JOIN entidade E ON E.idEntidade = P.idEntidade where P.idEntidade = '$idEntidade' and P.idSala = '$idSala' and P.idStatus !=2";
    $resultado_patrimonio = mysqli_query($con, $result_patrimonio);
    }

?>

        

<div class="main-content">
<?php include_once("../dao/conexao.php"); 
				if(!empty($_SESSION['msg'])){
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);
				}
			?>
              <div class="painel-acoes">
            <form action="" method="POST">
                <h3>Fazer movimentação</h3>
                
                <br>
                <h5>De:</h5>
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
           
            <span id="span"></span>
            <select name="idSala" required="required"  class="form-control" id="idSala">
            <option value="">Escolha a sala</option>
            </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
         <center><h3>Movimentar</h3></center>
            
           
            </div>
        </div>
        <br>
        <h5>Para:</h5>
            <div class="row">


            <div class="col">
                <label for="">Entidade</label>
            
                <select name="idEntidade2" class="form-control" id="idEntidade2">
            <option value="">Escolha a entidade</option>
            <?php
            $result_entidade2 = "SELECT * FROM entidade ORDER BY nomeFantasia";
            $resultado_entidade2 = mysqli_query($con, $result_entidade2);
            while($row_entidade2 = mysqli_fetch_assoc($resultado_entidade2) ) {
              if($_SESSION['idEntidade'] == $row_entidade2['idEntidade'] || $_SESSION['idEntidade'] == 0){
            echo '<option value="'.$row_entidade2['idEntidade'].'">'.$row_entidade2['nomeFantasia'].'</option>';
            } }
            ?>
            </select>
                    </div>





            <div class="col">
                <label for="">Unidade</label>
                
            <span id="span"></span>
                <select name="idUnidade2" class="form-control" id="idUnidade2">
            <option value="">Escolha a unidade</option>
            </select>
                    </div>
        


            <div class="col">
            <label>Sala</label>
          
            <span id="span"></span>
            <select name="idSala2" required="required"  class="form-control" id="idSala2">
            <option value="">Escolha a sala</option>
            </select>
            </div>
        </div>
            <br>
        <button type="submit" class="btn btn-primary">Visualizar</button>
            </form>
            </div>
            <?php if(isset($_POST['idEntidade'])){ ?>
              <div class="painel-acoes">
    
                    <!--ambiente onde fica as tabelas e formularios-->
                    <form action="../dao/movimantar_patrimonio.php" method="post">
                <div class="table-responsive">
                <table id="basic-datatables" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome da Sala</th>
                            <th>Entidade</th>
                            <th>Patrimônio</th>
                            <th>Selecionar</th>
                        
                         
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($rows_patrimonio = mysqli_fetch_assoc($resultado_patrimonio)){ ?>
                        <tr>
                            <td><?php echo $rows_patrimonio['codigoPatrimonio']; ?></td>
                            <td><?php echo $rows_patrimonio['nomeSala']; ?></td>
                            <td><?php echo $rows_patrimonio['nomeFantasia']; ?></td>
                            <td><?php echo $rows_patrimonio['descricaoPatrimonio']; ?></td>
                            <td><input type="checkBox"  name="movimentar[]" value="<?php echo $rows_patrimonio['idPatrimonio']; ?>" id="">
                            <input type="text"  name="idEntidade" hidden value="<?php echo $idEntidade2; ?>" id="">
                            <input type="text"  name="idSala" hidden value="<?php echo $idSala2; ?>" id="">
                            <input type="text"  name="idUnidade" hidden value="<?php echo $idUnidade2; ?>" id="">
                                </td>
                           
                        </tr>
            <?php } ?>

                    </tbody>
                </table>
                <br>
                <input type="password" required class="form-control" name="senha_validacao" id="">
                <br>
                <center> <button type="submit" class="btn btn-primary">Movimentar</button></center>
                </form>
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