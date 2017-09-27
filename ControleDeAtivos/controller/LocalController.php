<?php
 require_once("/../model/Local.php");
 require_once("/../dao/LocalDAO.php");

$local = new Local();
$localDao = new LocalDAO();
  	
if (empty($_POST['DESTINO']))
{
 //instancia um local 
  	$listalocal = $localDao->listaLocais();
  
    foreach($listalocal as $local)
    {
    	echo"<tr>
          		<td>".$local->get('nome')."</td>
          	</tr>";
    }        
}
 else
 {
    $local->set("nome",$_POST['DESTINO']);
    $local->set("cod",0);
    $localDao->cadastraLocal($local);   
}
?>