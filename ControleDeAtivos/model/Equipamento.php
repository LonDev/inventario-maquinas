<?php
class Equipamento
{
	private $id;
	protected $cod_tipo;
	protected $ativo;
	protected $serial;
	protected $marca;
		
	public function set($propriedade, $valor)
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