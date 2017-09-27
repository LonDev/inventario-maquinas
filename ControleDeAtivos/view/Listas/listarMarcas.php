<?php
   	require_once("../../model/marca.php");
   	require_once("../../dao/MarcaDAO.php");
   	
    $marca = new Marca();
   	$marcaDao = new MarcaDAO();
     
    $array_marca = array();
    $i = 0;

    if(isset($_REQUEST['v']) && $_REQUEST['v'] == "monitor")
    {
      $listamarca = $marcaDao->listaMarcaMonitor();
    }
    else
    {
      $listamarca = $marcaDao->listaMarcas();
    }

    //percorre o array de obj e transforma cada obj marca em obj json
    foreach($listamarca as $marca)
    {
      $array_marca[$i] = array('marca'=>$marca->get("nome"),'cod'=>$marca->get("cod"));
      $i++;
    }

    //transforma todo array de obj em um unico obj json
    echo json_encode($array_marca);

?>