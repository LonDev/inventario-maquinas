<?php
   	require_once("../../model/Local.php");
   	require_once("../../dao/LocalDAO.php");
   	
   	$local = new Local();
   	$localDao = new LocalDAO();
    	
   	$listalocal = $localDao->listaLocais();
    $array_local = array();
    $i = 0;
	  
    foreach($listalocal as $local)
    {
       //percorre o array de obj e transforma cada obj marca em obj json
      $array_local[$i] = array('local'=>$local->get("nome"),'cod'=>$local->get("cod"));
      $i++;
    }

    $array_local[$i] = array('local'=>'MGC - TODOS','cod'=>'MGC - ');
    
    //transforma todo array de obj em um unico obj json
    echo json_encode($array_local);

?>