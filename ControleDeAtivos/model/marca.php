<?php
require_once("Equipamento.php");
class Marca extends Equipamento
{
	private $cod;
	private $nome;
	
	function set($propriedade, $valor)
	{
		if(property_exists($this,$propriedade))
		{
			$this->$propriedade = $valor;	
		}
		else
		{
			throw new Exception("propriedade não existe");
			exit;
		}
			
	}

	function get($propriedade)
	{
		if(property_exists($this,$propriedade))
		{
			return $this->$propriedade;	
		}
		else
		{
			throw new Exception("propriedade não existe");
			exit;
		}	
	}
}
?>