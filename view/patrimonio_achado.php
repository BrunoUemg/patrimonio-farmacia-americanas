<?php 

include_once "sidebar.php";

include_once "../dao/conexao.php";

if(isset($_POST['codigoPatrimonio'])){
    $codigoPatrimonio = $_POST['codigoPatrimonio'];
   
    $select_patrimonio = mysqli_query($con, "SELECT * FROM patrimonio where codigoPatrimonio = '$codigoPatrimonio'");
    $result = mysqli_fetch_array($select_patrimonio);
    if($result['inventario'] == 0){
        $con->query("UPDATE patrimonio set inventario = 1 where idPatrimonio = $result[idPatrimonio]");
        $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Patrimônio achado com sucesso!</div>';
        echo "<script>window.location='../view/patrimonio_achado.php'</script>";
        exit();
    } else{
        $_SESSION['msg'] = '<div class="alert alert-primary" role="alert">Esse patrimônio ja foi achado!</div>';
        echo "<script>window.location='../view/patrimonio_achado.php'</script>";
        exit();
    }
    
    
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
<?php include_once("../dao/conexao.php"); 
				if(!empty($_SESSION['msg'])){
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);
				}
			?>
              <div class="painel-acoes">
            <form action="" method="POST">
                <h3>Patrimônio achado</h3>
                
                <br>
                
                <br>
               
            <div class="row g-3">


            <div class="col-md-3">
                <label for="">Digite o código do patrimonio achado</label>
               <input type="text" name="codigoPatrimonio" class="form-control" id="">
                    </div>





        
        </div>
        <br>
        
            <br>
        <button type="submit" class="btn btn-primary">Esta aqui</button>
            </form>
            </div>
            <?php if(isset($_POST['idEntidade'])){ ?>
              <div class="painel-acoes">
                <h3><center>Selecione se o patrimônio não estiver na sala</center></h3>
                    <!--ambiente onde fica as tabelas e formularios-->
                    <form action="../dao/finalizar_iventario.php" method="post">
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
                            <td><input type="checkBox"  name="inventario[]" value="<?php echo $rows_patrimonio['idPatrimonio']; ?>" id="">
                            
                                </td>
                           
                        </tr>
            <?php } ?>

                    </tbody>
                </table>
                <br>
                <input type="password" required class="form-control" name="senha_validacao" id="">
                <br>
                <center> <button type="submit" class="btn btn-primary">Finalizar</button></center>
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