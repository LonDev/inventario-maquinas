<?php
require_once("/../Functions/conexao.php");
class MarcaDAO
{
	function listaMarcas()
	{
	$pdo = conecta();
	$array[] = null;
	$i = 0;//contator
	$busca = $pdo->prepare("SELECT * FROM marca");
	
	if(!$busca->execute())
	{
		echo "Erro ao buscar(marca.x01)";
		die();
	}
	if($busca->rowCount() > 0)
	{
		$data = $busca->fetchAll(PDO::FETCH_ASSOC);
		foreach($data as $dados)
		{
			$marca = new Marca();
			
			$marca->set("cod",$dados['cod']);
			$marca->set("nome", $dados['nome']);
			
			$array[$i] = $marca;
			
			$i++;
		}
	}	
return $array;
}

function listaMarcaMonitor()
{
	$pdo = conecta();
	$array[] = null;
	$i = 0;//contator
	$busca = $pdo->prepare("SELECT * FROM marca_monitor");
	
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
			$marca = new Marca();
			
			$marca->set("cod",$dados['id']);
			$marca->set("nome", $dados['nome']);
			
			$array[$i] = $marca;
			
			$i++;
		}
	}	
return $array;
}
function cadastramarca($marca){
	$pdo = conecta();			
	
	$insere = $pdo->prepare("INSERT INTO marca (nome) VALUES (:nome)");
	$insere->bindValue(":nome", $marca->get("nome"));
	
	if(!$insere->execute())
	{
		echo "Erro ao cadastrar(marca.x03)";
		die();
	}
}

}
?>