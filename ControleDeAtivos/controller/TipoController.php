<?php
 require_once("/../model/Tipo.php");
 require_once("/../dao/TipoDAO.php");

$tipo = new Tipo();
$tipoDao = new TipoDAO();
  	
if (empty($_POST['TIPO']))
{
 //instancia um tipo  	
  	$listatipo = $tipoDao->listatipos();
  
    foreach($listatipo as $tipo)
    {
    	echo"<tr>
          		<td>".$tipo->get('codmarca')."</td>
          		<td>".$tipo->get('nome')."</td>
          	</tr>";
    }        
}
 else
 {
    $tipo->set("nome",$_POST['TIPO']);
    $tipo->set("codmarca",$_POST['MARCA']);
    $tipoDao->cadastratipo($tipo);   
}
?>