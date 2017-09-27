<?php
require_once("/../Functions/conexao.php");

switch ($_REQUEST['v'])
 {
	case 'cadastrar':
		insere();
		break;
	
	default:
		buscaMonitor();
		break;
}


function insere()
{
	$pdo = conecta();

	$marca 	=	$_POST['MARCA'];
	$modelo =	$_POST['MODELO'];
	$ativo 	=	$_POST['ATIVO'];
	$serial =	$_POST['SERIAL'];
	$local 	=	$_POST['LOCAL'];
	
	//compara o que ja esta cadastrado visando evitar que haja duplicidade de fornecedores
	$busca = $pdo->prepare("SELECT ativo FROM modelo_monitor WHERE ativo=?");
	$busca->bindValue(1, $ativo );
	$busca->execute();
	
	if($busca->rowCount() == 0)
	{

		$insere = $pdo->prepare("INSERT INTO modelo_monitor (nome,ativo,serial,cod_marca,cod_local) VALUES (?,?,?,?,?)");
		
		//colunas da tabela
		$insere->bindParam(1, $modelo );
		$insere->bindParam(2, $ativo );
		$insere->bindParam(3, $serial );
		$insere->bindParam(4, $marca );
		$insere->bindParam(5, $local );

		if(!$insere->execute())
		{
			echo("Erro ao cadastrar.");
			die();
		}
		else
		{
			echo("Monitor cadastrado com sucesso.");
		}
	}
	else{
		echo("$ativo já está cadastrado no sistema.");
	}
}

function buscaMonitor()
{
	$pdo = conecta();
	$array_monitor = array();
	$i = 0;

	$sql_busca_local = "SELECT monitor.nome as modelo, monitor.serial, monitor.ativo, marca.nome as marca, locais.nome as local
	  FROM modelo_monitor as monitor, marca_monitor as marca, local as locais
	  WHERE monitor.cod_local=:local and marca.id = monitor.cod_marca and locais.cod=:local";

	$sql_busca_sublocal = "SELECT monitor.nome as modelo, monitor.serial, monitor.ativo, marca.nome as marca, locais.nome as local, sublocais.nome as sublocal
	  FROM modelo_monitor as monitor, marca_monitor as marca, local as locais, sublocal as sublocais, movimentacao as movi
	  WHERE monitor.id = movi.cod_equipamento and
	   monitor.cod_local=:local and marca.id = monitor.cod_marca and locais.cod=:local and movi.sublocal =:sublocal and sublocais.id =:sublocal";  

	$busca = $pdo->prepare($sql_busca_local);

	$busca->bindValue(":local", $_REQUEST['local'] );

	if(isset($_REQUEST['sublocal']))
	{
		$busca = $pdo->prepare($sql_busca_sublocal);

		$busca->bindValue(":local", $_REQUEST['local'] );
		$busca->bindValue(":sublocal", $_REQUEST['sublocal']);
	}

	if(!$busca->execute())
	{
		echo "Erro ao buscar(marca.x01)";
		die();
	}

	if($busca->rowCount() > 0)
	{
		$data = $busca->fetchAll(PDO::FETCH_ASSOC);

		echo json_encode($data);

	}
}