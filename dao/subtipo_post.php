<?php include_once("conexao.php");

	$idTipo = $_REQUEST['idTipo'];
	
	$result_sub = "SELECT * FROM subtipo WHERE idTipo=$idTipo ORDER BY descricaoSubtipo";
	$resultado_sub = mysqli_query($con, $result_sub);
	
	while ($row_sub = mysqli_fetch_assoc($resultado_sub) ) {
		$resultao[] = array(
			'id'	=> $row_sub['idSubtipo'],
			'nome' => ($row_sub['descricaoSubtipo']),
		);
	}
	
	echo(json_encode($resultao));
