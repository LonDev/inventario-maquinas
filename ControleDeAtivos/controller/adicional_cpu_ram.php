<?php require_once("/../Functions/conexao.php");

			/* INICIA OCS */
			
		
		//Informações Basicas da Maquina
		
		
	/* BASE MANUAL TIVIT.CORP */
		
			//Informações Basicas da Maquina
		$sql13 = "select h.lastcome,h.memory, h.processort, stor.disksize from hardware as h,bios as b, storages as stor WHERE h.id=b.hardware_id and  b.ssn = '$host' ";
			$info = mysqli_query($banco2,$sql13);			
			while ($dados_ocs = mysqli_fetch_array($info)){
			
                        $var[$i]['ULTIMOCONTATO'] = $dados_ocs[0]; //CONTATO
						$var[$i]['MEMORIA'] = $dados_ocs[1];
						$var[$i]['PROCESSADOR'] = $dados_ocs[2];
						$var[$i]['HD'] = $dados_ocs[3];
			}

			$sql17="select h.lastcome,h.memory, h.processort, stor.disksize from hardware as h,bios as b,vw_Operacao as o, storages as stor where b.hardware_id=h.id and o.hardware_id=h.id and b.ssn='$host'";
			$info5 = mysqli_query($banco3,$sql17);
			while ($dados_ocs_corp2 = mysqli_fetch_array($info5)){
			$var[$i]['ULTIMOCONTATO'] = $dados_ocs_corp2[0];
			$var[$i]['MEMORIA'] = $dados_ocs_corp2[1];
			$var[$i]['PROCESSADOR'] = $dados_ocs_corp2[2];
			$var[$i]['HD'] = $dados_ocs_corp2[3];
			
			};	

			// grava informação da máquina
			//executa a gravação dos dados caso eles existam
			//if($var[$i]['MEMORIA'] != " Não Localizado")
				if($var[$i]['MEMORIA'] != $mem_ram[$i] && $var[$i]['HD'] != $hd[$i])
				{
					$dados_adcional = array(
						$dados['ativo'],
						$var[$i]['MEMORIA'],
						$var[$i]['PROCESSADOR'],
						$var[$i]['HD'],
						$var[$i]['ULTIMOCONTATO'],
						);

					insere($dados_adcional);
					
					//echo("gravando");
				}
			
?>

 
