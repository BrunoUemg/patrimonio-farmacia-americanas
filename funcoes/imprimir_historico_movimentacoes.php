

<?php

include_once "../dao/conexao.php";

$idPatrimonio = $_GET["idPatrimonio"];


$sql4 = "SELECT * FROM historico_movimentacoes H INNER JOIN sala S ON S.idSala = H.idSala 
INNER JOIN entidade E ON E.idEntidade = H.idEntidade INNER JOIN unidade U ON U.idUnidade = H.idUnidade 
INNER JOIN patrimonio P ON P.idPatrimonio = H.idPatrimonio INNER JOIN usuario N ON N.idUsuario = H.idUsuario
where H.idPatrimonio = '$idPatrimonio' ORDER BY H.idHistorico desc";
$res = $con-> query($sql4);
$linha = $res->fetch_assoc();
$resultado_historico = mysqli_query($con, $sql4);


$sqlPatrimonio = "SELECT * FROM patrimonio where idPatrimonio = '$idPatrimonio'";
$res = $con-> query($sqlPatrimonio);
$linha_patrimonio = $res->fetch_assoc();

$descricaoPatrimonio = $linha_patrimonio['descricaoPatrimonio'];
  
  $html .='<table border=1>';
  $html .= '<thead>';
  $html .='<tr>';

  $html .='<td> Data da alteração </td>';
  $html .='<td> Hora da alteração </td>';
  $html .='<td> Ação </td>';
  $html .='<td> Quem alterou </td>';
  $html .='<td> Entidade </td>';
  $html .='<td> Unidade </td>';
  $html .='<td> Sala </td>';
  
  $html .='</tr>';
  $html .= '</thead>';
  

 
  
  while ($rows_historico = mysqli_fetch_assoc($resultado_historico)) { 
         $html .= '<tbody>';
         $dataBanco = $rows_historico['dataAlteracao'];
         $dataNova = date("d/m/Y", strtotime($dataBanco));
         $html .= '<tr> <td>'  . $dataNova. '</td>';
         $html .= '<td>'  . $rows_historico['horaAlteracao']. '</td>';
         $html .= '<td>'  . $rows_historico['acao']. '</td>';
        
         $html .=  ' <td>' . $rows_historico['nomeUsuario']. '</td>';
         $html .=  ' <td>' . $rows_historico['nomeFantasia']. '</td>';
         $html .=  ' <td>' . $rows_historico['nomeUnidade']. '</td>';
         $html .=  ' <td>' . $rows_historico['nomeSala']. '</td></tr>';
         $html .= '</tbody>';
  }
  
  
  $html .= '</table>';
 /////////////////////////////////////////////////////////////////////////////



////////////////////////////////////////////////
  
  
  setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
  date_default_timezone_set('America/Sao_Paulo');
  session_start();
  $data_hoje = date("d/m/Y");
  $hora_gerada = date("H:i:s");
  $sql_usuario = "SELECT * FROM usuario where idUsuario = $_SESSION[idUsuario]";
  $res = $con->query($sql_usuario);
  $linha_usuario = $res->fetch_assoc();
  use Dompdf\Dompdf;
  
  // include autoloader
  require_once 'dompdf/autoload.inc.php';
  
  $dompdf = new Dompdf();
  $dompdf->loadHtml(' <div align="right"> </div>
  
  
  <center><h2><u>Histórico de movimentções do patrimônio '.$descricaoPatrimonio.' </u></h2></center> 
  

   
       
     
  
      <br>
      <h3> &nbsp; &nbsp; 1 Histórico de atualização:</h3>
    '. $html . '
    <br>

   
  
  
  
 
      
  
     
  
    <p>Documento gerado por '.$linha_usuario['nomeUsuario'].' em '.$data_hoje.' às '.$hora_gerada.'.</p>
  
  
          
      
  
  
          
  
  ');
  
  // (Optional) Setup the paper size and orientation
  $dompdf->setPaper('A4', 'portrait');
  ob_clean();
  // Render the HTML as PDF
  $dompdf->render();
  
  // Output the generated PDF to Browser
  $dompdf->stream('Histórico de movimentações.pdf',
  array ("Attachment" =>true //para realizar o download somente alterar para true
  )
  );


  ?>