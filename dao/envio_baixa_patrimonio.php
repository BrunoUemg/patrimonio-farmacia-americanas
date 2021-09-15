

<?php

include_once "../dao/conexao.php";

$idPatrimonio = $_GET["idPatrimonio"];






$sqlPatrimonio = "SELECT * FROM patrimonio where idPatrimonio = '$idPatrimonio'";
$res = $con-> query($sqlPatrimonio);
$linha_patrimonio = $res->fetch_assoc();


$result_patrimonio = "SELECT * FROM unidade where idEntidade = $linha_patrimonio[idEntidade]";
$res = $con->query($result_patrimonio);
$linha2 = $res->fetch_assoc();

$descricaoPatrimonio = $linha_patrimonio['descricaoPatrimonio'];
  
$con->query("UPDATE patrimonio set idStatus = 2 where idPatrimonio = '$idPatrimonio'");
  
  
  setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
  date_default_timezone_set('America/Sao_Paulo');
  session_start();
  $data_hoje = date("d/m/Y");
  $data_hojeEua = date("Y-m-d");
  $hora_gerada = date("H:i:s");
  $sql_usuario = "SELECT * FROM usuario where idUsuario = $_SESSION[idUsuario]";
  $res = $con->query($sql_usuario);
  $linha_usuario = $res->fetch_assoc();
  $con->query("INSERT INTO historico_movimentacoes (dataAlteracao, horaAlteracao, acao, idUsuario, idPatrimonio, idSala, idEntidade, 
      idUnidade)VALUES('$data_hojeEua', '$hora_gerada', 'Patrimônio em baixa pendente', '$linha_usuario[idUsuario]', 
      '$idPatrimonio', '$linha_patrimonio[idSala]', '$linha_patrimonio[idEntidade]', '$linha2[idUnidade]')");

  use Dompdf\Dompdf;
  
  // include autoloader
  require_once '../funcoes/dompdf/autoload.inc.php';
  
  $dompdf = new Dompdf();
  $dompdf->loadHtml(' <div align="right"> </div>
  
  
  <center><h2><u>Declaração de baixa do patrimonio </u></h2></center> 


 
     
   <br>

<p>
Declaração que o patrimônio ' . $linha_patrimonio['descricaoPatrimonio'] . ' foi baixado, por estar em status de desuso. Este arquivo deve ser assinado e inserido no sistema para finalizar a baixa.
</p>

<h4>Frutal, '.$data_hoje.'</h4>
<br>
<br>


 <br>
<br>
<br>
 <br>

     <table style="width: 100%;">
     <tbody>
       <tr>
         <td style="width: 45.0000%;">______________________________________ </td>
         <td style="width: 10.0000%;"> </td>
         <td style="width: 45.0000%;"><center>______________________________________</center> </td>
       </tr>
       <tr>
         <td style="width: 45.0000%;"><center><strong>Testemunha</strong></center></td>
         <td style="width: 10.0000%;"> </td>
         <td style="width: 45.0000%;"> <center> <strong> Testemunha</strong></center></td>
       </tr>
   
       </tbody>
       </table>

       <br>
       <br>
       <br>
       <br>
     <table style="width: 100%;">
     <tbody>
       <tr>
         <td style="width: 45.0000%;">______________________________________ </td>
         <td style="width: 10.0000%;"> </td>
         <td style="width: 45.0000%;"><center>______________________________________</center> </td>
       </tr>
       <tr>
         <td style="width: 45.0000%;"><center><strong>Testemunha</strong></center></td>
         <td style="width: 10.0000%;"> </td>
         <td style="width: 45.0000%;"> <center> <strong> Dhouglas Araujo Soares</strong></center></td>
       </tr>
   
       </tbody>
       </table>



 



<br>
    

   

  <p>Documento gerado por '.$linha_usuario['nomeUsuario'].' em '.$data_hoje.' às '.$hora_gerada.'.</p>
  
  
          
      
  
  
          
  
  ');
  
  // (Optional) Setup the paper size and orientation
  $dompdf->setPaper('A4', 'portrait');
  ob_clean();
  // Render the HTML as PDF
  $dompdf->render();
  
  // Output the generated PDF to Browser
  $dompdf->stream('Declaração de baixa.pdf',
  array ("Attachment" =>true //para realizar o download somente alterar para true
  )
  );


  ?>