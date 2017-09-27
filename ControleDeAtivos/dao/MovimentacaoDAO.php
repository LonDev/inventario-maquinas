<?php
require_once("/../Functions/conexao.php");
class MovimentacaoDAO
{
	function buscaMovimentacao($filtro, $valor)
	{
		$pdo = conecta();
		$array = array();
		$i = 0;//contator
		$busca = $pdo->prepare("
			SELECT 
			mo.cod,
			m.nome as marca,
			t.nome as modelo,
			e.ativo,
			e.serial,
			mo.data,
			mo.motivo,
			mo.usuario,
			l.nome as local,
			sl.nome as sublocal
			FROM 
			marca as m,
			tipo as t,
			equipamento as e,
			movimentacao as mo,
			local as l,
			sublocal as sl
			WHERE
			mo.cod_equipamento = e.cod
			and
			m.cod = t.codmarca
			and
			e.cod_tipo = t.cod
			and
			mo.localizacao = l.cod
			and
			mo.sublocal = sl.id
			AND sl.codlocal = l.cod AND sl.id = mo.sublocal
			and
			e.$filtro = :valor

			order by mo.cod desc
			");
		//$busca->bindValue(":filtro", $filtro);
		$busca->bindValue(":valor", $valor);
		if(!$busca->execute())
		{
			echo "Erro ao buscar(movimentação.x01)";
			die();
		}
		if($busca->rowCount() > 0)
		{
			$data = $busca->fetchAll(PDO::FETCH_ASSOC);
			foreach($data as $dados)
			{
				$movimentacao = new Movimentacao();
				
				$movimentacao->set("marca",$dados['marca']);
				$movimentacao->set("cod_tipo",$dados['modelo']);
				$movimentacao->set("ativo",$dados['ativo']);
				$movimentacao->set("serial", $dados['serial']);
				$movimentacao->set("motivo", $dados['motivo']);
				$movimentacao->set("usuario", $dados['usuario']);
				$movimentacao->set("localizacao", $dados['local']);
				$movimentacao->set("sublocal", $dados['sublocal']);
				$movimentacao->set("data", $dados['data']);
				
				$array[$i] = $movimentacao;
			
				$i++;
			}

			return $array;
		}
		else
		{
			return null;
		}	
	}

	function cadastraMovimentacao($movimentacao)
	{
		$pdo = conecta();

		//busca o cod do equipamento
		$busca = $pdo->prepare("select cod from equipamento WHERE ativo = :ativo");
		$busca->bindValue(":ativo",$movimentacao->get("ativo"));

		if($busca->execute())
		{
			$cod = $busca->fetch();
			
			//atualiza o status do equipamento
			$atualiza = $pdo->prepare("UPDATE movimentacao set status = 0 where cod_equipamento = :cod");
			$atualiza->bindValue(":cod",$cod['cod']);
			if(!$atualiza->execute())
			{
				echo "erro ao atualizar o status da movimentacao<br>$cod";
			}

			$insere = $pdo->prepare("INSERT INTO movimentacao (cod_equipamento,data,motivo,localizacao,sublocal,usuario,status)
			VALUES(:cod,:data,:motivo,:local,:sublocal,:usuario,:status)");
			
			$insere->bindValue(":cod",$cod['cod']);
			$insere->bindValue(":data",$movimentacao->get("data"));
			$insere->bindValue(":motivo",$movimentacao->get("motivo"));
			$insere->bindValue(":local",$movimentacao->get("localizacao"));
			$insere->bindValue(":sublocal",$movimentacao->get("sublocal"));
			$insere->bindValue(":usuario",$movimentacao->get("usuario"));
			$insere->bindValue(":status",1);

			if(!$insere->execute())
			{
				return false;
			}
			else
			{
				return true;
			}
		}

	}	
}