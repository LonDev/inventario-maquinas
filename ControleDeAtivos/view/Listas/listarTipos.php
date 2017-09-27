<?php
	require_once("../../model/tipo.php");
   	require_once("../../dao/TipoDAO.php");
   	$tipo = new Tipo();
   	$tipoDao = new TipoDAO();
    
    $array_marca = array();
    $i = 0;
	
   	$listatipo = $tipoDao->buscaTipo($_REQUEST['MARCA']);
	  
    foreach($listatipo as $tipo)
    {      
      //percorre o array de obj e transforma cada obj marca em obj json
       $array_marca[$i] = array('nome'=>$tipo->get("nome"),'cod'=>$tipo->get("cod"));
       $i++;
    }

    //transforma todo array de obj em um unico obj json
    echo json_encode($array_marca);

?>