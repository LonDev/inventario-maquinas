<?php
require_once("../../model/SubLocal.php");
require_once("../../dao/LocalDAO.php");

$sublocal = new SubLocal();
$localDao = new LocalDAO();

$listalocal = $localDao->buscaSubLocal($_REQUEST['LOCAL']);
$array_local = array();
 $i = 0;
	 	
    foreach($listalocal as $sublocal)
    {
    	//percorre o array de obj e transforma cada obj marca em obj json
      	$array_local[$i] = array('local'=>$sublocal->get("nome"),'cod'=>$sublocal->get("id"));
      	$i++;
    }

//transforma todo array de obj em um unico obj json
echo json_encode($array_local);


?>
