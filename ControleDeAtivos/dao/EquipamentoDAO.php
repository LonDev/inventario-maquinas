<?php
require_once("/../Functions/conexao.php");
class EquipamentoDAO
{
	function cadastraEquipamento($equipamento){
	$pdo = conecta();			
	
	$insere = $pdo->prepare("INSERT INTO equipamento (cod_tipo,ativo,serial) VALUES (:cod_tipo,:ativo,:serial)");
	$insere->bindValue(":cod_tipo", $equipamento->get("cod_tipo"));
	$insere->bindValue(":ativo", $equipamento->get("ativo"));
	$insere->bindValue(":serial",$equipamento->get("serial"));
	if(!$insere->execute())
	{
		echo "Erro ao cadastrar(equipamento.x02)";
		die();
	}
}
	
}
?>