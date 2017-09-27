<?php require_once("/../Functions/conexao.php");

$local = $_REQUEST['LOCAL'];
$sublocal = $_REQUEST['SUBLOCAL'];

if(isset($local))
{
	$pdo = conecta();
	$array[] = null;
	$i = 0;//contator
	$busca = $pdo->prepare("SELECT equi.ativo, equi.serial, equi.cpu, equi.mem_ram, equi.hd, equi.ultimo_contato, sublocais.nome as localizacao, marc.nome as marca, tip.nome as modelo 
		FROM 
		equipamento as equi, sublocal as sublocais, marca as marc, tipo as tip, movimentacao as movi, local as loca
		WHERE 
		movi.cod_equipamento = equi.cod and equi.cod_tipo = tip.cod and tip.codmarca = marc.cod and movi.localizacao = loca.cod and sublocais.id = movi.sublocal and  loca.cod = ? and sublocais.id =? ");

	$busca->bindValue(1,$local);
	$busca->bindValue(2,$sublocal);
	
	if(!$busca->execute())
	{
		echo "Erro ao buscar(x01)";
		die();
	}
	if($busca->rowCount() > 0)
	{
		$data = $busca->fetchAll(PDO::FETCH_ASSOC);
		
		echo json_encode($data);
	}	
		
}
?>

 
