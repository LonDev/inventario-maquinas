<?php
 require_once("/../model/Marca.php");
 require_once("/../dao/MarcaDAO.php");

$marca = new Marca();
$marcaDao = new MarcaDAO();
  	
if (empty($_REQUEST['MARCA']))
{
 //instancia um marca 
  	$listamarca = $marcaDao->listaMarcas();
  
    foreach($listamarca as $marca)
    {
    	echo"<tr>
          		<td>".$marca->get('nome')."</td>
          </tr>";
    }        
}
 else
 {
    $marca->set("nome",$_REQUEST['MARCA']);
    $marca->set("cod",0);
    $marcaDao->cadastramarca($marca);   
}
?>