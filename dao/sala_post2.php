<?php include_once("conexao.php");

	$idUnidade = $_REQUEST['idUnidade2'];
	
	$result_sala = "SELECT * FROM sala WHERE idUnidade=$idUnidade ORDER BY nomeSala";
	$resultado_sala = mysqli_query($con, $result_sala);
	
	while ($row_sala = mysqli_fetch_assoc($resultado_sala) ) {
		$resultao2[] = array(
			'id'	=> $row_sala['idSala'],
			'nome' => ($row_sala['nomeSala']),
		);
	}
	
	echo(json_encode($resultao2));
