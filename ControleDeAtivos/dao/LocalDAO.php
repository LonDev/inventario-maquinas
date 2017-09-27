<?php
require_once("/../Functions/conexao.php");
class LocalDAO
{
	function listaLocais()
	{
	$pdo = conecta();
	$array[] = null;
	$i = 0;//contator
	$busca = $pdo->prepare("SELECT * FROM local WHERE oculto='n' ORDER BY nome");
	
	if(!$busca->execute())
	{
		echo "Erro ao buscar(local.x01)";
		die();
	}
	if($busca->rowCount() > 0)
	{
		$data = $busca->fetchAll(PDO::FETCH_ASSOC);
		foreach($data as $dados)
		{
			$local = new Local();
			
			$local->set("cod",$dados['cod']);
			$local->set("nome", $dados['nome']);
			
			$array[$i] = $local;
			
			$i++;
		}
	}	
		return $array;
	}
	
	function listaSubLocal()
	{
	$pdo = conecta();
	$array[] = null;
	$i = 0;//contator
	$busca = $pdo->prepare("SELECT * FROM sublocal WHERE oculto ='n' ORDER BY nome");
	
	if(!$busca->execute())
	{
		echo "Erro ao buscar(local.x02)";
		die();
	}
	if($busca->rowCount() > 0)
	{
		$data = $busca->fetchAll(PDO::FETCH_ASSOC);
		foreach($data as $dados)
		{
			$sublocal = new SubLocal();
			
			$sublocal->set("id",$dados['id']);
			$sublocal->set("codlocal",$dados['codlocal']);
			$sublocal->set("nome", $dados['nome']);
			
			$array[$i] = $sublocal;
			
			$i++;
		}
	}	
		return $array;
	}
	
	function buscaSubLocal($codlocal)
	{
	$pdo = conecta();
	$array[] = null;
	$i = 0;//contator
	$busca = $pdo->prepare("SELECT * FROM sublocal WHERE codlocal=:codlocal AND oculto='n' ORDER BY nome");
	$busca->bindValue(":codlocal", $codlocal);
	
	if(!$busca->execute())
	{
		echo "Erro ao buscar(local.x03)";
		die();
	}
	if($busca->rowCount() > 0)
	{
		$data = $busca->fetchAll(PDO::FETCH_ASSOC);
		foreach($data as $dados)
		{
			$sublocal = new SubLocal();
			
			$sublocal->set("id",$dados['id']);
			$sublocal->set("codlocal",$dados['codlocal']);
			$sublocal->set("nome", $dados['nome']);
			
			$array[$i] = $sublocal;
			
			$i++;
		}
	}	
		return $array;
	}
	
function cadastraLocal($local){
	$pdo = conecta();			
	
	$insere = $pdo->prepare("INSERT INTO local (nome) VALUES (:nome)");
	$insere->bindValue(":nome", $local->get("nome"));
	
	if(!$insere->execute())
	{
		echo "Erro ao cadastrar(local.x02)";
		die();
	}
}

}
?>