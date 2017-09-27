<?php
class Local
{
	private $cod;
	protected $nome;
	
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

	public function get($propriedade)
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