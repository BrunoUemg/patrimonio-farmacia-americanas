

<?php

include_once "../dao/conexao.php";

$idSala = $_POST["idSala"];
$idResponsavel_patrimonio = $_POST["idResponsavel_patrimonio"];


$sql4 = "SELECT * FROM patrimonio P INNER JOIN sala S ON S.idSala = P.idSala INNER JOIN entidade E ON E.idEntidade = P.idEntidade where P.idSala = $idSala and P.idStatus !=2 ";
$res = $con-> query($sql4);
$linha = $res->fetch_assoc();
$resultado_patrimonio = mysqli_query($con, $sql4);


$select_resp = mysqli_query($con,"SELECT nomeResponsavel, cpf, rg FROM responsavel_patrimonio where idResponsavel_patrimonio = '$idResponsavel_patrimonio' ");
$resp = mysqli_fetch_array($select_resp); 
  

 $cont = 1;
  
  while ($rows_patrimonio = mysqli_fetch_assoc($resultado_patrimonio)) { 
        
         if($cont == 22){
        $html .= '<img style="position:fixed; bottom:150px; left:-48px;" src="../img/footer3.png">';  
        $html .= '<div style="page-break-after: always;"></div>';
         }
         $html .= '&nbsp; &nbsp; &nbsp;' .$cont.':&nbsp;'   .$rows_patrimonio['descricaoPatrimonio']. '<br>';
        
        
         $cont += 1;   
  }
  
  
 
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
  
  
  <center><h2><u><b> TERMO DE RESPONSABILIDADE DOS EQUIPAMENTOS DO(A) '.$linha['nomeFantasia'].' </b></u></h2></center> 
  
  <br>
  

  <p>Eu '.$resp['nomeResponsavel'].', inscrito (a) no CPF sob o n° '.$resp['cpf'].', RG '.$resp['rg'].', declaro ao <b>GUARDA MIRIM DE FRUTAL</b>, associação privada sem fins lucrativos, inscrita no CNPJ sob n° 26.032.698/0001-10, com sede na Rua Floriano Peixoto, n° 403, bairro Centro, município de Frutal/MG, CEP: 38.206-148 que concordo com todos os termos do uso dos equipamentos da Instituição e declaro ainda ser responsável pelos objetos pertencentes ao meu setor.</p>
   
       
      <h3><b>Concordo que:<b></h3>
      <ol>
      <li>&nbsp;Fica sob minha responsabilidade os seguintes bens da Instituição:</li>
  
      '. $html . '
    
    <br>

    <li><u><b>&nbsp;Declaro que estou recebendo todos os itens acima em perfeito estado de conservação e uso, declarando ainda que estão em funcionamento;</u></b></li>
    <li><u><b>&nbsp;Estou ciente que em caso de demissão ou rescisão contratual, não terei acesso aos equipamentos da Instituição;</u></b></li>
    <li><u><b>&nbsp;Garanto ainda, que irei entregá-los da forma como encontrei;</u></b></li>
    <li><u><b>&nbsp;Qualquer equipamento que for retirado do meu setor deverá constar em um documento com a assinatura de ambas as partes cientes;</u></b></li>
    <li><u><b>&nbsp;Como responsável pelo setor, assumo as responsabilidades pelos danos, sumiço ou quaisquer outros contratempos nos equipamentos.</u></b></li>
    </ol>
  <p>O não cumprimento do presente Termo acarretará em responsabilidade civil, criminal, trabalhista e administrativa.</p>
  <p>Por fim, nos termos da legislação vigente e por estarem de pleno acordo com todas as cláusulas e condições ora pactuadas, assinam o presente instrumento em 2 (duas) vias que serão disponibilizadas uma ao empregado e outra ao empregador.</p>
  
  
  
 
      
 

  <img style="position:fixed; bottom:150px; left:-48px;" src="../img/footer3.png">

  
<div style="page-break-after: always;"></div>
   
  
    
    
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
      <td style="width: 45.0000%;"><center><strong>Guarda Mirim de Frutal</strong><br>CNPJ: 03.284.717/0001-09</center></td>
      <td style="width: 10.0000%;"> </td>
      <td style="width: 45.0000%;"> <center><strong>'.$resp['nomeResponsavel'].'</strong><br>CPF: '.$resp['cpf'].'</center> </td>
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
      <td style="width: 45.0000%;">______________________________________ </td>
     
    </tr>
    <tr>
      <td style="width: 45.0000%;"><center><strong>Testemunha 1</strong></center></td>
      <td style="width: 10.0000%;"> </td>
      <td style="width: 45.0000%;"><center><strong>Testemunha 2</strong><br></center></td>
    </tr>

    </tbody>
    </table>
 
  <img style="position:fixed; bottom:150px; left:-48px;" src="../img/footer3.png">
  
  ');
  
  // (Optional) Setup the paper size and orientation
  $dompdf->setPaper('A4', 'portrait');
  ob_clean();
  // Render the HTML as PDF
  $dompdf->render();
  
  // Output the generated PDF to Browser
  $dompdf->stream('Termo de responsabilidade dos bens de '.$resp['nomeResponsavel'].'.pdf',
  array ("Attachment" =>true //para realizar o download somente alterar para true
  )
  );


  ?>