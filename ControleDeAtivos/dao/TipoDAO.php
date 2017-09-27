<?php
require_once("/../Functions/conexao.php");
class TipoDAO
{
	function listatipos()
	{
	$pdo = conecta();
	$array[] = null;
	$i = 0;//contator
	$busca = $pdo->prepare("SELECT t.nome, t.cod, m.nome AS fabricante FROM tipo AS t, marca AS m WHERE t.codmarca = m.cod ORDER BY fabricante");
	
	if(!$busca->execute())
	{
		echo "Erro ao buscar(tipo.x01)";
		die();
	}
	if($busca->rowCount() > 0)
	{
		$data = $busca->fetchAll(PDO::FETCH_ASSOC);
		foreach($data as $dados)
		{
			$tipo = new tipo();
			
			$tipo->set("cod",$dados['cod']);
			$tipo->set("nome", $dados['nome']);
			$tipo->set("codmarca",$dados['fabricante']);
			
			$array[$i] = $tipo;
			
			$i++;
		}
	}	
return $array;
}
function buscaTipo($codmarca)
	{
	$pdo = conecta();
	$array[] = null;
	$i = 0;//contator
	$busca = $pdo->prepare("SELECT * FROM tipo WHERE tipo.codmarca=:codmarca");
	$busca->bindValue(":codmarca", $codmarca);
	
	if(!$busca->execute())
	{
		echo "Erro ao buscar(marca.x02)";
		die();
	}
	if($busca->rowCount() > 0)
	{
		$data = $busca->fetchAll(PDO::FETCH_ASSOC);
		foreach($data as $dados)
		{
			$tipo = new Tipo();
			
			$tipo->set("cod",$dados['cod']);
			$tipo->set("nome", $dados['nome']);
			
			$array[$i] = $tipo;
			
			$i++;
		}
	}	
return $array;
}

function cadastratipo($tipo){
	$pdo = conecta();			
	
	$insere = $pdo->prepare("INSERT INTO tipo (nome, codmarca) VALUES (:nome,:codmarca)");
	$insere->bindValue(":nome", $tipo->get("nome"));
	$insere->bindValue(":codmarca", $tipo->get("codmarca"));
	if(!$insere->execute())
	{
		echo "Erro ao cadastrar(tipo.x02)";
		die();
	}
}

}
?>